<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/19
 * Time: 17:30
 */

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

    public function testExample() {
        $aip = new \Baidu\Aip\AipOcrGeneric('', '', '');

        $this->assertSame($aip->getVersion(), '2_2_20');
    }
}
