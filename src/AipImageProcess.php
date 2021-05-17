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

class AipImageProcess extends AipBase {

    /**
     * 图像无损放大接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function imageQualityEnhance(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_QUALITY_ENHANCE, $data);
    }

    /**
     * 图像去雾接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function dehaze(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_DEHAZE, $data);
    }

    /**
     * 图像对比度增强接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function contrastEnhance(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_CONTRAST_ENHANCE, $data);
    }

    /**
     * 黑白图像上色接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function colourize(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_COLOURIZE, $data);
    }

    /**
     * 拉伸图像恢复接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function stretchRestore(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_STRETCH_RESTORE, $data);
    }

    /**
     * 人像动漫化
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function selfieAnime(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_SELFIE_ANIME, $data);
    }

    /**
     * 图像清晰度增强
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function imageDefinitionEnhance(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_DEFINITION_ENHANCE, $data);
    }

    /**
     * 图像风格转换
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function __styleTrans(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_STYLE_TRANS, $data);
    }

    /**
     * 天空分割
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function skySeg(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->skySeg, $data);
    }

    /**
     * 图像修复
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param        $rectangle
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @return array
     * @description options列表:
     */
    public function inpaintingByMask(string $image, $rectangle, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['rectangle'] = $rectangle;

        $data = array_merge($data, $options);

        return $this->request(API_INPAINTING, $data);
    }
}
