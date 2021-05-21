<?php

/*
* Copyright (c) 2017 Baidu.com, Inc. All Rights Reserved
*
* Licensed under the Apache License, Version 2.0 (the "License"); you may not
* use this file except in compliance with the License. You may obtain a copy of
* the License at
*
* Http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
* WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
* License for the specific language governing permissions and limitations under
* the License.
*/

namespace Baidu\Aip\Lib;

use Baidu\Aip\Lib\Traits\AuthTrait;
use GuzzleHttp\Client;

/**
 * Aip Base 基类
 */
class AipBase {

    use AuthTrait;

    /** @var string */
    private $appId;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $secretKey;

    /** @var array 权限 */
    private $scope = 'brain_all_scope';

    /** @var string|null */
    private $charset = null;

    /** @var array 代理 */
    private $proxies = [];

    /** @var Client GuzzleHttp Client */
    private $httpClient;

    /**
     * @param string $app_id
     * @param string $api_key
     * @param string $secret_key
     */
    public function __construct(string $app_id, string $api_key, string $secret_key) {
        $this->appId = trim($app_id);
        $this->apiKey = trim($api_key);
        $this->secretKey = trim($secret_key);

        $this->httpClient = new Client();
    }

    /**
     * 查看版本
     *
     * @return string
     */
    public function getVersion(): string {
        return API_VERSION;
    }

    /**
     * @param string $charset
     *
     * @return AipBase
     */
    public function setCharset(string $charset): AipBase {
        $this->charset = $charset;

        return $this;
    }

    /**
     * 代理
     *
     * @param array $proxies
     *
     * @return AipBase
     */
    public function setProxies(array $proxies): AipBase {
        $this->proxies = $proxies;

        return $this;
    }

    /**
     * Api 请求
     *
     * @param string $url
     * @param array  $data
     * @param bool   $is_json
     *
     * @return array
     */
    protected function request(string $url, array $data, bool $is_json = false): array {
        $obj = null;
        $authObj = $this->auth();

        if (isset($authObj['access_token'])) {
            $params['access_token'] = $authObj['access_token'];

            // 特殊处理
            $this->processRequest($params, $data);

            $headers = $this->getAuthHeaders('POST', $url, $params);

            $options = [
                'query' => $params,
                'headers' => $headers,
                'proxy' => $this->proxies
            ];

            if ($is_json) {
                $options['json'] = $data;
            } else {
                $options['form_params'] = $data;
            }

            $response = $this->httpClient->post($url, $options)->getBody();

            $obj = processResult($response, $this->charset);
        }

        if (!$obj || in_array($obj['error_code'], [100, 110, 111])) {
            $authObj = $this->auth(true);

            if ($authObj) {
                $options['query']['access_token'] = $authObj['access_token'];

                $response = $this->httpClient->post($url, $options)->getBody();

                $obj = processResult($response, $this->charset);
            } else {
                return [
                    'error_code' => 110,
                    'error_description' => 'access token invalid or no longer valid'
                ];
            }
        }

        return $obj;
    }

    /**
     * 处理请求参数
     *
     * @param array $params
     * @param array $data
     *
     * @return void
     */
    private function processRequest(array &$params, array &$data): void {
        $params['aipSdk'] = 'php';
        $params['aipSdkVersion'] = $this->getVersion();

        if ($this->charset === 'UTF-8') {
            $params['charset'] = $this->charset;
        }

        if ($this->charset === 'GBK') {
            $data = mb_convert_encoding($data, 'GBK', 'UTF8');
        }
    }

    /**
     * 反馈
     *
     * @param array $feedback
     *
     * @return array
     */
    private function report(array $feedback): array {
        $data['feedback'] = $feedback;

        return $this->request(API_REPORT, $data);
    }
}
