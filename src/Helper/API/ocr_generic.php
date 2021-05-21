<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/21
 * Time: 15:28
 */

/** 通用文字识别（高精度版） */
const API_ACCURATE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/accurate_basic';

/** 通用文字识别（含位置高精度版） */
const API_ACCURATE_LOC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/accurate';

/** 通用文字识别 */
const API_GENERAL = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general_basic';

/** 通用文字识别（含位置信息版） */
const API_GENERAL_LOC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general';

/** 办公文档识别 */
const API_DOC_ANALYSIS_OFFICE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/doc_analysis_office';

/** 网络图片文字识别 */
const API_WEB_IMAGE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/webimage';

/** 网络图片文字识别（含位置版） */
const API_WEB_IMAGE_LOC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/webimage_loc';

/** 手写文字识别 */
const API_HANDWRITING = 'https://aip.baidubce.com/rest/2.0/ocr/v1/handwriting';

/** 数字识别 */
const API_NUMBERS = 'https://aip.baidubce.com/rest/2.0/ocr/v1/numbers';

/** 表格文字识别（同步接口） */
const API_TABLE_SYNC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/form';

/** 表格文字识别（异步接口）- 提交请求 */
const API_TABLE_ASYNC = 'https://aip.baidubce.com/rest/2.0/solution/v1/form_ocr/request';

/** 表格识别结果（异步接口）- 获取结果 */
const API_TABLE_ASYNC_GET_RESULT = 'https://aip.baidubce.com/rest/2.0/solution/v1/form_ocr/get_request_result';

/** 二维码识别 */
const API_QRCODE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/qrcode';
