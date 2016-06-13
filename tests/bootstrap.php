<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

$vendor = realpath(__DIR__ . '/../vendor/');

define('__SRC__',str_replace('tests','src',__DIR__));
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

use Symfony\Component\ClassLoader\Psr4ClassLoader;
use EndorphinStudio\Detector\Detector;

$loader = new Psr4ClassLoader();
$loader->addPrefix('EndorphinStudio\\Detector', __SRC__);
$loader->register();

function testUaList($object,$detectorProperty,$property,$uaList,$expectedValue)
{
    foreach($uaList as $ua)
    {
        $obj = Detector::analyse($ua)->$detectorProperty;
        $func = 'get'.$property;
        $object->assertNotNull($obj);
        $object->assertEquals($expectedValue,$obj->$func());
    }
}

function testUaListBooleanTrue($object,$detectorProperty,$property,$uaList)
{
    foreach($uaList as $ua)
    {
        $obj = Detector::analyse($ua)->$detectorProperty;
        $func = 'is'.$property;
        $object->assertTrue($obj->$func(),'Object Property '.$property.' is no equal TRUE');
    }
}

function testUaListIsProperty($object,$detectorProperty,$uaList,$expectedValue)
{
    foreach($uaList as $ua)
    {
        $object->assertEquals($expectedValue,Detector::analyse($ua)->$detectorProperty);
    }
}