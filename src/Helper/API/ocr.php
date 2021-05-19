<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/17
 * Time: 14:19
 */

/** 通用文字识别 */
const API_GENERAL_BASIC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general_basic';

/** 通用文字识别（高精度版） */
const API_ACCURATE_BASIC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/accurate_basic';

/** 通用文字识别（含位置信息版） */
const API_GENERAL = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general';

/** 通用文字识别（含位置高精度版） */
const API_ACCURATE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/accurate';

/** 通用文字识别（含生僻字版） */
const API_GENERAL_ENHANCED = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general_enhanced';

/** 网络图片文字识别 */
const API_WEB_IMAGE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/webimage';

/** 身份证识别 */
const API_ID_CARD = 'https://aip.baidubce.com/rest/2.0/ocr/v1/idcard';

/** 银行卡识别 */
const API_BANKCARD = 'https://aip.baidubce.com/rest/2.0/ocr/v1/bankcard';

/** 驾驶证识别 */
const API_DRIVING_LICENSE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/driving_license';

/** 行驶证识别 */
const API_VEHICLE_LICENSE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/vehicle_license';

/** 车牌识别 */
const API_LICENSE_PLATE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/license_plate';

/** 营业执照识别 */
const API_BUSINESS_LICENSE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/business_license';

/** 通用票据识别 */
const API_RECEIPT = 'https://aip.baidubce.com/rest/2.0/ocr/v1/receipt';

/** 火车票识别 */
const API_TRAIN_TICKET = 'https://aip.baidubce.com/rest/2.0/ocr/v1/train_ticket';

/** 出租车票识别 */
const API_TAXI_RECEIPT = 'https://aip.baidubce.com/rest/2.0/ocr/v1/taxi_receipt';

/** 表格文字识别同步接口 */
const API_FORM = 'https://aip.baidubce.com/rest/2.0/ocr/v1/form';

/** 表格文字识别 */
const API_TABLE_RECOGNIZE = 'https://aip.baidubce.com/rest/2.0/solution/v1/form_ocr/request';

/** 表格识别结果 */
const API_TABLE_GET_RESULT = 'https://aip.baidubce.com/rest/2.0/solution/v1/form_ocr/get_request_result';

/** VIN 码识别 */
const API_VIN_CODE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/vin_code';

/** 定额发票识别 */
const API_QUOTA_INVOICE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/quota_invoice';

/** 户口本识别 */
const API_HOUSEHOLD_REGISTER = 'https://aip.baidubce.com/rest/2.0/ocr/v1/household_register';

/** 港澳通行证识别 */
const API_HK_MACAU_EXIT_ENTRY_PERMIT = 'https://aip.baidubce.com/rest/2.0/ocr/v1/HK_Macau_exitentrypermit';

/** 台湾通行证识别 */
const API_TAIWAN_EXIT_ENTRY_PERMIT = 'https://aip.baidubce.com/rest/2.0/ocr/v1/taiwan_exitentrypermit';

/** 出生医学证明识别 */
const API_BIRTH_CERTIFICATE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/birth_certificate';

/** 机动车销售发票识别 */
const API_VEHICLE_INVOICE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/vehicle_invoice';

/** 车辆合格证识别 */
const API_VEHICLE_CERTIFICATE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/vehicle_certificate';

/** 税务局通用机打发票识别 */
const API_INVOICE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/invoice';

/** 行程单识别 */
const API_AIR_TICKET = 'https://aip.baidubce.com/rest/2.0/ocr/v1/air_ticket';

/** 保单识别 */
const API_INSURANCE_DOCUMENTS = 'https://aip.baidubce.com/rest/2.0/ocr/v1/insurance_documents';

/** 增值税发票识别 */
const API_VAT_INVOICE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/vat_invoice';

/** 二维码识别 */
const API_QRCODE = 'https://aip.baidubce.com/rest/2.0/ocr/v1/qrcode';

/** 数字识别 */
const API_NUMBERS = 'https://aip.baidubce.com/rest/2.0/ocr/v1/numbers';

/** 彩票识别 */
const API_LOTTERY = 'https://aip.baidubce.com/rest/2.0/ocr/v1/lottery';

/** 护照识别 */
const API_PASSPORT = 'https://aip.baidubce.com/rest/2.0/ocr/v1/passport';

/** 名片识别 */
const API_BUSINESS_CARD = 'https://aip.baidubce.com/rest/2.0/ocr/v1/business_card';

/** 手写文字识别 */
const API_HANDWRITING = 'https://aip.baidubce.com/rest/2.0/ocr/v1/handwriting';

/** 自定义模板文字识别 */
const API_RECOGNISE = 'https://aip.baidubce.com/rest/2.0/solution/v1/iocr/recognise';

/** 文档版面分析与识别 */
const API_DOC_ANALYSIS = 'https://aip.baidubce.com/rest/2.0/ocr/v1/doc_analysis';

/** 仪器仪表盘读数识别 */
const API_METER = 'https://aip.baidubce.com/rest/2.0/ocr/v1/meter';

/** 网络图片文字识别（含位置版） */
const API_WEB_IMAGE_LOC = 'https://aip.baidubce.com/rest/2.0/ocr/v1/webimage_loc';
