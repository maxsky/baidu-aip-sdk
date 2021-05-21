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

class AipNlp extends AipBase {

    use DataTrait;

    /**
     * 词法分析（通用版）
     *
     * @param string $text 待分析文本，长度不超过 20000 字节
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function lexer(string $text, bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_LEXER, ['text' => $text], true);
    }

    /**
     * 词法分析（定制版）
     *
     * @param string $text 待分析文本，长度不超过 20000 字节
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function lexerCustom(string $text, bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_LEXER_CUSTOM, ['text' => $text], true);
    }

    /**
     * 词向量表示
     *
     * @param string $word 文本内容，最大 64 字节
     * @param int    $dem  词向量维度。默认值为 0（对应 1024 维），目前仅支持 dem=0
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function wordEmbeddingVec(string $word, int $dem = 0, bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_WORD_EMBEDDING_VEC, ['word' => $word, 'dem' => $dem], true);
    }

    /**
     * 词义相似度
     *
     * @param string $word1 词 1，最大 64 字节
     * @param string $word2 词 2，最大 64 字节
     * @param bool   $utf8  是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function wordSimilarEmbedding(string $word1, string $word2, bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_WORD_SIMILAR_EMBEDDING, ['word1' => $word1, 'word2' => $word2], true);
    }

    /**
     * DNN 语言模型
     *
     * @param string $text 文本内容，最大 256 字节，不需要切词
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function dnnLM(string $text, bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_DNN_LM_CN, ['text' => $text], true);
    }

    /**
     * 依存句法分析
     *
     * @param string $text 待分析文本，长度不超过 128 字符
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function depParser(string $text, bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_DEP_PARSER, ['text' => $text], true);
    }

    /**
     * 短文本相似度
     *
     * @param string $text1 待比较文本 1，最大 512 字节
     * @param string $text2 待比较文本 2，最大 512 字节
     * @param string $model 默认为 "BOW"，可选 "BOW"、"CNN"、"GRNN"
     * @param bool   $utf8  是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function simnet(string $text1, string $text2, string $model = 'BOW', bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_SIMNET, ['text_1' => $text1, 'text_2' => $text2, 'model' => $model], true);
    }

    /**
     * 文章标签
     *
     * @param string $title   文章标题，最大 80 字节
     * @param string $content 文章内容，最大 65535 字节
     * @param bool   $utf8    是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function articleKeyword(string $title, string $content, bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_ARTICLE_KEYWORD, ['title' => $title, 'content' => $content], true);
    }

    /**
     * 文章分类
     *
     * @param string $title   文章标题，最大 80 字节
     * @param string $content 文章内容，最大 65535 字节
     * @param bool   $utf8    是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function articleTopic(string $title, string $content, bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_ARTICLE_TOPIC, ['title' => $title, 'content' => $content], true);
    }

    /**
     * 文本纠错
     *
     * @param string $text 待纠错文本，输入限制 511 字节
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function ecnet(string $text, bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_ECNET, ['text' => $text], true);
    }

    /**
     * 新闻摘要
     *
     * @param string $content         仅支持 GBK 编码，长度需小于 3000 字符数（即 6000字节），请输入前确认字符数没有超限，
     *                                若字符数超长会返回错误。正文中如果包含段落信息，请使用"\n"分隔，段落信息算法中有重要的作用，请尽量保留
     * @param int    $max_summary_len 此数值将作为摘要结果的最大长度。例如：原文长度 1000 字，本参数设置为 150，则摘要结果的最大长度是 150 字；推荐最优区间：200-500 字
     * @param string $title           仅支持 GBK 编码，长度需小于 200 字符数（即 400 字节），请输入前确认字符数没有超限，
     *                                若字符数超长会返回错误。标题在算法中具有重要的作用，若文章确无标题，不必输入此参数
     * @param bool   $utf8            是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function newsSummary(string $content, int $max_summary_len, string $title = '', bool $utf8 = false): array {
        $data = [
            'content' => $content,
            'max_summary_len' => $max_summary_len
        ];

        if ($title) {
            $data['title'] = $title;
        }

        return $this->charset($utf8)->request(API_NEWS_SUMMARY, $data);
    }

    /**
     * 评论观点抽取（通用版）
     *
     * @param string $text 评论内容，最大 10240 字节
     * @param int    $type 评论行业类型，默认为 4（餐饮美食）
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function commentTag(string $text, int $type = 4, bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_COMMENT_TAG, ['text' => $text, 'type' => $type], true);
    }

    /**
     * 评论观点抽取（定制版）
     *
     * @param string $text 评论内容，最大 10240 字节
     * @param int    $type 评论行业类型，默认为 4（餐饮美食）
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function commentTagCustom(string $text, int $type = 4, bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_COMMENT_TAG_CUSTOM, ['text' => $text, 'type' => $type], true);
    }

    /**
     * 情感倾向分析
     *
     * @param string $text 文本内容，最大 2048 字节
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function sentimentClassify(string $text, bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_SENTIMENT_CLASSIFY, ['text' => $text], true);
    }

    /**
     * 对话情绪识别
     *
     * @param string $text  待识别情感文本，输入限制 512 字节
     * @param string $scene default（默认项-不区分场景），talk（闲聊对话-如度秘聊天等），task（任务型对话-如导航对话等），customer_service（客服对话-如电信/银行客服等）
     * @param bool   $utf8  是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function emotion(string $text, string $scene = 'default', bool $utf8 = false): array {
        return $this->charset($utf8)->request(API_EMOTION, ['text' => $text, 'scene' => $scene], true);
    }

    /**
     * @param string $title      标题（建议输入UTF-8），长度不超过400字节
     * @param string $content    正文（建议输入UTF-8），长度不超过6000字节
     * @param string $type       新闻类型，目前支持3种文章类型，1：娱乐；2：财经；3：体育
     * @param string $repository 自定义需要抽取的实体库名称，由大写英文字母组成，默认为空
     * @param bool   $utf8       是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function entityLevelSentiment(string $title, string $content,
                                         string $type, string $repository = '', bool $utf8 = false): array {
        $data = [
            'title' => $title,
            'content' => $content,
            'type' => $type
        ];

        if ($repository) {
            $data['repository'] = $repository;
        }

        return $this->charset($utf8)->request(API_ENTITY_LEVEL_SENTIMENT, $data, true);
    }

    /**
     * 地址识别
     *
     * @param string $text       待识别的文本内容，不超过 1000 字节
     * @param int    $confidence 取值 100-0，默认为 50。该字段用于触发补充解析策略，对置信度在配置值以下的结果，进行补充解析，以提高结果精度。
     *                           该字段配置会增加服务耗时。经评测，在保证准确率提升效果的前提下，当取值=50时，服务平响增长相对较小。也可根据业务数据评测，决定取值。
     * @param bool   $utf8       是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function address(string $text, int $confidence = 50, bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_ADDRESS, ['text' => $text, 'confidence' => $confidence], true);
    }

    /**
     * 消费者评论分析
     *
     * @param string $text 评论内容，最大 10240 字节
     * @param int    $type 不同评论类型，1-15
     * @param bool   $utf8 是否使用 UTF-8 编码，默认使用 GBK
     *
     * @return array
     */
    public function ecomment(string $text, int $type, bool $utf8 = false): array {
        return $this->charset($utf8)
            ->request(API_ECOMMENT, ['text' => $text, 'type' => $type], true);
    }

    /**
     * 消费者评论分析 - 评论挖掘
     *
     * @param string $raw_data 原始评论数据的 http 链接
     *
     * @return array
     */
    public function ecommentMining(string $raw_data): array {
        return $this->request(API_ECOMMENT_MINING, ['raw_data' => $raw_data], true);
    }
}
