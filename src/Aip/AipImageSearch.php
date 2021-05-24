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
use Baidu\Aip\Lib\Traits\DataTrait;
use Exception;

class AipImageSearch extends AipBase {

    use DataTrait;

    /**
     * 相似图片 — 入库
     *
     * @param string      $image 图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式。重复添加完全相同的图片会返回错误，提示不能重复入库
     * @param array       $brief 检索时原样带回，最长256B
     * @param string|null $tags  tag 间以逗号分隔，最多 2 个 tag，2 个 tag 无层级关系，检索时支持逻辑运算。样例："100,11" ；检索时可圈定分类维度进行检索
     *
     * @return array
     */
    public function similarAdd(string $image, array $brief = [], ?string $tags = null): array {
        $data = $this->genDataWithBriefAndTags($image, $brief, $tags);

        return $this->request(API_SIMILAR_ADD, $data);
    }

    /**
     * 相似图片 — 检索
     *
     * @url https://ai.baidu.com/ai-doc/IMAGESEARCH/3k3bczqz8#%E7%9B%B8%E4%BC%BC%E5%9B%BE%E7%89%87%E6%90%9C%E7%B4%A2%E6%A3%80%E7%B4%A2
     *
     * @param string $image 图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function similarSearch(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_SIMILAR_SEARCH, $data);
    }


    /**
     * 相似图片 — 删除
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array       $cont_sign 图片签名，最多支持 50 个
     *
     * @return array
     */
    public function similarDelete(string $image = null, array $cont_sign = []): array {
        try {
            $data = $this->genDataWithTripleCondMulti($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_SIMILAR_DELETE, $data);
    }

    /**
     * 相似图片 — 更新
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string|null $cont_sign 图片签名
     * @param array       $brief
     * @param string|null $tags
     *
     * @return array
     */
    public function similarUpdate(?string $image = null,
                                  ?string $cont_sign = null, array $brief = [], ?string $tags = null): array {
        try {
            $data = $this->genDataWithTripleCondAndBriefTags($image, $cont_sign, $brief, $tags);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_SIMILAR_UPDATE, $data);
    }

    /**
     * 相同图片 — 入库
     *
     * @url https://ai.baidu.com/ai-doc/IMAGESEARCH/Ck3bczreq#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string      $image 图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array       $brief 检索时原样带回，最长 256B
     * @param string|null $tags  tag 间以逗号分隔，最多两个 tag
     *
     * @return array
     */
    public function sameAdd(string $image, array $brief, string $tags = null): array {
        return $this->request(API_SAME_ADD, $this->genDataWithBriefAndTags($image, $brief, $tags));
    }

    /**
     * 相同图片 — 检索
     *
     * @url https://ai.baidu.com/ai-doc/IMAGESEARCH/Ck3bczreq#%E7%9B%B8%E5%90%8C%E5%9B%BE%E7%89%87%E6%90%9C%E7%B4%A2%E6%A3%80%E7%B4%A2
     *
     * @param string $image 图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function sameSearch(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_SAME_SEARCH, $data);
    }

    /**
     * 相同图片 — 删除
     *
     * @param string $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array  $cont_sign 图片签名，最多支持 50 个
     *
     * @return array
     */
    public function sameDelete(string $image, array $cont_sign = []): array {
        try {
            $data = $this->genDataWithTripleCondMulti($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_SAME_DELETE, $data);
    }

    /**
     * 相同图片 — 更新
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string|null $cont_sign 图片签名
     * @param array       $brief     更新的摘要信息，最长 256B
     * @param string|null $tags      更新的分类信息，tag 间以逗号分隔，最多 2 个 tag。样例："100,11"
     *
     * @return array
     */
    public function sameUpdate(?string $image = null,
                               ?string $cont_sign = null, array $brief = [], ?string $tags = null): array {
        try {
            $data = $this->genDataWithTripleCondAndBriefTags($image, $cont_sign, $brief, $tags);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_SAME_UPDATE, $data);
    }


    /**
     * 商品图片 — 入库
     *
     * @param string   $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array    $brief     检索时原样带回，最长 256B
     * @param int|null $class_id1 商品分类维度 1
     * @param int|null $class_id2 商品分类维度 2
     *
     * @return array
     */
    public function productAdd(string $image, array $brief, ?int $class_id1 = null, ?int $class_id2 = null): array {
        $data = $this->genDataWithDoubleImageType($image);

        $data['brief'] = json_encode($brief);

        if ($class_id1) {
            $data['class_id1'] = $class_id1;
        }

        if ($class_id2) {
            $data['class_id2'] = $class_id2;
        }

        return $this->request(API_PRODUCT_ADD, $data);
    }


    /**
     * 商品图片 — 检索
     *
     * @param string $image 图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function productSearch(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_PRODUCT_SEARCH, $data);
    }

    /**
     * 商品图片 — 删除
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array       $cont_sign 图片签名，最多支持 50 个
     *
     * @return array
     */
    public function productDelete(string $image = null, array $cont_sign = []): array {
        try {
            $data = $this->genDataWithTripleCondMulti($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_PRODUCT_DELETE, $data);
    }

    /**
     * 商品图片 — 更新
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string|null $cont_sign 图片签名
     * @param array       $brief     更新的摘要信息，最长 256B
     * @param int|null    $class_id1 更新的商品分类 1
     * @param int|null    $class_id2 更新的商品分类 2
     *
     * @return array
     */
    public function productUpdate(?string $image = null, ?string $cont_sign = null,
                                  array $brief = [], ?int $class_id1 = null, ?int $class_id2 = null): array {
        try {
            $data = $this->genDataWithTripleCond($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        if ($brief) {
            $data['brief'] = json_encode($brief);
        }

        if ($class_id1) {
            $data['class_id1'] = $class_id1;
        }

        if ($class_id2) {
            $data['class_id2'] = $class_id2;
        }

        return $this->request(API_PRODUCT_UPDATE, $data);
    }

    /**
     * 绘本图片 — 入库
     *
     * @param string      $image 图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array       $brief 检索时原样带回，最长 256B
     * @param string|null $tags  tag 间以逗号分隔，最多 2 个 tag，2 个 tag 无层级关系，检索时支持逻辑运算。样例："100,11" ；检索时可圈定分类维度进行检索
     *
     * @return array
     */
    public function pictureBookAdd(string $image, array $brief, ?string $tags = null): array {
        return $this->request(API_PICTURE_BOOK_ADD, $this->genDataWithBriefAndTags($image, $brief, $tags));
    }

    /**
     * 绘本图片 — 检索
     *
     * @url https://ai.baidu.com/ai-doc/IMAGESEARCH/uk7emw71x#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E-1
     *
     * @param string $image 图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array  $options
     *
     * @return array
     */
    public function pictureBookSearch(string $image, array $options = []): array {
        $data = array_merge($this->genDataWithDoubleImageType($image), $options);

        return $this->request(API_PICTURE_BOOK_SEARCH, $data);
    }

    /**
     * 绘本图片 — 删除
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param array       $cont_sign 图片签名，最多支持 50 个
     *
     * @return array
     */
    public function pictureBookDelete(?string $image = null, array $cont_sign = []): array {
        try {
            $data = $this->genDataWithTripleCondMulti($image, $cont_sign);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_PICTURE_BOOK_DELETE, $data);
    }

    /**
     * 绘本图片 — 更新
     *
     * @param string|null $image     图像数据或 URL，大小不超过 4M。最短边至少 50px，最长边最大 4096px，支持 jpg/png/bmp 格式
     * @param string|null $cont_sign 图片签名
     * @param array       $brief     更新的摘要信息，最长256B
     * @param string|null $tags      更新的分类信息，tag 间以逗号分隔，最多 2 个 tag。样例："100,11"
     *
     * @return array
     */
    public function pictureBookUpdate(?string $image = null,
                                      ?string $cont_sign = null, array $brief = [], ?string $tags = null): array {
        try {
            $data = $this->genDataWithTripleCondAndBriefTags($image, $cont_sign, $brief, $tags);
        } catch (Exception $e) {
            return [
                'error_code' => $e->getCode(),
                'error_msg' => $e->getMessage()
            ];
        }

        return $this->request(API_PICTURE_BOOK_UPDATE, $data);
    }
}
