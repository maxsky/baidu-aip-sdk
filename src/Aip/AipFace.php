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

class AipFace extends AipBase {

    /**
     * 人脸检测
     *
     * @url https://ai.baidu.com/ai-doc/FACE/yk37c1u4t#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image      图片信息（总数据大小应小于 10M），图片上传方式根据 image_type 来判断
     * @param string $image_type 图片类型，值为 BASE64 时大小不超过 2M
     * @param array  $options
     *
     * @return array
     */
    public function detect(string $image, string $image_type, array $options = []): array {
        $data = [
            'image' => $image,
            'image_type' => $image_type
        ];

        $data = array_merge($data, $options);

        return $this->request(API_DETECT, $data, true);
    }

    /**
     * 人脸比对
     *
     * @url https://ai.baidu.com/ai-doc/FACE/Lk37c1tpf#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param array $images 两张图片数组
     *
     * @return array
     */
    public function match(array $images): array {
        return $this->request(API_MATCH, $images, true);
    }

    /**
     * 人脸搜索接口
     *
     * @url https://ai.baidu.com/ai-doc/FACE/Gk37c1uzc#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image         图片信息（总数据大小应小于 10M），图片上传方式根据 image_type 来判断
     * @param string $image_type    图片类型，值为 BASE64 时大小不超过 2M
     * @param array  $group_id_list 从指定的 group 中进行查找，上限 10 个
     * @param array  $options
     *
     * @return array
     */
    public function search(string $image, string $image_type, array $group_id_list, array $options = []): array {
        $data = [
            'image' => $image,
            'image_type' => $image_type,
            'group_id_list' => implode(',', $group_id_list)
        ];

        $data = array_merge($data, $options);

        return $this->request(API_SEARCH, $data, true);
    }

    /**
     * 人脸搜索 M:N 识别接口
     *
     * @param string $image       - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType   - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的
     *                            URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**:
     *                            人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $groupIdList - 从指定的group中进行查找 用逗号分隔，**上限20个**
     * @param array  $options     - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   max_face_num 最多处理人脸的数目<br>**默认值为1(仅检测图片中面积最大的那个人脸)** **最大值10**
     *   match_threshold 匹配阈值（设置阈值后，score低于此阈值的用户信息将不会返回） 最大100 最小0 默认80 <br>**此阈值设置得越高，检索速度将会越快，推荐使用默认阈值`80`**
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率)
     *   **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE** max_user_num 查找后返回的用户数量。返回相似度最高的几个用户，默认为1，最多返回50个。
     * @return array
     */
    public function multiSearch(string $image, string $imageType, string $groupIdList, array $options = []): array {
        $data['image'] = $image;
        $data['image_type'] = $imageType;
        $data['group_id_list'] = $groupIdList;

        $data = array_merge($data, $options);

        return $this->request(API_MULTI_SEARCH, $data, true);
    }


    /**
     * 在线活体检测接口
     *
     * @param array $images
     *
     * @return array
     */
    public function faceVerify(array $images): array {
        return $this->request(API_FACE_VERIFY, $images, true);
    }

    /**
     * 获取用户人脸列表接口
     *
     * @param string $userId  - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function faceGetList(string $userId, string $groupId, array $options = []): array {
        $data['user_id'] = $userId;
        $data['group_id'] = $groupId;

        $data = array_merge($data, $options);

        return $this->request(API_FACE_GET_LIST, $data, true);
    }

    /**
     * 人脸删除接口
     *
     * @param string $userId    - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId   - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $faceToken - 需要删除的人脸图片token，（由数字、字母、下划线组成）长度限制64B
     * @param array  $options   - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function faceDelete(string $userId, string $groupId, string $faceToken, array $options = []): array {
        $data['user_id'] = $userId;
        $data['group_id'] = $groupId;
        $data['face_token'] = $faceToken;

        $data = array_merge($data, $options);

        return $this->request(API_FACE_DELETE, $data, true);
    }

    /**
     * 用户信息查询接口
     *
     * @param string $userId  - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function getUser(string $userId, string $groupId, array $options = []): array {
        $data['user_id'] = $userId;
        $data['group_id'] = $groupId;

        $data = array_merge($data, $options);

        return $this->request(API_USER_GET, $data, true);
    }

    /**
     * 人脸注册接口
     *
     * @param string $image     - 图片信息(总数据大小应小于10M)，图片上传方式根据image_type来判断。注：组内每个uid下的人脸图片数目上限为20张
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的
     *                          URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**:
     *                          人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $groupId   - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $userId    - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options   - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   user_info 用户资料，长度限制256B
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率)
     *   **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE** action_type 操作方式  APPEND:
     *   当user_id在库中已经存在时，对此user_id重复注册时，新注册的图片默认会追加到该user_id下,REPLACE :
     *   当对此user_id重复注册时,则会用新图替换库中该user_id下所有图片,默认使用APPEND
     * @return array
     */
    public function addUser(string $image,
                            string $imageType, string $groupId, string $userId, array $options = []): array {
        $data['image'] = $image;
        $data['image_type'] = $imageType;
        $data['group_id'] = $groupId;
        $data['user_id'] = $userId;

        $data = array_merge($data, $options);

        return $this->request(API_USER_ADD, $data, true);
    }

