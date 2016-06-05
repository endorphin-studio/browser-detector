<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

namespace EndorphinStudio\Tests;


class RobotTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test Tine RSS
     */
    public function testTinyRSS()
    {
        $ualist = array(
            'Tiny Tiny RSS/1.10 (http://tt-rss.org/)'
        );

        testUaList($this,'Robot','Name',$ualist,'Tiny RSS');
    }
    /**
     * Test Google Bots
     */
    public function testGoogleBot()
    {
        $ualist = array(
            'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
            'Googlebot/2.1 (+http://www.google.com/bot.html)',
            'Googlebot-News',
            'Googlebot-Image/1.0',
            'Googlebot-Video/1.0',
            'SAMSUNG-SGH-E250/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Browser/6.2.3.3.c.1.101 (GUI) MMP/2.0 (compatible; Googlebot-Mobile/2.1; +http://www.google.com/bot.html)',
            'DoCoMo/2.0 N905i(c100;TB;W24H16) (compatible; Googlebot-Mobile/2.1; +http://www.google.com/bot.html)',
            'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
            '(compatible; Mediapartners-Google/2.1; +http://www.google.com/bot.html)',
            'Mediapartners-Google'
        );

        testUaList($this,'Robot','Owner',$ualist,'Google Inc.');
    }
}
