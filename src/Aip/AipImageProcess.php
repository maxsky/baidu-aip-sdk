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
     * 黑白图像上色
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function colourize(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_COLOURIZE, $data);
    }

    /**
     * 图像风格转换
     *
     * @url https://ai.baidu.com/ai-doc/IMAGEPROCESS/xk3bclo77#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image  图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     * @param string $option 风格
     *
     * @return array
     */
    public function styleTrans(string $image, string $option): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        $data['option'] = $option;

        return $this->request(API_STYLE_TRANS, $data);
    }

    /**
     * 人像动漫化
     *
     * @param string   $image   图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     * @param string   $type    anime 或者 anime_mask。前者生成二次元动漫图，后者生成戴口罩的二次元动漫人像
     * @param int|null $mask_id 1~8 之间的整数，用于指定所使用的口罩的编码
     *
     * @return array
     */
    public function selfieAnime(string $image, string $type = 'anime', int $mask_id = null): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        $data['type'] = $type;
        $data['mask_id'] = $mask_id;

        return $this->request(API_SELFIE_ANIME, $data);
    }

    /**
     * 天空分割
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function skySeg(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_SKY_SEG, $data);
    }

    /**
     * 图像去雾
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function dehaze(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_DEHAZE, $data);
    }

    /**
     * 图像对比度增强
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function contrastEnhance(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_CONTRAST_ENHANCE, $data);
    }

    /**
     * 图像无损放大
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function qualityEnhance(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_QUALITY_ENHANCE, $data);
    }

    /**
     * 拉伸图像恢复
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function stretchRestore(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_STRETCH_RESTORE, $data);
    }

    /**
     * 图像修复
     *
     * @url https://ai.baidu.com/ai-doc/IMAGEPROCESS/ok3bclome#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image     图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     * @param array  $rectangle 要去除的位置为规则矩形时，给出坐标信息
     *
     * @return array
     */
    public function inpaintingByMask(string $image, array $rectangle): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        $data['rectangle'] = $rectangle;

        return $this->request(API_INPAINTING, $data);
    }

    /**
     * 图像清晰度增强
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function definitionEnhance(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_DEFINITION_ENHANCE, $data);
    }

    /**
     * 图像色彩增强
     *
     * @param string $image 图像数据或 URL，大小不超过 10M（参考：原图大约为 8M 以内），最短边至少 10px，最长边最大 5000px，长宽比 4:1 以内
     *
     * @return array
     */
    public function colorEnhance(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $this->request(API_COLOR_ENHANCE, $data);
    }
}
