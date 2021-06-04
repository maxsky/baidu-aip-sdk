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

if (!function_exists('bool2Str')) {
    /**
     * @param bool $logic
     *
     * @return string
     */
    function bool2Str(bool $logic): string {
        return $logic ? 'true' : 'false';
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

if (!function_exists('getPercentEncodedStrings')) {
    /**
     * @return array
     */
    function getPercentEncodedStrings(): array {
        $percentEncodedStrings = [];

        for ($i = 0; $i < 256; ++$i) {
            $percentEncodedStrings[$i] = sprintf('%%%02X', $i);
        }

        // a-z 不编码
        foreach (range('a', 'z') as $ch) {
            $percentEncodedStrings[ord($ch)] = $ch;
        }

        // A-Z 不编码
        foreach (range('A', 'Z') as $ch) {
            $percentEncodedStrings[ord($ch)] = $ch;
        }

        // 0-9 不编码
        foreach (range('0', '9') as $ch) {
            $percentEncodedStrings[ord($ch)] = $ch;
        }

        // 以下 4 个字符不编码
        $percentEncodedStrings[ord('-')] = '-';
        $percentEncodedStrings[ord('.')] = '.';
        $percentEncodedStrings[ord('_')] = '_';
        $percentEncodedStrings[ord('~')] = '~';

        return $percentEncodedStrings;
    }
}
