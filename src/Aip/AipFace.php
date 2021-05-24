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
        $image_type = strtoupper($image_type);

        if ($image_type === 'BASE64') {
            $image = base64_encode($image);
        }

        $data = array_merge([
            'image' => $image,
            'image_type' => $image_type
        ], $options);

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
        foreach ($images as $image) {
            $image['image_type'] = strtoupper($image['image_type']);

            if ($image['image_type'] === 'BASE64') {
                $image['image'] = base64_encode($image['image']);
            }
        }

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
        $image_type = strtoupper($image_type);

        if ($image_type === 'BASE64') {
            $image = base64_encode($image);
        }

        $data = array_merge([
            'image' => $image,
            'image_type' => $image_type,
            'group_id_list' => implode(',', $group_id_list)
        ], $options);

        return $this->request(API_SEARCH, $data, true);
    }

    /**
     * 人脸搜索 M:N 识别
     *
     * @url https://cloud.baidu.com/doc/FACE/s/Gk37c1uzc#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E-1
     *
     * @param string $image         图片信息（数据大小应小于 10M，分辨率应小于 1920*1080）
     * @param string $image_type    图片类型
     * @param array  $group_id_list 从指定的 group 中进行查找，上限 10 个
     * @param array  $options
     *
     * @return array
     */
    public function multiSearch(string $image, string $image_type, array $group_id_list, array $options = []): array {
        $image_type = strtoupper($image_type);

        if ($image_type === 'BASE64') {
            $image = base64_encode($image);
        }

        $data = array_merge([
            'image' => $image,
            'image_type' => $image_type,
            'group_id_list' => implode(',', $group_id_list)
        ], $options);

        return $this->request(API_MULTI_SEARCH, $data, true);
    }

    /**
     * 人脸注册
     *
     * @url https://ai.baidu.com/ai-doc/FACE/7k37c1twu#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image      图片信息（总数据大小应小于 10M），图片上传方式根据 image_type 来判断。组内每个 uid 下的人脸图片数目上限为 20 张
     * @param string $image_type 图片类型，值为 BASE64 时大小不超过 2M
     * @param string $group_id   用户组 id，标识一组用户（由数字、字母、下划线组成），长度限制 48B
     * @param string $user_id    用户 id（由数字、字母、下划线组成），长度限制 128B
     * @param array  $options
     *
     * @return array
     */
    public function faceRegister(string $image,
                                 string $image_type, string $group_id, string $user_id, array $options = []): array {
        $image_type = strtoupper($image_type);

        if ($image_type === 'BASE64') {
            $image = base64_encode($image);
        }

        $data = array_merge([
            'image' => $image,
            'image_type' => $image_type,
            'group_id' => $group_id,
            'user_id' => $user_id
        ], $options);

        return $this->request(API_USER_ADD, $data, true);
    }

    /**
     * 人脸更新
     *
     * @url https://ai.baidu.com/ai-doc/FACE/7k37c1twu#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E-1
     *
     * @param string $image      图片信息（总数据大小应小于 10M），图片上传方式根据 image_type 来判断
     * @param string $image_type 图片类型，值为 BASE64 时大小不超过 2M
     * @param string $group_id   用户组 id，标识一组用户（由数字、字母、下划线组成），长度限制 128B
     * @param string $user_id    用户 id（由数字、字母、下划线组成），长度限制 48B
     * @param array  $options
     *
     * @return array
     */
    public function faceUpdate(string $image,
                               string $image_type, string $group_id, string $user_id, array $options = []): array {
        $image_type = strtoupper($image_type);

        if ($image_type === 'BASE64') {
            $image = base64_encode($image);
        }

        $data = array_merge([
            'image' => $image,
            'image_type' => $image_type,
            'group_id' => $group_id,
            'user_id' => $user_id
        ], $options);

        return $this->request(API_USER_UPDATE, $data, true);
    }

    /**
     * 人脸删除
     *
     * @url https://ai.baidu.com/ai-doc/FACE/7k37c1twu#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E-2
     *
     * @param string $user_id    用户 id（由数字、字母、下划线组成），长度限制 128B
     * @param string $group_id   用户组 id，标识一组用户（由数字、字母、下划线组成），长度限制 48B
     * @param string $face_token 需要删除的人脸图片 token，（由数字、字母、下划线组成）长度限制 64B
     *
     * @return array
     */
    public function faceDelete(string $user_id, string $group_id, string $face_token): array {
        $data = [
            'user_id' => $user_id,
            'group_id' => $group_id,
            'face_token' => $face_token
        ];

        return $this->request(API_FACE_DELETE, $data, true);
    }

    /**
     * 用户信息查询
     *
     * @param string $user_id  用户 id（由数字、字母、下划线组成），长度限制 48B
     * @param string $group_id 用户组 id（由数字、字母、下划线组成），长度限制 48B
     *
     * @return array
     * @description options列表:
     */
    public function getUser(string $user_id, string $group_id): array {
        $data = [
            'user_id' => $user_id,
            'group_id' => $group_id
        ];

        return $this->request(API_USER_GET, $data, true);
    }

    /**
     * 获取用户人脸列表
     *
     * @param string $user_id  用户 id（由数字、字母、下划线组成），长度限制 48B
     * @param string $group_id 用户组 id（由数字、字母、下划线组成），长度限制 48B
     *
     * @return array
     */
    public function faceGetList(string $user_id, string $group_id): array {
        $data = [
            'user_id' => $user_id,
            'group_id' => $group_id
        ];

        return $this->request(API_FACE_GET_LIST, $data, true);
    }

    /**
     * 获取用户列表接口
     *
     * @param string $group_id 用户组 id，长度限制 48B
     * @param int    $start    默认值 0，起始序号
     * @param int    $length   返回数量，默认值 100，最大值 1000
     *
     * @return array
     */
    public function getGroupUserList(string $group_id, int $start = 0, int $length = 100): array {
        $data = [
            'group_id' => $group_id,
            'start' => $start,
            'length' => $length
        ];

        return $this->request(API_GROUP_GET_USERS, $data, true);
    }

    /**
     * 复制用户接口
     *
     * @param string $user_id      用户 id，长度限制 48B
     * @param string $src_group_id 从指定组里复制信息
     * @param string $dst_group_id 需要添加用户的组 id
     *
     * @return array
     */
    public function userCopy(string $user_id, string $src_group_id, string $dst_group_id): array {
        $data = [
            'user_id' => $user_id,
            'src_group_id' => $src_group_id,
            'dst_group_id' => $dst_group_id
        ];

        return $this->request(API_USER_COPY, $data, true);
    }

    /**
     * 删除用户
     *
     * @param string $group_id
     * @param string $user_id
     *
     * @return array
     */
    public function deleteUser(string $group_id, string $user_id): array {
        $data = [
            'group_id' => $group_id,
            'user_id' => $user_id
        ];

        return $this->request(API_USER_DELETE, $data, true);
    }

    /**
     * 创建用户组
     *
     * @param string $group_id 用户组 id，标识一组用户（由数字、字母、下划线组成），长度限制 48B
     *
     * @return array
     */
    public function groupAdd(string $group_id): array {
        return $this->request(API_GROUP_ADD, ['group_id' => $group_id], true);
    }

    /**
     * 删除用户组接口
     *
     * @param string $group_id 用户组 id，标识一组用户（由数字、字母、下划线组成），长度限制 48B
     *
     * @return array
     */
    public function groupDelete(string $group_id): array {
        return $this->request(API_GROUP_DELETE, ['group_id' => $group_id], true);
    }

    /**
     * 组列表查询接口
     *
     * @param int $start  默认值 0，起始序号
     * @param int $length 返回数量，默认值 100，最大值 1000
     *
     * @return array
     */
    public function getGroupList(int $start = 0, int $length = 100): array {
        return $this->request(API_GROUP_GET_LIST, ['start' => $start, 'length' => $length], true);
    }

    /**
     * 在线图片活体检测
     *
     * @url https://ai.baidu.com/ai-doc/FACE/Zk37c1urr#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param array $images
     *
     * @return array
     */
    public function faceVerify(array $images): array {
        foreach ($images as $image) {
            $image['image_type'] = strtoupper($image['image_type']);

            if ($image['image_type'] === 'BASE64') {
                $image['image'] = base64_encode($image['image']);
            }
        }

        return $this->request(API_FACE_VERIFY, $images, true);
    }

    /**
     * 身份验证接口
     *
     * @url https://ai.baidu.com/ai-doc/FACE/7k37c1ucj#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param string $image          图片信息（总数据大小应小于 10M），图片上传方式根据 image_type 来判断
     * @param string $image_type     图片类型，值为 BASE64 时大小不超过 2M，尺寸不超过 1920*1080
     * @param string $id_card_number 身份证号码
     * @param string $name           姓名（注：需要是 UTF-8 编码的中文）与身份证匹配
     * @param array  $options
     *
     * @return array
     */
    public function personVerify(string $image,
                                 string $image_type, string $id_card_number, string $name, array $options = []): array {
        $image_type = strtoupper($image_type);

        if ($image_type === 'BASE64') {
            $image = base64_encode($image);
        }

        $data = array_merge([
            'image' => $image,
            'image_type' => $image_type,
            'id_card_number' => $id_card_number,
            'name' => $name
        ], $options);

        return $this->request(API_PERSON_VERIFY, $data, true);
    }

    /**
     * @param string $id_card_number
     * @param string $name
     *
     * @return array
     */
    public function personIdMatch(string $id_card_number, string $name): array {
        $data = [
            'id_card_number' => $id_card_number,
            'name' => $name
        ];

        return $this->request(API_PERSON_ID_MATCH, $data, true);
    }

    /**
     * 语音校验码接口接口
     *
     * @url https://ai.baidu.com/ai-doc/FACE/lk37c1tag#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E
     *
     * @param int $type 0 为语音验证和唇语验证步骤，1 为视频动作活体，默认 0
     * @param int $min_code_length
     * @param int $max_code_length
     *
     * @return array
     */
    public function sessionCode(int $type = 0, int $min_code_length = 3, int $max_code_length = 3): array {
        return $this->request(API_SESSION_CODE, [
            'type' => $type,
            'min_code_length' => $min_code_length,
            'max_code_length' => $max_code_length
        ]);
    }

    /**
     * 视频活体检测
     *
     * @url https://ai.baidu.com/ai-doc/FACE/lk37c1tag#%E8%AF%B7%E6%B1%82%E8%AF%B4%E6%98%8E-1
     *
     * @param string $video         建议先将视频进行转码，h.264 编码，mp4 封装。建议视频长度控制在 1s-10s 之间，视频大小建议在 2M
     *                              以内（视频大小强制要求在20M以内，推荐使用等分辨率压缩，压缩分辨率建议不小于 640*480）视频大小分辨率建议限制在 16~2032 之间
     * @param string $type_identity voice 为语音验证，action 为视频动作活体验证，默认为 voice
     * @param array  $options
     *
     * @return array
     */
    public function faceLivenessVerify(string $video, string $type_identity = 'voice', array $options = []): array {
        $data = [
            'type_identity' => $type_identity,
            'video_base64' => base64_encode($video)
        ];

        $data = array_merge($data, $options);

        return $this->request(API_FACE_LIVENESS_VERIFY, $data);
    }
}
