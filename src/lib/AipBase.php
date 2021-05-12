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

use Exception;
use GuzzleHttp\Client;

/**
 * Aip Base 基类
 */
class AipBase {

    private $version = '2_2_17';

    /**
     * 获取 access token url
     *
     * @var string
     */
    protected $accessTokenUrl = 'https://aip.baidubce.com/oauth/2.0/token';

    /**
     * 反馈接口
     *
     * @var string
     */
    protected $reportUrl = 'https://aip.baidubce.com/rpc/2.0/feedback/v1/report';

    /**
     * appId
     *
     * @var string
     */
    protected $appId = '';

    /**
     * apiKey
     *
     * @var string
     */
    protected $apiKey = '';

    /**
     * secretKey
     *
     * @var string
     */
    protected $secretKey = '';

    /**
     * 权限
     *
     * @var array
     */
    protected $scope = 'brain_all_scope';

    private $isCloudUser = false;

    /** @var Client */
    private $httpClient;

    /**
     * @param string $appId
     * @param string $apiKey
     * @param string $secretKey
     */
    public function __construct(string $appId, string $apiKey, string $secretKey) {
        $this->httpClient = new Client();

        $this->appId = trim($appId);
        $this->apiKey = trim($apiKey);
        $this->secretKey = trim($secretKey);
    }

    /**
     * 查看版本
     *
     * @return string
     */
    public function getVersion(): string {
        return $this->version;
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
     * @param array  $data
     * @param array  $headers
     *
     * @return mixed|bool|string[]
     */
    protected function request(string $url, array $data, array $headers = []) {
        $params = [];
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
            'form_params' => $data
        ])->getBody();

        $obj = $this->processResult($response);

        if (!$this->isCloudUser && isset($obj['error_code']) && $obj['error_code'] == 110) {
            $authObj = $this->auth(true);
            $params['access_token'] = $authObj['access_token'];

            $response = $this->httpClient->post($url, [
                'headers' => $headers,
                'query' => $params,
                'form_params' => $data
            ])->getBody();

            $obj = $this->processResult($response);
        }

        if (empty($obj) || !isset($obj['error_code'])) {
            $this->writeAuthObj($authObj);
        }

        return $obj;
    }

    /**
     * Api 多个并发请求
     *
     * @param string $url
     * @param array  $data
     *
     * @return mixed
     */
    protected function multi_request(string $url, array $data) {
        try {
            $params = [];
            $authObj = $this->auth();
            $headers = $this->getAuthHeaders('POST', $url);

            if ($this->isCloudUser === false) {
                $params['access_token'] = $authObj['access_token'];
            }

            $responses = [];

            foreach ($data as $item) {
                $responses[] = $this->httpClient->post($url, [
                    'headers' => $headers,
                    'query' => $params,
                    'form_params' => $item
                ])->getBody();
            }

            $is_success = false;

            foreach ($responses as $response) {
                $obj = $this->processResult($response);

                if (empty($obj) || !isset($obj['error_code'])) {
                    $is_success = true;
                }

                if (!$this->isCloudUser && isset($obj['error_code']) && $obj['error_code'] == 110) {
                    $authObj = $this->auth(true);

                    $params['access_token'] = $authObj['access_token'];

                    $responses = $this->httpClient->post($url, [
                        'headers' => $headers,
                        'query' => $params,
                        'form_params' => $data
                    ]);

                    break;
                }
            }

            if ($is_success) {
                $this->writeAuthObj($authObj);
            }

            $objs = [];

            foreach ($responses as $response) {
                $objs[] = $this->processResult($response);
            }

        } catch (Exception $e) {
            return [
                'error_code' => 'SDK108',
                'error_msg' => 'connection or read data timeout',
            ];
        }

        return $objs;
    }

    /**
     * 格式化结果
     *
     * @param $content string
     *
     * @return mixed
     */
    protected function processResult(string $content) {
        return json_decode($content, true);
    }

    /**
     * 返回 access token 路径
     *
     * @return string
     */
    private function getAuthFilePath(): string {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . md5($this->apiKey);
    }

    /**
     * 写入本地文件
     *
     * @param array $obj
     *
     * @return void
     */
    private function writeAuthObj(array $obj) {
        if ($obj === null || (isset($obj['is_read']) && $obj['is_read'] === true)) {
            return;
        }

        $obj['time'] = time();
        $obj['is_cloud_user'] = $this->isCloudUser;

        file_put_contents($this->getAuthFilePath(), json_encode($obj));
    }

    /**
     * 读取本地缓存
     *
     * @return array
     */
    private function readAuthObj(): ?array {
        $content = file_get_contents($this->getAuthFilePath());

        if ($content !== false) {
            $obj = json_decode($content, true);
            $this->isCloudUser = $obj['is_cloud_user'];
            $obj['is_read'] = true;
            if ($this->isCloudUser || $obj['time'] + $obj['expires_in'] - 30 > time()) {
                return $obj;
            }
        }

        return null;
    }

    /**
     * 认证
     *
     * @param bool $refresh 是否刷新
     *
     * @return array
     */
    private function auth($refresh = false): array {
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

        $obj = $this->processResult($response);

        $this->isCloudUser = !$this->isPermission($obj);

        return $obj;
    }

    /**
     * 判断认证是否有权限
     *
     * @param array $authObj
     *
     * @return bool
     */
    protected function isPermission(array $authObj): bool {
        if (empty($authObj) || !isset($authObj['scope'])) {
            return false;
        }

        $scopes = explode(' ', $authObj['scope']);

        return in_array($this->scope, $scopes);
    }

    /**
     * @param string $method HTTP method
     * @param string $url
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    private function getAuthHeaders(string $method, string $url, array $params = [], array $headers = []): array {
        // 不是云的老用户则不用在 header 中签名、认证
        if ($this->isCloudUser === false) {
            return $headers;
        }

        $obj = parse_url($url);
        if (!empty($obj['query'])) {
            foreach (explode('&', $obj['query']) as $kv) {
                if (!empty($kv)) {
                    [$k, $v] = explode('=', $kv, 2);
                    $params[$k] = $v;
                }
            }
        }

        //UTC 时间戳
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');
        $headers['Host'] = isset($obj['port']) ? sprintf('%s:%s', $obj['host'], $obj['port']) : $obj['host'];
        $headers['x-bce-date'] = $timestamp;

        //签名
        $headers['authorization'] = AipSampleSigner::sign([
            'ak' => $this->apiKey,
            'sk' => $this->secretKey,
        ], $method, $obj['path'], $headers, $params, [
            'timestamp' => $timestamp,
            'headersToSign' => array_keys($headers),
        ]);

        return $headers;
    }

    /**
     * 反馈
     *
     * @param $feedback
     *
     * @return array
     */
    public function report($feedback) {
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
    public function post(string $url, array $data, array $headers = []) {
        return $this->request($url, $data, $headers);
    }
}
