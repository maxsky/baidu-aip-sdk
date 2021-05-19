<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/19
 * Time: 17:29
 */

namespace Baidu\Aip\Lib\Traits;

trait FileTrait {

    /**
     * @return string
     */
    private function getFileContentOrCreate(): string {
        $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5($this->appId . $this->apiKey);

        if (!file_exists($filePath)) {
            file_put_contents($filePath, '');
        }

        return $filePath;
    }

    /**
     * 读取本地缓存
     *
     * @return array
     */
    private function readFileObject(): ?array {
        $content = file_get_contents($this->getFileContentOrCreate());

        if ($content) {
            $obj = processResult($content);

            if ($obj) {
                $obj['is_read'] = true;

                if ($obj['time'] + $obj['expires_in'] - 30 > time()) {
                    return $obj;
                }
            }
        }

        return null;
    }

    /**
     * 写入本地文件
     *
     * @param array $object
     *
     * @return void
     */
    private function writeFileObject(array $object): void {
        if (isset($object['is_read']) && $object['is_read'] === true) {
            return;
        }

        $object['time'] = time();

        file_put_contents($this->getFileContentOrCreate(), json_encode($object));
    }

    /**
     * 删除临时文件
     *
     * @return bool
     */
    private function deleteFileObject(): bool {
        return unlink($this->getFileContentOrCreate());
    }
}
