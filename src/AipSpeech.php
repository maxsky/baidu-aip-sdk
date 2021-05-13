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

namespace Baidu\Aip;

use Baidu\Aip\Lib\AipBase;

/**
 * 百度语音
 */
class AipSpeech extends AipBase {

    /**
     * url
     *
     * @var string
     */
    public $asrUrl = 'https://vop.baidu.com/server_api';

    /**
     * url
     *
     * @var string
     */
    public $ttsUrl = 'https://tsn.baidu.com/text2audio';

    /**
     * 处理请求参数
     *
     * @param string $url
     * @param array  $params
     * @param array  $data
     * @param array  $headers
     */
    protected function processRequest($url, array &$params, array &$data, array $headers) {
        $token = $params['access_token'] ?? '';

        if (empty($data['cuid'])) {
            $data['cuid'] = md5($token);
        }

        if ($url === $this->asrUrl) {
            $data['token'] = $token;
            $data = json_encode($data);
        } else {
            $data['tok'] = $token;
        }

        unset($params['access_token']);
    }

    /**
     * 格式化结果
     *
     * @param $content string
     *
     * @return array|string[]|null
     */
    protected function processResult(string $content): ?array {
        $obj = processResult($content);

        if ($obj === null) {
            $obj = [
                '__json_decode_error' => $content
            ];
        }

        return $obj;
    }

    /**
     * @param string $speech
     * @param string $format
     * @param int    $rate
     * @param array  $options
     *
     * @return array
     */
    public function asr(string $speech, string $format, int $rate, array $options = []): array {
        $data = [];

        if (!empty($speech)) {
            $data['speech'] = base64_encode($speech);
            $data['len'] = strlen($speech);
        }

        $data['format'] = $format;
        $data['rate'] = $rate;
        $data['channel'] = 1;

        $data = array_merge($data, $options);

        return $this->request($this->asrUrl, $data, []);
    }

    /**
     * @param string $text
     * @param string $lang
     * @param int    $ctp
     * @param array  $options
     *
     * @return array
     */
    public function synthesis(string $text, string $lang = 'zh', int $ctp = 1, array $options = []): array {
        $data['tex'] = $text;
        $data['lan'] = $lang;
        $data['ctp'] = $ctp;

        $data = array_merge($data, $options);

        $result = $this->request($this->ttsUrl, $data, []);

        if (isset($result['__json_decode_error'])) {
            return $result['__json_decode_error'];
        }

        return $result;
    }
}
