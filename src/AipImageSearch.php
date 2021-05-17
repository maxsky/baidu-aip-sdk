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

class AipImageSearch extends AipBase {

    /**
     * 相同图检索—入库接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief   - 检索时原样带回,最长256B。
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function sameHqAdd(string $image, string $brief, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_ADD, $data);
    }

    /**
     * 相同图检索—入库接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param string $brief   - 检索时原样带回,最长256B。
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function sameHqAddUrl(string $url, string $brief, array $options = []): array {
        $data['url'] = $url;
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_ADD, $data);
    }

    /**
     * 相同图检索—检索接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     *   tag_logic 检索时tag之间的逻辑， 0：逻辑and，1：逻辑or
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function sameHqSearch(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_SEARCH, $data);
    }

    /**
     * 相同图检索—检索接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     *   tag_logic 检索时tag之间的逻辑， 0：逻辑and，1：逻辑or
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function sameHqSearchUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_SEARCH, $data);
    }

    /**
     * 相同图检索—更新接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function sameHqUpdate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_UPDATE, $data);
    }

    /**
     * 相同图检索—更新接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function sameHqUpdateUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_UPDATE, $data);
    }

    /**
     * 相同图检索—更新接口
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function sameHqUpdateContSign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_UPDATE, $data);
    }

    /**
     * 相同图检索—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function sameHqDeleteByImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_DELETE, $data);
    }

    /**
     * 相同图检索—删除接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function sameHqDeleteByUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_DELETE, $data);
    }

    /**
     * 相同图检索—删除接口
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function sameHqDeleteBySign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request(API_SAME_HQ_DELETE, $data);
    }

    /**
     * 相似图检索—入库接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief   - 检索时原样带回,最长256B。
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function similarAdd(string $image, string $brief, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request(API_SIMILAR_ADD, $data);
    }

    /**
     * 相似图检索—入库接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param string $brief   - 检索时原样带回,最长256B。
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function similarAddUrl(string $url, string $brief, array $options = []): array {
        $data['url'] = $url;
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request(API_SIMILAR_ADD, $data);
    }

    /**
     * 相似图检索—检索接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     *   tag_logic 检索时tag之间的逻辑， 0：逻辑and，1：逻辑or
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function similarSearch(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->similarSearchUrl, $data);
    }

    /**
     * 相似图检索—检索接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     *   tag_logic 检索时tag之间的逻辑， 0：逻辑and，1：逻辑or
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function similarSearchUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->similarSearchUrl, $data);
    }

    /**
     * 相似图检索—更新接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function similarUpdate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->similarUpdateUrl, $data);
    }

    /**
     * 相似图检索—更新接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function similarUpdateUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->similarUpdateUrl, $data);
    }

    /**
     * 相似图检索—更新接口
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   tags 1 - 65535范围内的整数，tag间以逗号分隔，最多2个tag。样例："100,11" ；检索时可圈定分类维度进行检索
     * @return array
     */
    public function similarUpdateContSign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->similarUpdateUrl, $data);
    }

    /**
     * 相似图检索—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function similarDeleteByImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->similarDeleteUrl, $data);
    }

    /**
     * 相似图检索—删除接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function similarDeleteByUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->similarDeleteUrl, $data);
    }

    /**
     * 相似图检索—删除接口
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function similarDeleteBySign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->similarDeleteUrl, $data);
    }

    /**
     * 商品检索—入库接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief   -
     *                        检索时原样带回,最长256B。**请注意，检索接口不返回原图，仅反馈当前填写的brief信息，所以调用该入库接口时，brief信息请尽量填写可关联至本地图库的图片id或者图片url、图片名称等信息**
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   class_id1 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     * @return array
     */
    public function productAdd(string $image, string $brief, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request($this->productAddUrl, $data);
    }

    /**
     * 商品检索—入库接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param string $brief   -
     *                        检索时原样带回,最长256B。**请注意，检索接口不返回原图，仅反馈当前填写的brief信息，所以调用该入库接口时，brief信息请尽量填写可关联至本地图库的图片id或者图片url、图片名称等信息**
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   class_id1 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     * @return array
     */
    public function productAddUrl(string $url, string $brief, array $options = []): array {
        $data['url'] = $url;
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request($this->productAddUrl, $data);
    }

    /**
     * 商品检索—检索接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   class_id1 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function productSearch(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->productSearchUrl, $data);
    }

    /**
     * 商品检索—检索接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   class_id1 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-65535范围内的整数。检索时可圈定该分类维度进行检索
     *   pn 分页功能，起始位置，例：0。未指定分页时，默认返回前300个结果；接口返回数量最大限制1000条，例如：起始位置为900，截取条数500条，接口也只返回第900 - 1000条的结果，共计100条
     *   rn 分页功能，截取条数，例：250
     * @return array
     */
    public function productSearchUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->productSearchUrl, $data);
    }

    /**
     * 商品检索—更新接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   class_id1 更新的商品分类1，支持1-65535范围内的整数。
     *   class_id2 更新的商品分类2，支持1-65535范围内的整数。
     * @return array
     */
    public function productUpdate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->productUpdateUrl, $data);
    }

    /**
     * 商品检索—更新接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   class_id1 更新的商品分类1，支持1-65535范围内的整数。
     *   class_id2 更新的商品分类2，支持1-65535范围内的整数。
     * @return array
     */
    public function productUpdateUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->productUpdateUrl, $data);
    }

    /**
     * 商品检索—更新接口
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   brief 更新的摘要信息，最长256B。样例：{"name":"周杰伦", "id":"666"}
     *   class_id1 更新的商品分类1，支持1-65535范围内的整数。
     *   class_id2 更新的商品分类2，支持1-65535范围内的整数。
     * @return array
     */
    public function productUpdateContSign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->productUpdateUrl, $data);
    }

    /**
     * 商品检索—删除接口
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function productDeleteByImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->productDeleteUrl, $data);
    }

    /**
     * 商品检索—删除接口
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function productDeleteByUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->productDeleteUrl, $data);
    }

    /**
     * 商品检索—删除接口
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function productDeleteBySign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->productDeleteUrl, $data);
    }

    /**
     * 绘本图片搜索—入库-image
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $brief   - 简介
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookAddImage(string $image, string $brief, array $options = []): array {
        $data['image'] = base64_encode($image);
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookAdd, $data);
    }

    /**
     * 绘本图片搜索—入库-url
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param string $brief   - 简介
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookAddUrl(string $url, string $brief, array $options = []): array {
        $data['url'] = $url;
        $data['brief'] = $brief;

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookAdd, $data);
    }

    /**
     * 绘本图片搜索—检索-image
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookSearchImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookSearch, $data);
    }

    /**
     * 绘本图片搜索—检索-url
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookSearchUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookSearch, $data);
    }

    /**
     * 绘本图片搜索—更新-image
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookUpdate(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookUpdate, $data);
    }

    /**
     * 绘本图片搜索—更新-url
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookUpdateUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookUpdate, $data);
    }

    /**
     * 绘本图片搜索—更新-cont_sign
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookUpdateContSign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookUpdate, $data);
    }

    /**
     * 绘本图片搜索—删除-image
     *
     * @param string $image   - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookDeleteByImage(string $image, array $options = []): array {
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookDelete, $data);
    }

    /**
     * 绘本图片搜索—删除-url
     *
     * @param string $url     -
     *                        图片完整URL，URL长度不超过1024字节，URL对应的图片base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式，当image字段存在时url字段失效
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookDeleteByUrl(string $url, array $options = []): array {
        $data['url'] = $url;

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookDelete, $data);
    }

    /**
     * 绘本图片搜索—删除-cont_sign
     *
     * @param string $contSign - 图片签名
     * @param array  $options  - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function pictureBookDeleteBySign(string $contSign, array $options = []): array {
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->pictureBookDelete, $data);
    }
}

