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
     * @param string $content
     *
     * @return array|null
     */
    function processResult(string $content): ?array {
        return json_decode($content, true);
    }
}
