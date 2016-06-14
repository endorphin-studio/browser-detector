<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

namespace EndorphinStudio\Tests;

use EndorphinStudio\Tests\Test;

class RootTest extends \PHPUnit_Framework_TestCase
{
    public function testFiles()
    {
        $tests = simplexml_load_file(__DIR__.'/data/tests.xml');
        foreach($tests->children() as $test)
        {
            $testFile = simplexml_load_file(__DIR__.'/data/ua/'.$test->file.'.xml');
            foreach($testFile as $testCase)
            {
                Test::testUaList($this,$testCase->CheckList,$testCase->UAList);
            }
        }
    }

}
