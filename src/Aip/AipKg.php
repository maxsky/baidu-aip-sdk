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

class AipKg extends AipBase {

    /**
     * 创建任务
     *
     * @param string $name               任务名字
     * @param string $template_content   json string 解析模板内容
     * @param string $input_mapping_file 抓取结果映射文件的路径
     * @param string $output_file        输出文件名字
     * @param string $url_pattern        url pattern
     * @param int    $limit_count        限制解析数量limit_count为0时进行全量任务，大于 0 时仅解析指定数量的页面
     *
     * @return array
     */
    public function createTask(string $name, string $template_content, string $input_mapping_file,
                               string $output_file, string $url_pattern, int $limit_count = 0): array {
        $data = [
            'name' => $name,
            'template_content' => $template_content,
            'input_mapping_file' => $input_mapping_file,
            'output_file' => $output_file,
            'url_pattern' => $url_pattern,
            'limit_count' => $limit_count
        ];

        return $this->request(API_TASK_CREATE, $data);
    }

    /**
     * 更新任务
     *
     * @param int   $id      任务 ID
     * @param array $options 可选参数列表:
     *                       name 任务名字
     *                       template_content json string 解析模板内容
     *                       input_mapping_file 抓取结果映射文件的路径
     *                       url_pattern url pattern
     *                       output_file 输出文件名字
     *
     * @return array
     */
    public function updateTask(int $id, array $options = []): array {
        $data = array_merge(['id' => $id], $options);

        return $this->request(API_TASK_UPDATE, $data);
    }

    /**
     * 获取任务详情
     *
     * @param int $id 任务 ID
     *
     * @return array
     */
    public function getTaskInfo(int $id): array {
        return $this->request(API_TASK_INFO, ['id' => $id]);
    }

    /**
     * 以分页的方式查询当前用户所有的任务信息
     *
     * @param array $options 可选参数列表:
     *                       id 任务ID，精确匹配
     *                       name 中缀模糊匹配，abc 可以匹配 abc、aaabc、abcde 等
     *                       status 要筛选的任务状态
     *                       page 页码
     *                       per_page 页码
     *
     * @return array
     */
    public function getUserTasks(array $options = []): array {
        return $this->request(API_TASK_QUERY, $options);
    }

    /**
     * 启动任务
     *
     * @param int $id 任务ID
     *
     * @return array
     */
    public function startTask(int $id): array {
        return $this->request(API_TASK_START, ['id' => $id]);
    }

    /**
     * 查询任务状态
     *
     * @param int $id 任务ID
     *
     * @return array
     */
    public function getTaskStatus(int $id): array {
        return $this->request(API_TASK_STATUS, ['id' => $id]);
    }
}
