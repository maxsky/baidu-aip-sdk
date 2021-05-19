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

class AipBodyAnalysis extends AipBase {

    /**
     * 人体关键点识别
     *
     * @param string $image 图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     *
     * @return array
     */
    public function bodyAnalysis(string $image): array {
        return $this->request(API_BODY_ANALYSIS, ['image' => base64_encode($image)]);
    }

    /**
     * 人体检测和属性识别
     *
     * @url https://ai.baidu.com/ai-doc/BODY/Ak3cpyx6v#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string     $image 图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     * @param array|null $type  可选属性，为空默认输出全部 22 个属性
     *
     * @return array
     */
    public function bodyAttr(string $image, ?array $type = null): array {
        $data['image'] = base64_encode($image);

        if ($type) {
            $data['type'] = implode(',', $type);
        }

        return $this->request(API_BODY_ATTR, $data);
    }

    /**
     * 人流量统计
     *
     * @param string     $image 图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     * @param array|null $area
     * @param bool       $show
     *
     * @return array
     */
    public function bodyNum(string $image, ?array $area = null, bool $show = false): array {
        $data['image'] = base64_encode($image);

        if ($area) {
            $data['area'] = implode(',', $area);
        }

        $data['show'] = $show ? 'true' : 'false';

        return $this->request(API_BODY_NUM, $data);
    }

    /**
     * 手势识别
     *
     * @param string $image 图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     *
     * @return array
     */
    public function gesture(string $image): array {
        return $this->request(API_GESTURE, ['image' => base64_encode($image)]);
    }

    /**
     * 人像分割接口
     *
     * @param string     $image 图像数据，base64 编码后进行 urlencode，要求 base64 编码和 urlencode 后大小不超过4M。 图片的 base64
     *                          编码是不包含图片头的，如（data:image/jpg;base64,），支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     * @param array|null $type  指定返回结果图类型，为空默认返回 3 类结果图
     *
     * @return array
     */
    public function bodySeg(string $image, ?array $type = null): array {
        $data['image'] = base64_encode($image);

        if ($type) {
            $data['type'] = implode(',', $type);
        }

        return $this->request(API_BODY_SEG, $data);
    }

    /**
     * 驾驶行为分析
     *
     * @param string     $image               图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     * @param array|null $type                行为类别，为空默认识别所有属性
     * @param bool       $left_wheel_location 是否左舵车，默认为真
     *
     * @return array
     */
    public function driverBehavior(string $image, ?array $type = null, bool $left_wheel_location = true): array {
        $data['image'] = base64_encode($image);

        if ($type) {
            $data['type'] = implode(',', $type);
        }

        $data['wheel_location'] = (string)(int)$left_wheel_location;

        return $this->request(API_DRIVER_BEHAVIOR, $data);
    }

    /**
     * 人流量统计（动态版）
     *
     * @url https://ai.baidu.com/ai-doc/BODY/wk3cpyyog#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param bool   $dynamic true：动态人流量统计，返回总人数、跟踪ID、区域进出人数；false：静态人数统计，返回总人数
     * @param string $image   图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     * @param array  $options 可选项，注意 dynamic 为 true 时必传 case_id 和 case_init
     *
     * @return array
     */
    public function bodyTracking(bool $dynamic, string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        if ($dynamic) {
            if (!isset($options['case_id']) || !isset($options['case_init'])) {
                return [
                    'error_code' => 216101,
                    'error_msg' => ERROR_MSG[216101]
                ];
            }

            $data['dynamic'] = 'true';
        } else {
            $data['dynamic'] = 'false';
        }

        $data = array_merge($data, $options);

        return $this->request(API_BODY_TRACKING, $data);
    }

    /**
     * 手部关键点识别
     *
     * @param string $image 图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     *
     * @return array
     */
    public function handAnalysis(string $image): array {
        return $this->request(API_HAND_ANALYSIS, ['image' => base64_encode($image)]);
    }

    /**
     * 危险行为识别
     *
     * @param string $data 视频数据，大小不超过4M，支持 mp4、mov 格式，5s 以内的监控视频片段
     *
     * @return array
     */
    public function bodyDanger(string $data): array {
        return $this->request(API_BODY_DANGER, ['data' => base64_encode($data)]);
    }

    /**
     * @param string $image 图像数据，大小不超过4M。支持图片格式：jpg、bmp、png，最短边至少 50px，最长边最大 4096px
     *
     * @return array
     */
    public function fingertip(string $image): array {
        return $this->request(API_FINGERTIP, ['image' => base64_encode($image)]);
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function bodySegPhoto(string $image): array {
        return $this->request(API_BODY_SEG_PHOTO, ['image' => base64_encode($image)]);
    }
}
