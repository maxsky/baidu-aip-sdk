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

class AipOcrCard extends AipBase {

    use DataTrait;

    /**
     * @param string $image
     * @param array  $options
     *
     * @return array
     */
    public function idCard(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_ID_CARD, $data);
    }

    /**
     * @param string $image
     * @param bool   $detect_direction
     *
     * @return array
     */
    public function bankcard(string $image, bool $detect_direction = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['detect_direction'] = bool2Str($detect_direction);

        return $this->request(API_BANKCARD, $data);
    }

    /**
     * @param string $image
     * @param bool   $detect_direction
     *
     * @return array
     */
    public function businessLicense(string $image, bool $detect_direction = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['detect_direction'] = bool2Str($detect_direction);

        return $this->request(API_BUSINESS_LICENSE, $data);
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function businessCard(string $image): array {
        return $this->request(API_BUSINESS_CARD, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function passport(string $image): array {
        return $this->request(API_PASSPORT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function HKMacauExitEntryPermit(string $image): array {
        return $this->request(API_HK_MACAU_EXIT_ENTRY_PERMIT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function taiwanExitEntryPermit(string $image): array {
        return $this->request(API_TAIWAN_EXIT_ENTRY_PERMIT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function householdRegister(string $image): array {
        return $this->request(API_HOUSEHOLD_REGISTER, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function birthCertificate(string $image): array {
        return $this->request(API_BIRTH_CERTIFICATE, ['image' => base64_encode($image)]);
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function multiCardClassify(string $image): array {
        return $this->request(API_MULTI_CARD_CLASSIFY, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     * @param array  $options
     *
     * @return array
     */
    public function idCardEnc(string $image, array $options = []): array {
        $data = array_merge([
            'image' => base64_encode($image)
        ], $options);

        return $this->request(API_ID_CARD_ENC, $data);
    }
}
