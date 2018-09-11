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

$detector = new Detector();

/** @var \EndorphinStudio\Detector\Data\Result $result */
$result = $detector->analyze();

echo json_encode($result);
