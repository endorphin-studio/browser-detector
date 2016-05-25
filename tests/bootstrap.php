<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

$vendor = realpath(__DIR__ . '/../vendor');
if (file_exists($vendor . '/autoload.php')) {
    require $vendor . '/autoload.php';
} else {
    $vendor = realpath(__DIR__ . '/../../../');
    if (file_exists($vendor . '/autoload.php')) {
        require $vendor . '/autoload.php';
    } else {
        throw new Exception('Unable to load dependencies');
    }
}