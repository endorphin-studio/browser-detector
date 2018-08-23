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

$detector = new Detector();
$detector->analyze('Mozilla/5.0 (iPhone; CPU iPhone OS 11_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) FxiOS/12.2b11231 Mobile/15G77 Safari/605.1.15');
