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
use Baidu\Aip\Lib\Traits\DataTrait;
use Exception;

class AipImageClassify extends AipBase {

    use DataTrait;

    /**
     * 组合接口
     *
     * @url https://ai.baidu.com/ai-doc/IMAGERECOGNITION/Kkbg3gxs7#%E6%8E%A5%E5%8F%A3%E4%BD%BF%E7%94%A8%E8%AF%B4%E6%98%8E
     *
     * @param string $image  图像数据或 URL
     * @param array  $scenes 模型服务
     * @param array  $options
     *
     * @return array
     * @description options列表:
     */
    public function combination(string $image, array $scenes, array $options = []): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['scenes'] = $scenes;

        $data = array_merge($data, $options);

        return $this->request(API_COMBINATION, $data, true);
    }

    /**
     * 通用物体和场景识别高级版
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param int    $baike_num
     *
     * @return array
     * @description options列表:
     *   baike_num 返回百科信息的结果数，默认不返回
     */
    public function advancedGeneral(string $image, int $baike_num = 0): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['baike_num'] = $baike_num;

        return $this->request(API_ADVANCED_GENERAL, $data);
    }

    /**
     * 图像单主体检测
     *
     * @param string $image     图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param int    $with_face 如果检测主体是人，主体区域是否带上人脸部分，0-不带人脸区域，裁剪类需求推荐带人脸，检索/识别类需求推荐不带人脸。默认 1 带人脸。
     *
     * @return array
     */
    public function objectDetect(string $image, int $with_face = 1): array {
        $data = [
            'image' => base64_encode($image),
            'with_face' => $with_face
        ];

        return $this->request(API_OBJECT_DETECT, $data);
    }

    /**
     * 动物识别接口
     *
     * @param string $image     图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param int    $top_num   返回预测得分 top 结果数，默认为 6
     * @param int    $baike_num 返回百科信息的结果数，默认不返回
     *
     * @return array
     */
    public function animalDetect(string $image, int $top_num = 6, int $baike_num = 0): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['top_num'] = $top_num;
        $data['baike_num'] = $baike_num;

        return $this->request(API_ANIMAL_DETECT, $data);
    }

    /**
     * 植物识别接口
     *
     * @param string $image     图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param int    $baike_num 返回百科信息的结果数，默认不返回
     *
     * @return array
     */
    public function plantDetect(string $image, int $baike_num = 0): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['baike_num'] = $baike_num;

        return $this->request(API_PLANT_DETECT, $data);
    }

    /**
     * Logo 识别 - 检索
     *
     * @param string $image      图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param bool   $custom_lib 是否只检索用户子库，true 则只检索用户子库，false（默认）为检索底库+用户子库
     *
     * @return array
     */
    public function logoDetect(string $image, bool $custom_lib = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['custom_lib'] = bool2Str($custom_lib);

        return $this->request(API_LOGO_DETECT, $data);
    }

    /**
     * Logo 识别 — 入库
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string $name  对应的品牌名称
     *
     * @return array
     */
    public function logoAdd(string $image, string $name): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['brief'] = json_encode(['name' => $name]);

        return $this->request(API_LOGO_ADD, $data);
    }

    /**
     * Logo 识别 - 删除
     *
     * @param string|null $image     大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string|null $cont_sign 图片签名
     *
     * @return array
     */
    public function logoDelete(string $image = null, string $cont_sign = null): array {
        try {
            $data = $this->genDataWithTripleCond($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_LOGO_DELETE, $data);
    }

    /**
     * 食材识别
     *
     * @param string $image   图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param int    $top_num 返回预测得分 top 结果数，如果为空或小于等于 0 默认为 5；如果大于 20 默认 20
     *
     * @return array
     */
    public function ingredient(string $image, int $top_num = 5): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data ['top_num'] = $top_num;

        return $this->request(API_INGREDIENT_DETECT, $data);
    }


    /**
     * 自定义菜品识别 — 入库
     *
     * @param string   $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string[] $brief 菜品名称摘要信息，检索时带回，不超过 256B
     *
     * @return array
     */
    public function customDishAdd(string $image, array $brief): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['brief'] = json_encode($brief);

        return $this->request(API_DISH_ADD, $data);
    }

    /**
     * 自定义菜品识别 — 检索
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     *
     * @return array
     */
    public function customDishSearch(string $image): array {
        return $this->request(API_DISH_SEARCH, $this->genDataWithDoubleImageType($image));
    }

    /**
     * 自定义菜品识别 — 删除
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string|null $cont_sign 图片签名
     *
     * @return array
     */
    public function customDishDelete(string $image = null, string $cont_sign = null): array {
        try {
            $data = $this->genDataWithTripleCond($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_DISH_DELETE, $data);
    }

    /**
     * 菜品识别
     *
     * @param string $image            图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param float  $filter_threshold 可以通过该参数调节识别效果，降低非菜识别率
     * @param int    $top_num          返回结果 top n，默认 5
     * @param int    $baike_num        返回百科信息的结果数，默认不返回
     *
     * @return array
     */
    public function dishDetect(string $image, float $filter_threshold = 0.95, int $top_num = 5, int $baike_num = 0): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['filter_threshold'] = $filter_threshold;
        $data['top_num'] = $top_num;
        $data['baike_num'] = $baike_num;

        return $this->request(API_DISH_DETECT, $data);
    }

    /**
     * 红酒识别
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     *
     * @return array
     */
    public function redWine(string $image): array {
        return $this->request(API_RED_WINE_DETECT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * 货币识别
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     *
     * @return array
     */
    public function currency(string $image): array {
        return $this->request(API_CURRENCY_DETECT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * 地标识别
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     *
     * @return array
     */
    public function landmark(string $image): array {
        return $this->request(API_LANDMARK_DETECT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * 花卉识别
     *
     * @param string $image     图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param int    $top_num   返回预测得分 top 结果数，默认为 5
     * @param int    $baike_num 返回百科信息的结果数，默认不返回
     *
     * @return array
     */
    public function flower(string $image, int $top_num = 5, int $baike_num = 0): array {
        $data = [
            'image' => base64_encode($image),
            'top_num' => $top_num,
            'baike_num' => $baike_num
        ];

        return $this->request(API_FLOWER_DETECT, $data);
    }

    /**
     * 车辆识别
     *
     * @param string $image     图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param int    $top_num   返回预测得分 top 结果数，默认为 5
     * @param int    $baike_num 返回百科信息的结果数，默认不返回
     *
     * @return array
     */
    public function carDetect(string $image, int $top_num = 5, int $baike_num = 0): array {
        $data = [
            'image' => base64_encode($image),
            'top_num' => $top_num,
            'baike_num' => $baike_num
        ];

        return $this->request(API_CAR_DETECT, $data);
    }

    /**
     * 车辆检测
     *
     * @url https://cloud.baidu.com/doc/IMAGERECOGNITION/s/fk3bcxi5z#%E8%BD%A6%E8%BE%86%E6%A3%80%E6%B5%8B
     *
     * @param string $image 图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array  $area  只统计该区域内的车辆数，缺省时为全图统计
     *
     * @return array
     */
    public function vehicleDetect(string $image, array $area = []): array {
        $data = [
            'image' => base64_encode($image),
            'area' => implode(',', $area)
        ];

        return $this->request(API_VEHICLE_DETECT, $data);
    }

    /**
     * 车辆外观损伤识别
     *
     * @param string $image 图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     *
     * @return array
     */
    public function vehicleDamage(string $image): array {
        return $this->request(API_VEHICLE_DAMAGE, ['image' => base64_encode($image)]);
    }

    /**
     * 门脸识别
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     *
     * @return array
     */
    public function facadeDetect(string $image): array {
        return $this->request(API_FACADE_DETECT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image      图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param float  $threshold  默认 0.9，可自定义阈值，支持精确到小数点后两位
     * @param int    $custom_lib 0 为只检索公库；1 为只检索自建库；2 为检索公库+自建库。其余数字为默认只检索公库
     *
     * @return array
     */
    public function facadeSearch(string $image, float $threshold = 0.9, int $custom_lib = 0): array {
        $data = [
            'image' => base64_encode($image),
            'threshold' => $threshold,
            'custom_lib' => $custom_lib
        ];

        return $this->request(API_FACADE_SEARCH, $data);
    }

    /**
     * 门脸识别 - 入库
     *
     * @param string $image 图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array  $brief 最长支持 512B，识别时接口返回，可以填入门脸名称、图片名称、门脸地理位置等信息
     *
     * @return array
     */
    public function facadeAdd(string $image, array $brief): array {
        $data = [
            'image' => base64_encode($image),
            'brief' => json_encode($brief)
        ];

        return $this->request(API_FACADE_ADD, $data);
    }

    /**
     * 门脸识别 - 删除
     *
     * @param string|null $image     图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string|null $cont_sign 门脸库内图片的签名
     *
     * @return array
     */
    public function facadeDelete(string $image = null, string $cont_sign = null): array {
        try {
            $data = $this->genDataWithTripleCond($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_FACADE_DELETE, $data);
    }

    /**
     * 图像多主体检测
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/png/bmp 格式
     *
     * @return array
     */
    public function multiObjectDetect(string $image): array {
        return $this->request(API_MULTI_OBJECT_DETECT, $this->genDataWithDoubleImageType($image));
    }
}
