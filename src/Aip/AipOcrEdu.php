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

class AipOcrEdu extends AipBase {

    use DataTrait;

    /**
     * 试卷分析与识别
     *
     * @url https://ai.baidu.com/ai-doc/OCR/jk9m7mj1l#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image
     * @param array  $options
     *
     * @return array
     */
    public function docAnalysis(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_DOC_ANALYSIS, $data);
    }

    /**
     * 公式识别
     *
     * @url https://ai.baidu.com/ai-doc/OCR/Ok3h7xxva#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image
     * @param string $recognize_granularity 是否定位单字符位置，big：不定位单字符位置；small：定位单字符位置。默认值为 big
     * @param bool   $detect_direction      是否检测图像朝向，默认不检测
     * @param bool   $disp_formula          是否分离输出公式识别结果
     *
     * @return array
     */
    public function formula(string $image, string $recognize_granularity = 'big',
                            bool $detect_direction = false, bool $disp_formula = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['recognize_granularity'] = $recognize_granularity;
        $data['detect_direction'] = bool2Str($detect_direction);
        $data['disp_formula'] = bool2Str($disp_formula);

        return $this->request(API_FORMULA, $data);
    }
}
