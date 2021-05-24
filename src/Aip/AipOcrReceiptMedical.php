<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/21
 * Time: 15:27
 */

namespace Baidu\Aip;

use Baidu\Aip\Lib\AipBase;
use Baidu\Aip\Lib\Traits\DataTrait;

class AipOcrReceiptMedical extends AipBase {

    use DataTrait;

    /**
     * 医疗发票识别
     *
     * @url https://ai.baidu.com/ai-doc/OCR/yke30j1hq#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image       图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $location    是否返回字段的位置信息
     * @param bool   $probability 是否返回字段识别结果的置信度
     *
     * @return array
     */
    public function medicalInvoice(string $image, bool $location = false, bool $probability = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['location'] = bool2Str($location);
        $data['probability'] = bool2Str($probability);

        return $this->request(API_MEDICAL_INVOICE, $data);
    }

    /**
     * 医疗费用结算单识别
     *
     * @url https://ai.baidu.com/ai-doc/OCR/Jke30ki7d#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image       图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $location    是否返回字段的位置信息
     * @param bool   $probability 是否返回字段识别结果的置信度
     *
     * @return array
     */
    public function medicalStatement(string $image, bool $location = false, bool $probability = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['location'] = bool2Str($location);
        $data['probability'] = bool2Str($probability);

        return $this->request(API_MEDICAL_STATEMENT, $data);
    }

    /**
     * 医疗费用明细识别
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function medicalDetail(string $image): array {
        return $this->request(API_MEDICAL_DETAIL, $this->genDataWithDoubleImageType($image));
    }

    /**
     * 病案首页识别
     *
     * @url https://ai.baidu.com/ai-doc/OCR/1ke30k2s2#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image       图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $location    是否返回字段的位置信息
     * @param bool   $probability 是否返回字段识别结果的置信度
     *
     * @return array
     */
    public function medicalRecord(string $image, bool $location = false, bool $probability = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['location'] = bool2Str($location);
        $data['probability'] = bool2Str($probability);

        return $this->request(API_MEDICAL_RECORD, $data);
    }

    /**
     * @param string $image
     * @param bool   $kv_business
     *
     * @return array
     */
    public function insuranceDocuments(string $image, bool $kv_business = true): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['kv_business'] = bool2Str($kv_business);

        return $this->request(API_INSURANCE_DOCUMENTS, $data);
    }
}
