<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

require_once __DIR__ . '/vendor/autoload.php';

use EndorphinStudio\Detector\Detector;

try {
    $detector = new Detector();
    $result = $detector->analyze();
    var_dump($result);
} catch (\EndorphinStudio\Detector\Exception\StorageException $exception) {
    // log error
}
