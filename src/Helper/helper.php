<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/13
 * Time: 13:13
 */

if (!function_exists('isUrl')) {
    /**
     * @param string $content
     *
     * @return bool
     */
    function isUrl(string $content): bool {
        return substr(trim($content), 0, 4) === 'http';
    }
}

if (!function_exists('processResult')) {
    /**
     * @param string      $content
     * @param string|null $charset
     *
     * @return array|null
     */
    function processResult(string $content, ?string $charset = null): ?array {
        if (!$charset) {
            return json_decode($content, true);
        }

        if ($charset === 'GBK') {
            return json_decode(
                mb_convert_encoding($content, 'UTF8', 'GBK'), true, 512, JSON_BIGINT_AS_STRING
            );
        }

        return json_decode($content, true, 512, JSON_BIGINT_AS_STRING);
    }
}
