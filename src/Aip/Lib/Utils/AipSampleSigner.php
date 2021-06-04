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

namespace Baidu\Aip\Lib\Utils;

class AipSampleSigner {

    const BCE_AUTH_VERSION = 'bce-auth-v1';
    const BCE_PREFIX = 'x-bce-';

    // 不指定 headersToSign 情况下，默认签名 http 头，包括：
    //    1.host
    //    2.content-length
    //    3.content-type
    //    4.content-md5
    public static $defaultHeadersToSign = [
        'host',
        'content-length',
        'content-type',
        'content-md5'
    ];

    /**
     * 签名
     *
     * @param array  $credentials
     * @param string $method
     * @param string $path
     * @param array  $headers
     * @param array  $params
     * @param array  $options
     *
     * @return string
     */
    public static function sign(array $credentials, string $method,
                                string $path, array $headers, array $params, array $options = []): string {
        // 设定签名有效时间
        if (!isset($options[AipSignOption::EXPIRATION_IN_SECONDS])) {
            // 默认值 1800 秒
            $expirationInSeconds = AipSignOption::DEFAULT_EXPIRATION_IN_SECONDS;
        } else {
            $expirationInSeconds = $options[AipSignOption::EXPIRATION_IN_SECONDS];
        }

        // 解析 ak sk
        $accessKeyId = $credentials['ak'];
        $secretAccessKey = $credentials['sk'];

        // 设定时间戳，注意：如果自行指定时间戳需要为 UTC 时间
        if (!isset($options[AipSignOption::TIMESTAMP])) {
            // 默认值当前时间
            $timestamp = gmdate('Y-m-d\TH:i:s\Z');
        } else {
            $timestamp = $options[AipSignOption::TIMESTAMP];
        }

        // 生成 authString
        $authString = self::BCE_AUTH_VERSION . '/' . $accessKeyId . '/'
            . $timestamp . '/' . $expirationInSeconds;

        // 使用 sk 和 authString 生成 signKey
        $signingKey = hash_hmac('sha256', $authString, $secretAccessKey);

        // 生成标准化 URI
        $canonicalURI = AipHttpUtil::getCanonicalURIPath($path);

        // 生成标准化 QueryString
        $canonicalQueryString = AipHttpUtil::getCanonicalQueryString($params);

        // 填充 headersToSign，也就是指明哪些 header 参与签名
        $headersToSign = null;

        if (isset($options[AipSignOption::HEADERS_TO_SIGN])) {
            $headersToSign = $options[AipSignOption::HEADERS_TO_SIGN];
        }

        // 生成标准化 header
        $canonicalHeader = AipHttpUtil::getCanonicalHeaders(
            self::getHeadersToSign($headers, $headersToSign)
        );

        // 整理 headersToSign，以 ';' 号连接
        $signedHeaders = '';

        if ($headersToSign !== null) {
            $signedHeaders = strtolower(
                trim(implode(";", $headersToSign))
            );
        }

        // 组成标准请求串
        $canonicalRequest = "$method\n$canonicalURI\n$canonicalQueryString\n$canonicalHeader";

        // 使用 signKey 和标准请求串完成签名
        $signature = hash_hmac('sha256', $canonicalRequest, $signingKey);

        // 最终签名串
        return "$authString/$signedHeaders/$signature";
    }

    /**
     * 根据headsToSign过滤应该参与签名的header
     *
     * @param array $headers
     * @param array $headersToSign
     *
     * @return array
     */
    public static function getHeadersToSign(array $headers, array $headersToSign): array {
        $arr = [];

        foreach ($headersToSign as $value) {
            $arr[] = strtolower(trim($value));
        }

        // value 被 trim 后为空串的 header 不参与签名
        $result = [];

        foreach ($headers as $key => $value) {
            if (trim($value) !== '') {
                $key = strtolower(trim($key));

                if (in_array($key, $arr)) {
                    $result[$key] = $value;
                }
            }
        }

        // 返回需要参与签名的 header
        return $result;
    }

    /**
     * 检查 header 是不是默认参加签名的：
     * 1.是 host、content-type、content-md5、content-length 之一
     * 2.以 x-bce 开头
     *
     * @param string $header
     *
     * @return bool
     */
    public static function isDefaultHeaderToSign(string $header): bool {
        $header = strtolower(trim($header));

        if (in_array($header, self::$defaultHeadersToSign)) {
            return true;
        }

        return substr_compare($header,
                self::BCE_PREFIX, 0, strlen(self::BCE_PREFIX)) === 0;
    }
}
