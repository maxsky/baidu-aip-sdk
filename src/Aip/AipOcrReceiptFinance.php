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
     * @param string|null $image
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
     * @param string $invoice_code
     * @param string $invoice_num
     * @param string $invoice_date
     * @param string $invoice_type
     * @param string $check_code
     * @param string $total_amount
     *
     * @return array
     */
    public function vatInvoiceVerify(string $invoice_code, string $invoice_num, string $invoice_date,
                                     string $invoice_type, string $check_code, string $total_amount): array {
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
     * @param string $image
     *
     * @return array
     */
    public function quotaInvoice(string $image): array {
        return $this->request(API_QUOTA_INVOICE, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     * @param bool   $location
     *
     * @return array
     */
    public function invoice(string $image, bool $location = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['location'] = bool2Str($location);

        return $this->request(API_INVOICE, $data);
    }

    public function trainTicket(string $image) {

    }
}
