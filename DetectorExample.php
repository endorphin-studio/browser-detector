<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project browser-detector
 */

require_once __DIR__ . '/vendor/autoload.php';

use EndorphinStudio\Detector\Detector;

try {
    $detector = new Detector();
    $detector->analyze('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
} catch (\EndorphinStudio\Detector\Exception\StorageException $exception) {
    // log error
}
