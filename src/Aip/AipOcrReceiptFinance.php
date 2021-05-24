<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/21
 * Time: 15:26
 */

namespace Baidu\Aip;

use Baidu\Aip\Lib\AipBase;
use Baidu\Aip\Lib\Traits\DataTrait;

class AipOcrReceiptFinance extends AipBase {

    use DataTrait;

    /**
     * @param string|null $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param string|null $pdf_file
     * @param string      $type
     *
     * @return array
     */
    public function vatInvoice(?string $image = null, ?string $pdf_file = null, string $type = 'normal'): array {
        if ($image) {
            $data = $this->genDataWithDoubleImageType($image);
        } else {
            $data['pdf_file'] = base64_encode($pdf_file);
        }

        $data['type'] = $type;

        return $this->request(API_VAT_INVOICE, $data);
    }

    /**
     * 增值税发票验真
     *
     * @url https://ai.baidu.com/ai-doc/OCR/cklbnrnwe#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $invoice_code 发票代码
     * @param string $invoice_num  发票号码
     * @param string $invoice_date 开票日期。格式 YYYYMMDD，例：20210101
     * @param string $invoice_type 发票种类
     * @param string $check_code   校验码。填写发票校验码后 6 位，增值税电子专票、普票、电子普票、卷票、通行费增值税电子普通发票此参数不可为空，其他类型发票可为空
     * @param string $total_amount 不含税金额。发票种类为增值税专票、电子专票、货运专票、机动车销售发票、二手车销售发票时此参数不可为空（二手车销售发票填写发票车价合计），其他类型发票可为空
     *
     * @return array
     */
    public function vatInvoiceVerify(string $invoice_code, string $invoice_num, string $invoice_date,
                                     string $invoice_type, string $check_code = '', string $total_amount = ''): array {
        $data = [
            'invoice_code' => $invoice_code,
            'invoice_num' => $invoice_num,
            'invoice_date' => $invoice_date,
            'invoice_type' => $invoice_type,
            'check_code' => $check_code,
            'total_amount' => $total_amount
        ];

        return $this->request(API_VAT_INVOICE_VERIFY, $data);
    }

    /**
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function quotaInvoice(string $image): array {
        return $this->request(API_QUOTA_INVOICE, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $location
     *
     * @return array
     */
    public function invoice(string $image, bool $location = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['location'] = bool2Str($location);

        return $this->request(API_INVOICE, $data);
    }

    /**
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function trainTicket(string $image): array {
        return $this->request(API_TRAIN_TICKET, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function taxiReceipt(string $image): array {
        return $this->request(API_TAXI_RECEIPT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image        图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $multi_detect 控制是否开启多航班信息识别功能
     *
     * @return array
     */
    public function airTicket(string $image, bool $multi_detect = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['multi_detect'] = bool2Str($multi_detect);

        return $this->request(API_AIR_TICKET, $data);
    }

    /**
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function busTicket(string $image): array {
        return $this->request(API_BUS_TICKET, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function tollInvoice(string $image): array {
        return $this->request(API_TOLL_INVOICE, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     *
     * @return array
     */
    public function ferryTicket(string $image): array {
        return $this->request(API_FERRY_TICKET, $this->genDataWithDoubleImageType($image));
    }

    /**
     * 通用票据识别
     *
     * @url https://ai.baidu.com/ai-doc/OCR/6k3h7y11b#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image 图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function receipt(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_RECEIPT, $data);
    }
}
