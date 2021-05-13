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

use InvalidArgumentException;

class AipHttpUtil {
    // 根据RFC 3986，除了：
    //   1.大小写英文字符
    //   2.阿拉伯数字
    //   3.点'.'、波浪线'~'、减号'-'以及下划线'_'
    // 以外都要编码
    public static $PERCENT_ENCODED_STRINGS;

    // 填充编码数组
    public static function __init() {
        AipHttpUtil::$PERCENT_ENCODED_STRINGS = [];

        for ($i = 0; $i < 256; ++$i) {
            AipHttpUtil::$PERCENT_ENCODED_STRINGS[$i] = sprintf('%%%02X', $i);
        }

        // a-z 不编码
        foreach (range('a', 'z') as $ch) {
            AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord($ch)] = $ch;
        }

        // A-Z 不编码
        foreach (range('A', 'Z') as $ch) {
            AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord($ch)] = $ch;
        }

        //0-9不编码
        foreach (range('0', '9') as $ch) {
            AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord($ch)] = $ch;
        }

        //以下4个字符不编码
        AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord('-')] = '-';
        AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord('.')] = '.';
        AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord('_')] = '_';
        AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord('~')] = '~';
    }

    /**
     * 在uri编码中不能对'/'编码
     *
     * @param string $path
     *
     * @return string
     */
    public static function urlEncodeExceptSlash($path): string {
        return str_replace('%2F', '/', AipHttpUtil::urlEncode($path));
    }

    /**
     * 使用编码数组编码
     *
     * @param string $value
     *
     * @return string
     */
    public static function urlEncode(string $value): string {
        $result = '';

        for ($i = 0; $i < strlen($value); ++$i) {
            $result .= AipHttpUtil::$PERCENT_ENCODED_STRINGS[ord($value[$i])];
        }

        return $result;
    }

    /**
     * 生成标准化 QueryString
     *
     * @param array $parameters
     *
     * @return string
     */
    public static function getCanonicalQueryString(array $parameters): string {
        // 没有参数，直接返回空串
        if (count($parameters) == 0) {
            return '';
        }

        $parameterStrings = [];

        foreach ($parameters as $k => $v) {
            // 跳过 Authorization 字段
            if (strcasecmp('Authorization', $k) !== 0) {
                if (!isset($k)) {
                    throw new InvalidArgumentException('parameter key should not be null');
                }

                if (isset($v)) {
                    // 对于有值的，编码后放在=号两边
                    $parameterStrings[] = AipHttpUtil::urlEncode($k) . '=' . AipHttpUtil::urlEncode((string)$v);
                } else {
                    // 对于没有值的，只将 key 编码后放在 = 号的左边，右边留空
                    $parameterStrings[] = AipHttpUtil::urlEncode($k) . '=';
                }
            }
        }

        // 按照字典序排序
        sort($parameterStrings);

        // 使用 '&' 符号连接
        return implode('&', $parameterStrings);
    }

    /**
     * 生成标准化 uri
     *
     * @param string $path
     *
     * @return string
     */
    public static function getCanonicalURIPath(string $path): string {
        // 空路径设置为 '/'
        if (empty($path)) {
            return '/';
        } elseif ($path[0] == '/') {  // 所有的 uri 必须以 '/' 开头
            return AipHttpUtil::urlEncodeExceptSlash($path);
        }

        return '/' . AipHttpUtil::urlEncodeExceptSlash($path);
    }

    /**
     * 生成标准化 http 请求头串
     *
     * @param array $headers
     *
     * @return string
     */
    public static function getCanonicalHeaders(array $headers): string {
        // 如果没有 headers，则返回空串
        if (count($headers) == 0) {
            return '';
        }

        $headerStrings = [];

        foreach ($headers as $k => $v) {
            // key 为 null 时跳过
            if ($k !== null) {
                // 如果 value 为 null，则赋值为空串
                if ($v === null) {
                    $v = '';
                }

                // trim 后再 encode，之后使用 ':' 号连接起来
                $headerStrings[] = AipHttpUtil::urlEncode(strtolower(trim($k))) . ':' . AipHttpUtil::urlEncode(trim($v));
            }
        }
        // 字典序排序
        sort($headerStrings);

        // 用 '\n' 把连接
        return implode("\n", $headerStrings);
    }
}
