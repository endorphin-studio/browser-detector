<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Tests;

use EndorphinStudio\Detector\Detector;
use EndorphinStudio\Detector\Exception\StorageException;
use EndorphinStudio\Detector\Tools;

class ModelTest extends BaseTest
{
    public static $type = 'model';

    public function testBase()
    {
        error_reporting(E_ALL);
        if (static::$type === 'none') {
            $this->assertTrue(true);
            return true;
        }
        $caseList = $this->config->getTestCases(static::$type)['cases'];
        try {
            $detector = new Detector();
            foreach ($caseList as $case) {
                $results = [];
                foreach ($case['uaList'] as $ua) {
                    $result = $detector->analyse($ua)->getDevice();
                    $results[] = Tools::runGetter($result, static::$type);
                }
                foreach ($case['checkList'] as $field => $expected) {
                    foreach ($results as $resultIndex => $result) {
                        $real = Tools::runGetter($result, $field);
                        $this->assertEquals($expected, $real, print_r(['result' => $resultIndex, 'case' => $case ],1));
                    }
                }
            }
        } catch (StorageException $exception) {
            echo $exception->getMessage();
        }
    }
}