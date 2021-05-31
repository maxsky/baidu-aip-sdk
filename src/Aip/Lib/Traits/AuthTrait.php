<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/13
 * Time: 13:18
 */

namespace Baidu\Aip\Lib\Traits;

use Baidu\Aip\Lib\Utils\AipSampleSigner;

trait AuthTrait {

    use FileTrait;

    /**
     * 认证
     *
     * @param bool $refresh 是否刷新
     *
     * @return array|null
     */
    private function auth(bool $refresh = false): ?array {
        // 非过期刷新
        if (!$refresh) {
            if ($obj = $this->readFileObject()) {
                return $obj;
            }
        }

        $response = $this->httpClient->post(API_GET_ACCESS_TOKEN, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->apiKey,
                'client_secret' => $this->secretKey
            ],
            'proxy' => $this->proxies
        ])->getBody();

        $obj = processResult($response);

        $this->writeFileObject($obj);

        return $obj;
    }

    /**
     * 判断认证是否有权限
     *
     * @param array $auth_object
     *
     * @return bool
     */
    private function isPermission(array $auth_object): bool {
        if (empty($auth_object) || !isset($auth_object['scope'])) {
            return false;
        }

        $scopes = explode(' ', $auth_object['scope']);

        return in_array($this->scope, $scopes);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    private function getAuthHeaders(string $method, string $url, array $params = [], array $headers = []): array {
        $obj = parse_url($url);

        if (!empty($obj['query'])) {
            foreach (explode('&', $obj['query']) as $kv) {
                if (!empty($kv)) {
                    [$k, $v] = explode('=', $kv, 2);
                    $params[$k] = $v;
                }
            }
        }

        // UTC 时间戳
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');
        $headers['Host'] = isset($obj['port']) ? sprintf('%s:%s', $obj['host'], $obj['port']) : $obj['host'];
        $headers['x-bce-date'] = $timestamp;

        // 签名
        $headers['authorization'] = AipSampleSigner::sign([
            'ak' => $this->apiKey,
            'sk' => $this->secretKey,
        ], $method, $obj['path'], $headers, $params, [
            'timestamp' => $timestamp,
            'headersToSign' => array_keys($headers),
        ]);

        return $headers;
    }
}
