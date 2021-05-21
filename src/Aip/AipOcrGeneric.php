<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/21
 * Time: 15:25
 */

namespace Baidu\Aip;

use Baidu\Aip\Lib\AipBase;
use Baidu\Aip\Lib\Traits\DataTrait;

class AipOcrGeneric extends AipBase {

    use DataTrait;

    /**
     * 通用文字识别（高精度版）
     *
     * @url https://ai.baidu.com/ai-doc/OCR/1k3h7y3db#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function accurate(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_ACCURATE, $data);
    }

    /**
     * 通用文字识别（高精度含位置版）
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function accurateLocation(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_ACCURATE_LOC, $data);
    }

    /**
     * 通用文字识别（标准版）
     *
     * @url https://ai.baidu.com/ai-doc/OCR/zk3h7xz52#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image 图像数据或 URL，大小不超过4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     *
     */
    public function general(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_GENERAL, $data);
    }

    /**
     * 通用文字识别（含位置信息）
     *
     * @url https://ai.baidu.com/ai-doc/OCR/vk3h7y58v#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     *
     */
    public function generalLocation(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_GENERAL_LOC, $data);
    }

    /**
     * 办公文档识别
     *
     * @url https://ai.baidu.com/ai-doc/OCR/ykg9c09ji#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image 图像数据，大小不超过 4M，最短边至少 64px，最长边最大 4096px
     * @param array  $options
     *
     * @return array
     */
    public function docAnalysisOffice(string $image, array $options = []): array {
        $options['image'] = base64_encode($image);

        return $this->request(API_DOC_ANALYSIS_OFFICE, $options);
    }

    /**
     * 网络图片文字识别
     *
     * @param string $image            图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $detect_direction 是否检测图像朝向，默认不检测
     * @param bool   $detect_language  是否检测语言，默认不检测
     *
     * @return array
     */
    public function webImage(string $image, bool $detect_direction = false, bool $detect_language = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['detect_direction'] = bool2Str($detect_direction);
        $data['detect_language'] = bool2Str($detect_language);

        return $this->request(API_WEB_IMAGE, $data);
    }

    /**
     * 网络图片文字识别（含位置信息版）
     *
     * @url https://ai.baidu.com/ai-doc/OCR/Nkaz574we#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，像素乘积不超过2048*2048（1024*1024以内图像处理效果最佳）。
     *                      支持 jpg/jpeg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function webImageLocation(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_WEB_IMAGE_LOC, $data);
    }

    /**
     * 手写文字识别
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function handwriting(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_HANDWRITING, $data);
    }

    /**
     * 数字识别
     *
     * @param string $image                 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param string $recognize_granularity 是否定位单字符位置，big：不定位单字符位置，默认值；small：定位单字符位置
     * @param bool   $detect_direction      是否检测图像朝向，默认不检测
     *
     * @return array
     */
    public function numbers(string $image,
                            string $recognize_granularity = 'small', bool $detect_direction = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['recognize_granularity'] = $recognize_granularity;
        $data['detect_direction'] = bool2Str($detect_direction);

        return $this->request(API_NUMBERS, $data);
    }

    /**
     * 表格文字识别（同步接口）
     *
     * @param string $image        图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param string $table_border 识别表格对象是否有框线。缺省或 table_border = normal，可识别框线齐全的常规表格，
     *                             table_border = none，可识别无框线表格。默认为 normal
     *
     * @return array
     */
    public function tableSync(string $image, string $table_border = 'normal'): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['table_border'] = $table_border;

        return $this->request(API_TABLE_SYNC, $data);
    }

    /**
     * 表格文字识别（异步接口）- 提交请求
     *
     * @param string $image             图像数据，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $is_sync           是否同步返回识别结果。取值为“false”，需通过获取结果接口获取识别结果；取值为“true”，同步返回识别结果，无需调用获取结果接口。默认取值为“false”
     * @param string $request_type      当 is_sync=true 时，需在提交请求时即传入此参数指定获取结果的类型，
     *                                  取值为“excel”时返回xls文件的地址，取值为“json”时返回json格式的字符串。
     *                                  当is_sync=false 时，需在获取结果时指定此参数。
     *
     * @return array
     */
    public function tableAsync(string $image, bool $is_sync = false, string $request_type = 'excel'): array {
        $data = [
            'image' => base64_encode($image),
            'is_sync' => bool2Str($is_sync),
            'request_type' => $request_type
        ];

        return $this->request(API_TABLE_ASYNC, $data);
    }

    /**
     * 表格文字识别（异步接口）- 获取结果
     *
     * @param string $request_id  发送表格文字识别请求时返回的 request id
     * @param string $result_type 期望获取结果的类型，取值为“excel”时返回xls文件的地址，取值为“json”时返回json格式的字符串，默认为”excel”
     *
     * @return array
     */
    public function tableAsyncGetResult(string $request_id, string $result_type = 'excel'): array {
        $data = [
            'request_id' => $request_id,
            'result_type' => $result_type
        ];

        return $this->request(API_TABLE_ASYNC_GET_RESULT, $data);
    }

    /**
     * 二维码识别
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function qrcode(string $image): array {
        return $this->request(API_QRCODE, $this->genDataWithDoubleImageType($image));
    }
}
