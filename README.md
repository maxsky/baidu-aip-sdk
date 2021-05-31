# Baidu AIP PHP SDK

[![996.icu](https://img.shields.io/badge/link-996.icu-red.svg)](https://996.icu)
[![codecov](https://codecov.io/gh/maxsky/baidu-aip-sdk/branch/main/graph/badge.svg?token=oazUSp4Qo3)](https://codecov.io/gh/maxsky/baidu-aip-sdk)

## 目录结构

```
├── AipBodyAnalysis.php      // 人体分析
├── AipContentCensor.php     // 内容审核
├── AipFace.php              // 人脸识别
├── AipImageCensor.php       // 图像审核
├── AipImageClassify.php     // 图像识别
├── AipImageProcess.php      // 图像处理
├── AipImageSearch.php       // 图像搜索
├── AipKg.php                // 知识图谱（Knowledge Graph）
├── AipNlp.php               // 自然语言处理（Natural Language Processing）
├── AipOcrCard.php           // OCR 卡证
├── AipOcrEdu.php            // OCR 教育
├── AipOcrGeneric.php        // OCR 通用
├── AipOcrOther.php          // OCR 其它
├── AipOcrReceiptFinance.php // OCR 财务票据
├── AipOcrReceiptMedical.php // OCR 医疗票据
├── AipOcrVehicle.php        // OCR 汽车相关
├── AipSpeech.php            // 语音 [暂时移除]
├── Helper                   // 助手函数、常量
└── Lib
    ├── AipBase.php          // Aip 基类
    ├── AipHttpUtil.php
    ├── AipSampleSigner.php
    ├── AipSignOption.php
    └── Traits               // 工具
```


**支持 PHP版本：7.2+**

**Composer安装：**

```bash
composer require maxsky/baidu-aip-sdk
```

# 使用文档

参考 [AI 接入指南](https://ai.baidu.com/ai-doc/REFERENCE/Ck3dwjgn3)

```php
$aip = new Baidu\Aip\AipOcrGeneric('App ID','API Key','Secret Key');

// 部分方法可传入 URL 地址
$aip->general(file_get_contents('File path'));
```
