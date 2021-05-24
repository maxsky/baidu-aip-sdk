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

class AipOcrVehicle extends AipBase {

    use DataTrait;

    /**
     * 行驶证识别
     *
     * @param string $image                图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $detect_direction     是否开启图像方向自动矫正功能
     * @param string $vehicle_license_side 识别行驶证主/副页，默认主页
     * @param bool   $unified              是否对输出字段进行归一化处理，将新/老版行驶证的“注册登记日期/注册日期”统一为”注册日期“进行输出
     *
     * @return array
     */
    public function vehicleLicense(string $image, bool $detect_direction = false,
                                   string $vehicle_license_side = 'front', bool $unified = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['detect_direction'] = bool2Str($detect_direction);
        $data['vehicle_license_side'] = $vehicle_license_side;
        $data['unified'] = bool2Str($unified);

        return $this->request(API_VEHICLE_LICENSE, $data);
    }

    /**
     * 驾驶证识别
     *
     * @param string $image                图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $detect_direction     是否检测朝向
     * @param bool   $unified_valid_period 是否归一化格式输出驾驶证的「有效起始日期」+「有效期限」及「有效期限」+「至」两种输出格式归一化为「有效起始日期」+「失效日期」
     *
     * @return array
     */
    public function drivingLicense(string $image, bool $detect_direction = false, bool $unified_valid_period = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['detect_direction'] = bool2Str($detect_direction);
        $data['unified_valid_period'] = bool2Str($unified_valid_period);

        return $this->request(API_DRIVING_LICENSE, $data);
    }

    /**
     * 车牌识别
     *
     * @param string $image        图像数据或 URL，大小不超过 4M，最短边至少 15px，最长边最大 4096px，支持 jpg/jpeg/png/bmp 格式
     * @param bool   $multi_detect 是否检测多张车牌
     * @param bool   $multi_scale  开启时提高对较小车牌的检测和识别
     *
     * @return array
     */
    public function licensePlate(string $image, bool $multi_detect = false, bool $multi_scale = false): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['multi_detect'] = bool2Str($multi_detect);
        $data['multi_scale'] = bool2Str($multi_scale);

        return $this->request(API_LICENSE_PLATE, $data);
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function vinCode(string $image): array {
        return $this->request(API_VIN_CODE, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function vehicleInvoice(string $image): array {
        return $this->request(API_VEHICLE_INVOICE, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function usedVehicleInvoice(string $image): array {
        return $this->request(API_USED_VEHICLE_INVOICE, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function vehicleCert(string $image): array {
        return $this->request(API_VEHICLE_CERT, $this->genDataWithDoubleImageType($image));
    }

    /**
     * @param string $image
     *
     * @return array
     */
    public function vehicleRegCert(string $image): array {
        return $this->request(API_VEHICLE_REG_CERT, $this->genDataWithDoubleImageType($image));
    }
}
