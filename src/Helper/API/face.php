<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/14
 * Time: 21:18
 */

/** 人脸检测 */
const API_DETECT = 'https://aip.baidubce.com/rest/2.0/face/v3/detect';

/** 人脸对比 */
const API_MATCH = 'https://aip.baidubce.com/rest/2.0/face/v3/match';

/** 人脸搜索 */
const API_SEARCH = 'https://aip.baidubce.com/rest/2.0/face/v3/search';

/** 人脸搜索 M:N 识别 */
const API_MULTI_SEARCH = 'https://aip.baidubce.com/rest/2.0/face/v3/multi-search';

/** 人脸注册 */
const API_USER_ADD = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/user/add';

/** 人脸更新 */
const API_USER_UPDATE = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/user/update';

/** 人脸删除 */
const API_FACE_DELETE = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/face/delete';

/** 用户信息查询 */
const API_USER_GET = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/user/get';

/** 获取用户人脸列表 */
const API_FACE_GET_LIST = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/face/getlist';

/** 获取用户列表 */
const API_GROUP_GET_USERS = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/group/getusers';

/** 复制用户 */
const API_USER_COPY = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/user/copy';

/** 删除用户 */
const API_USER_DELETE = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/user/delete';

/** 创建用户组 */
const API_GROUP_ADD = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/group/add';

/** 删除用户组 */
const API_GROUP_DELETE = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/group/delete';

/** 组列表查询 */
const API_GROUP_GET_LIST = 'https://aip.baidubce.com/rest/2.0/face/v3/faceset/group/getlist';

/** 在线图片活体检测 */
const API_FACE_VERIFY = 'https://aip.baidubce.com/rest/2.0/face/v3/faceverify';

/** 人脸实名认证 */
const API_PERSON_VERIFY = 'https://aip.baidubce.com/rest/2.0/face/v3/person/verify';

/** 身份证与名字比对 */
const API_PERSON_ID_MATCH = 'https://aip.baidubce.com/rest/2.0/face/v3/person/idmatch';

/** 随机校验码（原语音验证码） */
const API_SESSION_CODE = 'https://aip.baidubce.com/rest/2.0/face/v1/faceliveness/sessioncode';

/** 视频活体检测 */
const API_FACE_LIVENESS_VERIFY = 'https://aip.baidubce.com/rest/2.0/face/v1/faceliveness/verify';
