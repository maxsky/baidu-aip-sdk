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
use Exception;
use GuzzleHttp\Client;

/**
 * Aip Base 基类
 */
class AipBase {

    use AuthTrait;

    private $version = '2_2_20';

    /**
     * 获取 access token url
     *
     * @var string
     */
    private $accessTokenUrl = 'https://aip.baidubce.com/oauth/2.0/token';

    /**
     * 反馈接口
     *
     * @var string
     */
    private $reportUrl = 'https://aip.baidubce.com/rpc/2.0/feedback/v1/report';

    /**
     * appId
     *
     * @var string
     */
    private $appId;

    /**
     * apiKey
     *
     * @var string
     */
    private $apiKey;

    /**
     * secretKey
     *
     * @var string
     */
    private $secretKey;

    /**
     * 权限
     *
     * @var array
     */
    private $scope = 'brain_all_scope';

    private $isCloudUser = null;

    private $proxies = [];

    private $httpClient;

    /**
     * @param string $appId
     * @param string $apiKey
     * @param string $secretKey
     */
    public function __construct(string $appId, string $apiKey, string $secretKey) {
        $this->appId = trim($appId);
        $this->apiKey = trim($apiKey);
        $this->secretKey = trim($secretKey);

        $this->httpClient = new Client();
    }

    /**
     * 查看版本
     *
     * @return string
     *
     */
    public function getVersion(): string {
        return $this->version;
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
     * 处理请求参数
     *
     * @param array $params
     */
    protected function processRequest(array &$params) {
        $params['aipSdk'] = 'php';
        $params['aipSdkVersion'] = $this->version;
    }

    /**
     * Api 请求
     *
     * @param string $url
     * @param mixed  $data
     * @param array  $headers
     *
     * @return array|null
     */
    protected function request(string $url, $data, $headers = []): ?array {
        $params = [];

        try {
            $authObj = $this->auth();

            if ($this->isCloudUser === false) {
                $params['access_token'] = $authObj['access_token'];
            }

            // 特殊处理
            $this->processRequest($params);

            $headers = $this->getAuthHeaders('POST', $url, $params, $headers);

            $response = $this->httpClient->post($url, [
                'headers' => $headers,
                'query' => $params,
                'json' => $data
            ])->getBody();

            $obj = processResult($response);

            if (!$this->isCloudUser && isset($obj['error_code']) && $obj['error_code'] == 110) {
                $authObj = $this->auth(true);

                $params['access_token'] = $authObj['access_token'];

                $response = $this->httpClient->post($url, [
                    'headers' => $headers,
                    'query' => $params,
                    'form_params' => $data
                ])->getBody();

                $obj = processResult($response);
            }

            if (empty($obj) || !isset($obj['error_code'])) {
                $this->writeAuthObj($authObj);
            }
        } catch (Exception $e) {
            return [
                'error_code' => 'SDK108',
                'error_msg' => 'connection or read data timeout',
            ];
        }

        return $obj;
    }

    /**
     * 认证
     *
     * @param bool $refresh 是否刷新
     *
     * @return array
     * @throws Exception
     */
    private function auth(bool $refresh = false): array {
        // 非过期刷新
        if (!$refresh) {
            $obj = $this->readAuthObj();
            if (!empty($obj)) {
                return $obj;
            }
        }

        $response = $this->httpClient->get($this->accessTokenUrl, [
            'query' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->apiKey,
                'client_secret' => $this->secretKey,
            ]
        ])->getBody();

        $obj = processResult($response['content']);

        $this->isCloudUser = !$this->isPermission($obj);

        return $obj;
    }


    /**
     * 反馈
     *
     * @param array $feedback
     *
     * @return array
     */
    public function report(array $feedback): array {
        $data = [];

        $data['feedback'] = $feedback;

        return $this->request($this->reportUrl, $data);
    }

    /**
     * 通用接口
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     *
     * @return array
     */
    public function post(string $url, array $data, array $headers = []): array {
        return $this->request($url, $data, $headers);
    }
}
