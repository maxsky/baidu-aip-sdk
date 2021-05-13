<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/13
 * Time: 13:18
 */

namespace Baidu\Aip\Lib\Traits;

use Baidu\Aip\Lib\AipSampleSigner;
use Exception;

trait AuthTrait {

    /**
     * 返回 access token 路径
     *
     * @return string
     */
    private function getAuthFilePath(): string {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5($this->apiKey);
    }

    /**
     * 读取本地缓存
     *
     * @return array
     * @throws Exception array not exists keys
     */
    private function readAuthObj(): ?array {
        $filePath = $this->getAuthFilePath();

        if (file_exists($filePath)) {
            $content = file_get_contents($this->getAuthFilePath());

            if ($content) {
                $obj = processResult($content);
                $this->isCloudUser = $obj['is_cloud_user'];
                $obj['is_read'] = true;

                if ($this->isCloudUser || $obj['time'] + $obj['expires_in'] - 30 > time()) {
                    return $obj;
                }
            }
        } else {
            file_put_contents($filePath, '');
        }

        return null;
    }

    /**
     * 写入本地文件
     *
     * @param array $obj
     *
     * @return void
     */
    private function writeAuthObj(array $obj) {
        if (isset($obj['is_read']) && $obj['is_read'] === true) {
            return;
        }

        $obj['time'] = time();
        $obj['is_cloud_user'] = $this->isCloudUser;

        file_put_contents($this->getAuthFilePath(), json_encode($obj));
    }

    /**
     * 判断认证是否有权限
     *
     * @param array $authObj
     *
     * @return boolean
     */
    private function isPermission(array $authObj): bool {
        if (empty($authObj) || !isset($authObj['scope'])) {
            return false;
        }

        $scopes = explode(' ', $authObj['scope']);

        return in_array($this->scope, $scopes);
    }

    /**
     * @param string $method HTTP method
     * @param string $url
     * @param array  $params 参数
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
