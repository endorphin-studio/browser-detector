<?php

namespace EndorphinStudio\Tests;

use EndorphinStudio\Detector\Detector;
use EndorphinStudio\Detector\Exception\StorageException;
use EndorphinStudio\Detector\Tools;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    protected $config;
    protected $detector;
    protected static $type = 'none';

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->config = new YamlReader();
        try {
            $this->detector = new Detector();
        } catch (StorageException $exception) {
            echo $exception->getMessage();
        }
    }

    public function testType()
    {
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
                    $result = $detector->analyze($ua);
                    $results[] = Tools::runGetter($result, static::$type);
                }
                foreach ($case['checkList'] as $field => $expected) {
                    foreach ($results as $result) {
                        $real = Tools::runGetter($result, $field);
                        $this->assertEquals($expected, $real);
                    }
                }
            }
        } catch (StorageException $exception) {
            echo $exception->getMessage();
        }
    }
}