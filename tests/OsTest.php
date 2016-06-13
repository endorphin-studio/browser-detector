<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

namespace EndorphinStudio\Tests;


class OsTest extends \PHPUnit_Framework_TestCase
{
    public function testLinux()
    {
        $ualist = array(
            'Mozilla/1.1I (X11; I; UNIX_SV 4.2MP R4000)',
        );
        testUaList($this,'OS','Name',$ualist,'Linux');
    }

    public function testAIX()
    {
        $ualist = array(
            'Mozilla/4.04j2 [en] (X11; I; AIX 4.2) ',
        );

        testUaList($this,'OS','Name',$ualist,'AIX');
    }

    public function testAliyunOS()
    {
        $ualist = array(
            'Mozilla/5.0 (Linux; U; AliyunOS 2.0; Android 4.0 Compatible; xx; R819T Build/AliyunOs-2012) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
        );

        testUaList($this,'OS','Name',$ualist,'Aliyun OS');
    }
}