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

class AipImageClassify extends AipBase {

    /**
     * 通用物体识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     */
    public function advancedGeneral(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_ADVANCED_GENERAL, $data);
    }

    /**
     * 菜品识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     *   filter_threshold 默认0.95，可以通过该参数调节识别效果，降低非菜识别率.
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     */
    public function dishDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_DISH_DETECT, $data);
    }

    /**
     * 车辆识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     */
    public function carDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_CAR_DETECT, $data);
    }

    /**
     * 车辆检测接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   show 是否返回结果图（含统计值和跟踪框）。选true时返回渲染后的图片(base64)，其它无效值或为空则默认false。
     *   area
     *   只统计该区域内的车辆数，缺省时为全图统计。<br>逗号分隔，如‘x1,y1,x2,y2,x3,y3...xn,yn'，按顺序依次给出每个顶点的x、y坐标（默认尾点和首点相连），形成闭合多边形区域。<br>服务会做范围（顶点左边需在图像范围内）及个数校验（数组长度必须为偶数，且大于3个顶点）。只支持单个多边形区域，建议设置矩形框，即4个顶点。**坐标取值不能超过图像宽度和高度，比如1280的宽度，坐标值最大到1279**。
     * @return array
     */
    public function vehicleDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_VEHICLE_DETECT, $data);
    }

    /**
     * 车辆外观损伤识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function vehicleDamage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_VEHICLE_DAMAGE, $data);
    }

    /**
     * logo商标识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   custom_lib 是否只使用自定义logo库的结果，默认false：返回自定义库+默认库的识别结果
     * @return array
     */
    public function logoDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_LOGO_DETECT, $data);
    }

    /**
     * logo商标识别—添加接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief   - brief，检索时带回。此处要传对应的name与code字段，name长度小于100B，code长度小于150B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function logoAdd(string $image, string $brief, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request(API_LOGO_ADD, $data);
    }

    /**
     * logo 商标识别—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function logoDeleteByImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_LOGO_DELETE, $data);
    }

    /**
     * logo商标识别—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function logoDeleteBySign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request(API_LOGO_DELETE, $data);
    }

    /**
     * 动物识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为6
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     */
    public function animalDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_ANIMAL_DETECT, $data);
    }

    /**
     * 植物识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     */
    public function plantDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_PLANT_DETECT, $data);
    }

    /**
     * 图像主体检测接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   with_face 如果检测主体是人，主体区域是否带上人脸部分，0-不带人脸区域，其他-带人脸区域，裁剪类需求推荐带人脸，检索/识别类需求推荐不带人脸。默认取1，带人脸。
     * @return array
     */
    public function objectDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_OBJECT_DETECT, $data);
    }

    /**
     * 地标识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function landmark(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_LANDMARK_DETECT, $data);
    }

    /**
     * 花卉识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，默认为5
     *   baike_num 返回百科信息的结果数，默认不返回
     * @return array
     */
    public function flower(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_FLOWER_DETECT, $data);
    }

    /**
     * 食材识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   top_num 返回预测得分top结果数，如果为空或小于等于0默认为5；如果大于20默认20
     * @return array
     */
    public function ingredient(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_INGREDIENT_DETECT, $data);
    }

    /**
     * 红酒识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function redWine(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_RED_WINE_DETECT, $data);
    }

    /**
     * 货币识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function currency(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_CURRENCY_DETECT, $data);
    }

    /**
     * 自定义菜品识别—入库
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @return array
     * @description options列表:
     */
    public function customDishesAddImage(string $image, string $brief, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request(API_DISH_ADD, $data);
    }

    /**
     * 自定义菜品识别—检索
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function customDishesSearch(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_DISH_SEARCH, $data);
    }

    /**
     * 自定义菜品识别—删除
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function customDishesDeleteImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_DISH_DELETE, $data);
    }

    /**
     * 自定义菜品识别—删除
     *
     * @param string $contSign
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function customDishesDeleteContSign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request(API_DISH_DELETE, $data);
    }

    /**
     * 图像多主体检测
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function multiObjectDetect(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_MULTI_OBJECT_DETECT, $data);
    }

    /**
     * 组合接口-image
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $scenes
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @return array
     * @description options列表:
     */
    public function combinationByImage(string $image, array $scenes, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['scenes'] = $scenes;

        $data = array_merge($data, $options);

        return $this->request(API_COMBINATION, $data, ['Content-Type' => 'application/json;charset=utf-8']);
    }

    /**
     * 组合接口-imageUrl
     *
     * @param string $imageUrl - 图像数据url
     * @param array  $scenes
     * @param array  $options  - 可选参数对象，key: value 都为 string 类型
     *
     * @return array
     * @description options列表:
     */
    public function combinationByImageUrl(string $imageUrl, array $scenes, array $options = []): array {
        $data['imgUrl'] = $imageUrl;
        $data['scenes'] = $scenes;

        $data = array_merge($data, $options);

        return $this->request(API_COMBINATION, $data, ['Content-Type' => 'application/json;charset=utf-8']);
    }
}
