<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/21
 * Time: 12:42
 */

namespace Baidu\Aip\Lib\Traits;

use Exception;

trait DataTrait {

    /**
     * @param string $image
     *
     * @return array
     */
    protected function genDataWithDoubleImageType(string $image): array {
        if (isUrl($image)) {
            $data['url'] = $image;
        } else {
            $data['image'] = base64_encode($image);
        }

        return $data;
    }

    /**
     * @param string      $image
     * @param array       $brief
     * @param string|null $tags
     *
     * @return array
     */
    protected function genDataWithBriefAndTags(string $image, array $brief = [], ?string $tags = null): array {
        $data = $this->genDataWithDoubleImageType($image);

        if ($brief) {
            $data['brief'] = json_encode($brief);
        }

        if ($tags) {
            $data['tags'] = $tags;
        }

        return $data;
    }

    /**
     * @param string|null $image
     * @param string|null $cont_sign
     *
     * @return array
     * @throws Exception
     */
    protected function genDataWithTripleCond(?string $image = null, ?string $cont_sign = null): array {
        if (!$image && !$cont_sign) {
            throw new Exception(ERROR_MSG[216101], 216101);
        }

        if ($image) {
            $data = $this->genDataWithDoubleImageType($image);
        } else {
            $data['cont_sign'] = $cont_sign;
        }

        return $data;
    }

    /**
     * @param string|null $image
     * @param array       $cont_sign
     *
     * @return array
     * @throws Exception
     */
    protected function genDataWithTripleCondMulti(?string $image = null, array $cont_sign = []): array {
        if (!$image && !$cont_sign) {
            throw new Exception(ERROR_MSG[216101], 216101);
        }

        if ($image) {
            $data = $this->genDataWithDoubleImageType($image);
        } else {
            $data['cont_sign'] = implode(',', $cont_sign);
        }

        return $data;
    }

    /**
     * @param string|null $image
     * @param string|null $cont_sign
     * @param array       $brief
     * @param string|null $tags
     *
     * @return array
     * @throws Exception
     */
    protected function genDataWithTripleCondAndBriefTags(?string $image = null, ?string $cont_sign = null,
                                                         array $brief = [], ?string $tags = null): array {
        $data = $this->genDataWithTripleCond($image, $cont_sign);

        if ($brief) {
            $data['brief'] = json_encode($brief);
        }

        if ($tags) {
            $data['tags'] = $tags;
        }

        return $data;
    }
}
