<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/6/4
 * Time: 17:18
 */

namespace BaiduAipTests\TestHelper;

use BaiduAipTests\TestCase;

class HelperTest extends TestCase {

    public function testIsUrl() {
        $this->assertTrue(isUrl('https://ai.baidu.com'));
    }
}