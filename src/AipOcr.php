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

class AipOcr extends AipBase {

    /**
     * 通用文字识别接口
     *
     * @url https://cloud.baidu.com/doc/OCR/s/zk3h7xz52#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string|null $image   图像数据，base64 编码后进行 urlencode，要求 base64 编码和 urlencode 后大小不超过4M，
     *                             最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式，
     *                             当 image 字段存在时 url 字段失效
     * @param string|null $url     图片完整 URL，URL 长度不超过 1024 字节，URL 对应的图片 base64 编码后大小不超过 4M，
     *                             最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式，
     *                             当 image 字段存在时 url 字段失效，不支持 https 的图片链接
     * @param array       $options 可选参数
     *
     * @return array
     *
     */
    public function basicGeneral(?string $image = null, ?string $url = null, array $options = []): array {
        if (!$image && !$url) {
            return [
                'error_code' => 216101,
                'error_msg' => 'not enough param'
            ];
        }

        if ($image) {
            $data['image'] = base64_encode($image);
        } else {
            $data['url'] = $url;
        }

        $data = array_merge($data, $options);

        return $this->request(API_GENERAL_BASIC, $data);
    }

    /**
     * 通用文字识别（高精度版）接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     */
    public function basicAccurate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_ACCURATE_BASIC, $data);
    }

    /**
     * 通用文字识别（含位置信息版）接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>-
     *   GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语； detect_direction
     *   是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。 detect_language
     *   是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语） vertexes_location 是否返回文字外接多边形顶点位置，不支持单字位置。默认为false probability 是否返回识别结果中每一行的置信度
     * @return array
     */
    public function general(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_GENERAL, $data);
    }

    /**
     * 通用文字识别（含位置信息版）接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>-
     *   GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语； detect_direction
     *   是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。 detect_language
     *   是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语） vertexes_location 是否返回文字外接多边形顶点位置，不支持单字位置。默认为false probability 是否返回识别结果中每一行的置信度
     * @return array
     */
    public function generalUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_GENERAL, $data);
    }

    /**
     * 通用文字识别（含位置高精度版）接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   vertexes_location 是否返回文字外接多边形顶点位置，不支持单字位置。默认为false
     *   probability 是否返回识别结果中每一行的置信度
     * @return array
     */
    public function accurate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_ACCURATE, $data);
    }

    /**
     * 通用文字识别（含生僻字版）接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>-
     *   GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语； detect_direction
     *   是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。 detect_language
     *   是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语） probability 是否返回识别结果中每一行的置信度
     * @return array
     */
    public function enhancedGeneral(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_GENERAL_ENHANCED, $data);
    }

    /**
     * 通用文字识别（含生僻字版）接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   language_type 识别语言类型，默认为CHN_ENG。可选值包括：<br>- CHN_ENG：中英文混合；<br>- ENG：英文；<br>- POR：葡萄牙语；<br>- FRE：法语；<br>-
     *   GER：德语；<br>- ITA：意大利语；<br>- SPA：西班牙语；<br>- RUS：俄语；<br>- JAP：日语；<br>- KOR：韩语； detect_direction
     *   是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。 detect_language
     *   是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语） probability 是否返回识别结果中每一行的置信度
     * @return array
     */
    public function enhancedGeneralUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_GENERAL_ENHANCED, $data);
    }

    /**
     * 网络图片文字识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     * @return array
     */
    public function webImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_WEB_IMAGE, $data);
    }

    /**
     * 网络图片文字识别接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>-
     *   false：不检测朝向。
     *   detect_language 是否检测语言，默认不检测。当前支持（中文、英语、日语、韩语）
     * @return array
     */
    public function webImageUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_WEB_IMAGE, $data);
    }

    /**
     * 身份证识别接口
     *
     * @param string $image      - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $idCardSide - front：身份证含照片的一面；back：身份证带国徽的一面
     * @param array  $options    - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   detect_risk 是否开启身份证风险类型(身份证复印件、临时身份证、身份证翻拍、修改过的身份证)功能，默认不开启，即：false。可选值:true-开启；false-不开启
     * @return array
     */
    public function idCard(string $image, string $idCardSide, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['id_card_side'] = $idCardSide;

        $data = array_merge($data, $options);

        return $this->request(API_ID_CARD, $data);
    }

    /**
     * 银行卡识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function bankcard(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_BANKCARD, $data);
    }

    /**
     * 驾驶证识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     * @return array
     */
    public function drivingLicense(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_DRIVING_LICENSE, $data);
    }

    /**
     * 行驶证识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     *   accuracy normal 使用快速服务，1200ms左右时延；缺省或其它值使用高精度服务，1600ms左右时延
     * @return array
     */
    public function vehicleLicense(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_VEHICLE_LICENSE, $data);
    }

    /**
     * 车牌识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   multi_detect 是否检测多张车牌，默认为false，当置为true的时候可以对一张图片内的多张车牌进行识别
     * @return array
     */
    public function licensePlate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_LICENSE_PLATE, $data);
    }

    /**
     * 营业执照识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function businessLicense(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_BUSINESS_LICENSE, $data);
    }

    /**
     * 通用票据识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   probability 是否返回识别结果中每一行的置信度
     *   accuracy normal 使用快速服务，1200ms左右时延；缺省或其它值使用高精度服务，1600ms左右时延
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     * @return array
     */
    public function receipt(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_RECEIPT, $data);
    }

    /**
     * 火车票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function trainTicket(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_TRAIN_TICKET, $data);
    }

    /**
     * 火车票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function trainTicketUrl(string $image, array $options = []): array {
        $data['url'] = $image;

        $data = array_merge($data, $options);

        return $this->request(API_TRAIN_TICKET, $data);
    }

    /**
     * 出租车票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function taxiReceipt(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_TAXI_RECEIPT, $data);
    }

    /**
     * 出租车票识别接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function taxiReceiptUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_TAXI_RECEIPT, $data);
    }

    /**
     * 表格文字识别同步接口接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function form(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_FORM, $data);
    }

    /**
     * 表格文字识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function tableRecognitionAsync(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_TABLE_RECOGNIZE, $data);
    }

    /**
     * 表格识别结果接口
     *
     * @param string $requestId - 发送表格文字识别请求时返回的request id
     * @param array  $options   - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   result_type 期望获取结果的类型，取值为“excel”时返回xls文件的地址，取值为“json”时返回json格式的字符串,默认为”excel”
     * @return array
     */
    public function getTableRecognitionResult(string $requestId, array $options = []): array {
        $data['request_id'] = $requestId;

        $data = array_merge($data, $options);

        return $this->request(API_TABLE_GET_RESULT, $data);
    }

    /**
     * VIN码识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function vinCode(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_VIN_CODE, $data);
    }

    /**
     * VIN码识别接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @return array
     * @description options列表:
     */
    public function vinCodeUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_VIN_CODE, $data);
    }

    /**
     * 定额发票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function quotaInvoice(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_QUOTA_INVOICE, $data);
    }

    /**
     * 户口本识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function householdRegister(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_HOUSEHOLD_REGISTER, $data);
    }

    /**
     * 港澳通行证识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function HKMacauExitEntryPermit(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_HK_MACAU_EXIT_ENTRY_PERMIT, $data);
    }

    /**
     * 台湾通行证识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function taiwanExitEntryPermit(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_TAIWAN_EXIT_ENTRY_PERMIT, $data);
    }

    /**
     * 出生医学证明识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function birthCertificate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_BIRTH_CERTIFICATE, $data);
    }

    /**
     * 机动车销售发票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function vehicleInvoice(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_VEHICLE_INVOICE, $data);
    }

    /**
     * 车辆合格证识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function vehicleCertificate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_VEHICLE_CERTIFICATE, $data);
    }

    /**
     * 税务局通用机打发票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   location 是否输出位置信息，true：输出位置信息，false：不输出位置信息，默认false
     * @return array
     */
    public function invoice(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_INVOICE, $data);
    }

    /**
     * 行程单识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   location 是否输出位置信息，true：输出位置信息，false：不输出位置信息，默认false
     * @return array
     */
    public function airTicket(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_AIR_TICKET, $data);
    }

    /**
     * 保单识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   rkv_business 是否进行商业逻辑处理，rue：进行商业逻辑处理，false：不进行商业逻辑处理，默认true
     * @return array
     */
    public function insuranceDocuments(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_INSURANCE_DOCUMENTS, $data);
    }

    /**
     * 增值税发票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function vatInvoice(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_VAT_INVOICE, $data);
    }

    /**
     * 增值税发票识别接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   string type 进行识别的增值税发票类型，默认为 normal，可缺省
     *           - normal：可识别增值税普票、专票、电子发票
     *           - roll：可识别增值税卷票
     * @return array
     */
    public function vatInvoiceUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_VAT_INVOICE, $data);
    }

    /**
     * 增值税发票识别接口
     *
     * @param string $pdfFile
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表
     *   string type 进行识别的增值税发票类型，默认为 normal，可缺省
     *           - normal：可识别增值税普票、专票、电子发票
     *           - roll：可识别增值税卷票
     * @return array
     */
    public function vatInvoicePdf(string $pdfFile, array $options = []): array {
        $data['pdf_file'] = base64_encode($pdfFile);

        $data = array_merge($data, $options);

        return $this->request(API_VAT_INVOICE, $data);
    }

    /**
     * 二维码识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function qrcode(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_QRCODE, $data);
    }

    /**
     * 数字识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     *   detect_direction 是否检测图像朝向，默认不检测，即：false。朝向是指输入图像是正常方向、逆时针旋转90/180/270度。可选值包括:<br>- true：检测朝向；<br>- false：不检测朝向。
     * @return array
     */
    public function numbers(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_NUMBERS, $data);
    }

    /**
     * 彩票识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     * @return array
     */
    public function lottery(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_LOTTERY, $data);
    }

    /**
     * 护照识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function passport(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_PASSPORT, $data);
    }

    /**
     * 名片识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function businessCard(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_BUSINESS_CARD, $data);
    }

    /**
     * 手写文字识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     * @return array
     */
    public function handwriting(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_HANDWRITING, $data);
    }

    /**
     * 自定义模板文字识别接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   templateSign 您在自定义文字识别平台制作的模板的ID
     *   classifierId
     *   分类器Id。这个参数和templateSign至少存在一个，优先使用templateSign。存在templateSign时，表示使用指定模板；如果没有templateSign而有classifierId，表示使用分类器去判断使用哪个模板
     * @return array
     */
    public function custom(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_RECOGNISE, $data);
    }

    /**
     * 同步请求
     *
     * @param string $image   图像读取
     * @param array  $options 接口可选参数
     * @param int    $timeout
     *
     * @return array
     */
    public function tableRecognition(string $image, array $options = [], int $timeout = 10000): array {
        $result = $this->tableRecognitionAsync($image);

        if (isset($result['error_code'])) {
            return $result;
        }

        $requestId = $result['result'][0]['request_id'];
        $count = ceil($timeout / 1000);

        for ($i = 0; $i < $count; $i++) {
            $result = $this->getTableRecognitionResult($requestId, $options);
            // 完成
            if ($result['result']['ret_code'] == 3) {
                break;
            }

            sleep(1);
        }

        return $result;
    }

    /**
     * 文档版面分析与识别
     *
     * @param string $image
     * @param string $languageType
     * @param string $resultType
     * @param array  $options
     *
     * @return string|string[]|null
     */
    public function docAnalysis(string $image, string $languageType, string $resultType, array $options = []) {
        $data['image'] = base64_encode($image);

        if ($languageType == null || in_array($languageType, ['CHN_ENG', 'ENG']) <> 1) {
            return "please provide correct param: language_type ";
        }

        $data['language_type'] = $languageType;

        if ($resultType == null || in_array($resultType, ['big', 'small']) <> 1) {
            return "please provide correct param: result_type ";
        }

        $data['result_type'] = $resultType;

        $data = array_merge($data, $options);

        return $this->request(API_DOC_ANALYSIS, $data);
    }

    /**
     * 仪器仪表盘读数识别
     *
     * @param string $image
     * @param array  $options
     *
     * @return string[]|null
     */
    public function meter(string $image, array $options = []): ?array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_METER, $data);
    }

    /**
     * 网络图片文字识别（含位置版）
     *
     * @param string $image
     * @param array  $options
     *
     * @return array|null
     */
    public function webImageLoc(string $image, array $options = []): ?array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_WEB_IMAGE_LOC, $data);
    }
}
