<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/21
 * Time: 15:28
 */

namespace Baidu\Aip;

use Baidu\Aip\Lib\AipBase;
use Baidu\Aip\Lib\Traits\DataTrait;

class AipOcrOther extends AipBase {

    use DataTrait;

    /**
     * @param string $image
     * @param bool   $probability   是否返回每行识别结果的置信度
     * @param bool   $poly_location 位置信息返回形式
     *
     * @return array
     */
    public function meter(string $image, bool $probability = false, bool $poly_location = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['probability'] = bool2Str($probability);
        $data['poly_location'] = bool2Str($poly_location);

        return $this->request(API_METER, $data);
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function seal(string $image): array {
        return $this->request(API_SEAL, ['image' => base64_encode($image)]);
    }

    /**
     * @param string $image
     * @param string $recognize_granularity
     *
     * @return array
     */
    public function lottery(string $image, string $recognize_granularity = 'small'): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['recognize_granularity'] = $recognize_granularity;

        return $this->request(API_LOTTERY, $data);
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function facade(string $image): array {
        return $this->request(API_FACADE, ['image' => base64_encode($image)]);
    }

    /**
     * @param string $image
     * @param bool   $detect_direction
     * @param bool   $detect_null_word
     * @param bool   $probability
     *
     * @return array
     */
    public function intelligentOcr(string $image, bool $detect_direction = false,
                                   bool $detect_null_word = false, bool $probability = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['detect_direction'] = bool2Str($detect_direction);
        $data['detect_null_word'] = bool2Str($detect_null_word);
        $data['probability'] = bool2Str($probability);

        return $this->request(API_INTELLIGENT, $data);
    }
}