    /**
     * 人脸更新接口
     *
     * @param string $image     - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的
     *                          URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**:
     *                          人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $groupId   - 更新指定groupid下uid对应的信息
     * @param string $userId    - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options   - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   user_info 用户资料，长度限制256B
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率)
     *   **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE** action_type 操作方式  APPEND:
     *   当user_id在库中已经存在时，对此user_id重复注册时，新注册的图片默认会追加到该user_id下,REPLACE :
     *   当对此user_id重复注册时,则会用新图替换库中该user_id下所有图片,默认使用APPEND
     * @return array
     */
    public function updateUser(string $image,
                               string $imageType, string $groupId, string $userId, array $options = []): array {
        $data['image'] = $image;
        $data['image_type'] = $imageType;
        $data['group_id'] = $groupId;
        $data['user_id'] = $userId;

        $data = array_merge($data, $options);

        return $this->request(API_USER_UPDATE, $data, true);
    }

    /**
     * 删除用户接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param string $userId  - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function deleteUser(string $groupId, string $userId, array $options = []): array {
        $data['group_id'] = $groupId;
        $data['user_id'] = $userId;

        $data = array_merge($data, $options);

        return $this->request(API_USER_DELETE, $data, true);
    }

    /**
     * 复制用户接口
     *
     * @param string $userId  - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   src_group_id 从指定组里复制信息
     *   dst_group_id 需要添加用户的组id
     * @return array
     */
    public function userCopy(string $userId, array $options = []): array {
        $data['user_id'] = $userId;

        $data = array_merge($data, $options);

        return $this->request(API_USER_COPY, $data, true);
    }

    /**
     * 获取用户列表接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   start 默认值0，起始序号
     *   length 返回数量，默认值100，最大值1000
     * @return array
     */
    public function getGroupUsers(string $groupId, array $options = []): array {
        $data['group_id'] = $groupId;

        $data = array_merge($data, $options);

        return $this->request(API_GROUP_GET_USERS, $data, true);
    }

    /**
     * 创建用户组接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function groupAdd(string $groupId, array $options = []): array {
        $data['group_id'] = $groupId;

        $data = array_merge($data, $options);
        return $this->request(API_GROUP_ADD, $data, true);
    }

    /**
     * 删除用户组接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array  $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     * @return array
     */
    public function groupDelete(string $groupId, array $options = []): array {
        $data['group_id'] = $groupId;

        $data = array_merge($data, $options);

        return $this->request(API_GROUP_DELETE, $data, true);
    }

    /**
     * 组列表查询接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   start 默认值0，起始序号
     *   length 返回数量，默认值100，最大值1000
     * @return array
     */
    public function getGroupList(array $options = []): array {
        return $this->request(API_GROUP_GET_LIST, $options, true);
    }

    /**
     * 身份验证接口
     *
     * @param string $image        - 图片信息(**总数据大小应小于10M**)，图片上传方式根据image_type来判断
     * @param string $imageType    - 图片类型     <br> **BASE64**:图片的base64值，base64编码后的图片数据，编码后的图片大小不超过2M； <br>**URL**:图片的
     *                             URL地址( 可能由于网络等原因导致下载图片时间过长)； <br>**FACE_TOKEN**:
     *                             人脸图片的唯一标识，调用人脸检测接口时，会为每个人脸图片赋予一个唯一的FACE_TOKEN，同一张图片多次检测得到的FACE_TOKEN是同一个。
     * @param string $idCardNumber - 身份证号（真实身份证号号码）
     * @param string $name         - utf8，姓名（真实姓名，和身份证号匹配）
     * @param array  $options      - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   quality_control 图片质量控制  **NONE**: 不进行控制 **LOW**:较低的质量要求 **NORMAL**: 一般的质量要求 **HIGH**: 较高的质量要求 **默认 NONE**
     *   liveness_control 活体检测控制  **NONE**: 不进行控制 **LOW**:较低的活体要求(高通过率 低攻击拒绝率) **NORMAL**: 一般的活体要求(平衡的攻击拒绝率, 通过率)
     *   **HIGH**: 较高的活体要求(高攻击拒绝率 低通过率) **默认NONE**
     * @return array
     */
    public function personVerify(string $image,
                                 string $imageType, string $idCardNumber, string $name, array $options = []): array {
        $data['image'] = $image;
        $data['image_type'] = $imageType;
        $data['id_card_number'] = $idCardNumber;
        $data['name'] = $name;

        $data = array_merge($data, $options);

        return $this->request(API_PERSON_VERIFY, $data, true);
    }

    /**
     * 语音校验码接口接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     *
     * @description options列表:
     *   appid 百度云创建应用时的唯一标识ID
     * @return array
     */
    public function sessionCode(array $options = []): array {
        return $this->request(API_SESSION_CODE, $options, true);
    }
}
