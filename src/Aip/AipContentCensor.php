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
 * UD = UserDefined
 */
class AipContentCensor extends AipBase {

    /**
     * 图像审核
     *
     * @url https://ai.baidu.com/ai-doc/ANTIPORN/jk42xep4e#%E8%AF%B7%E6%B1%82%E5%8F%82%E6%95%B0%E8%AF%B4%E6%98%8E
     *
     * @param string $image      待审核图像，要求大于等于 5kb，小于等于 4M，最短边大于等于 128 像素，小于等于 4096 像素，
     *                           支持的图片格式：PNG、JPG、JPEG、BMP、GIF（仅对首帧进行审核）、Webp、TIFF
     * @param int    $image_type 图片类型 0：静态图片（PNG、JPG、JPEG、BMP、GIF（仅对首帧进行审核）、Webp、TIFF），1：GIF 动态图片
     *                           默认值 0
     *
     * @return array
     */
    public function imageCensorUD(string $image, int $image_type = 0): array {
        if (isUrl($image)) {
            $data['imgUrl'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        $data['imgType'] = $image_type;

        return $this->request(API_IMAGE_CENSOR_UD, $data);
    }

    /**
     * 文本审核
     *
     * @url https://ai.baidu.com/ai-doc/ANTIPORN/Rk3h6xb3i#%E8%AF%B7%E6%B1%82%E5%8F%82%E6%95%B0%E8%AF%B4%E6%98%8E
     *
     * @param string $text
     *
     * @return array
     */
    public function textCensorUD(string $text = ''): array {
        return $this->request(API_TEXT_CENSOR_UD, ['text' => $text]);
    }

    /**
     * 短视频审核
     *
     * @url https://ai.baidu.com/ai-doc/ANTIPORN/ak8iav4m6#%E8%AF%B7%E6%B1%82%E5%8F%82%E6%95%B0%E8%AF%B4%E6%98%8E
     *
     * @param string $name
     * @param string $video_url
     * @param string $ext_id
     * @param array  $options
     *
     * @return array
     */
    public function videoCensorUD(string $name, string $video_url, string $ext_id, array $options = []): array {
        $data = [
            'name' => $name,
            'videoUrl' => $video_url,
            'extId' => $ext_id
        ];

        $data = array_merge($data, $options);

        return $this->request(API_VIDEO_CENSOR_UD, $data);
    }

    /**
     * 语音审核
     *
     * @url https://ai.baidu.com/ai-doc/ANTIPORN/hk928u7bz#%E8%AF%B7%E6%B1%82%E5%8F%82%E6%95%B0%E8%AF%B4%E6%98%8E%EF%BC%9A
     *
     * @param string $voice
     * @param string $fmt
     * @param array  $options
     *
     * @return array
     */
    public function voiceCensorUD(string $voice, string $fmt, array $options = []): array {
        if (isUrl($voice)) {
            $data['url'] = $voice;
        } else {
            $data['base64'] = base64_encode($voice);
        }

        $data['fmt'] = $fmt;

        $data = array_merge($data, $options);

        return $this->request(API_VOICE_CENSOR_UD, $data);
    }
}
