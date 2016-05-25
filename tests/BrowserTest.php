<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

namespace EndorphinStudio\Tests;
use EndorphinStudio\Detector\Detector;

class BrowserTest extends \PHPUnit_Framework_TestCase
{
    public function testFirefox()
    {
        $this->assertEquals('Firefox',Detector::Analyse('Mozilla/5.0 (Windows NT 6.3; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0 ')->Browser->Name);
    }
    public function testOpera()
    {
        $this->assertEquals('Opera',Detector::Analyse('Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16')->Browser->Name);
    }

}
