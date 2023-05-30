<?php

/**
 * Created by IntelliJ IDEA.
 * User: maxsky
 * Date: 2021/5/14
 * Time: 20:41
 */

/** 版本 */
const API_VERSION = '2_2_20';

const ERROR_MSG = [
    216101 => 'not enough param'
];

$files = glob(__DIR__ . DIRECTORY_SEPARATOR . 'API/*.php');

foreach ($files as $file) {
    require_once $file;
}
