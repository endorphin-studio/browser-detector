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
        testUaList($this,'Robot','Type',$ualist,'RSS Reader');
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
        testUaList($this,'Robot','Type',$ualist,'Search Engine');
        testUaListBooleanTrue($this,'Robot','SearchEngine',$ualist);
    }
    /**
     * Test Yandex Bots
     */
    public function testYandexBot()
    {
        $ualist = array(
            'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots) ',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B411 Safari/600.1.4 (compatible; YandexBot/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexAccessibilityBot/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B411 Safari/600.1.4 (compatible; YandexMobileBot/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexDirectDyn/1.0; +http://yandex.com/bots',
            'Mozilla/5.0 (compatible; YandexScreenshotBot/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexImages/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexVideo/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexMedia/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexBlogs/0.99; robot; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexFavicons/1.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexWebmaster/2.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexPagechecker/1.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexImageResizer/2.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexAdNet/1.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexDirect/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YaDirectFetcher/1.0; Dyatel; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexCalendar/1.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexSitelinks; Dyatel; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexMetrika/2.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexNews/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexNewslinks; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexCatalog/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexAntivirus/2.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexMarket/1.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexVertis/3.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexForDomain/1.0; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexBot/3.0; MirrorDetector; +http://yandex.com/bots)',
            'Mozilla/5.0 (compatible; YandexSpravBot/1.0; +http://yandex.com/bots)'
        );

        testUaList($this,'Robot','Owner',$ualist,'Yandex LLC.');
        testUaList($this,'Robot','Type',$ualist,'Search Engine');
        testUaListBooleanTrue($this,'Robot','SearchEngine',$ualist);
    }
    /**
     * Test Bing Bots
     */
    public function testBingBot()
    {
        $ualist = array(
            'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
            'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 530) like Gecko (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
            'msnbot/2.0b (+http://search.msn.com/msnbot.htm)',
            'msnbot-media/1.1 (+http://search.msn.com/msnbot.htm)',
            'Mozilla/5.0 (compatible; adidxbot/2.0; +http://www.bing.com/bingbot.htm)',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53 (compatible; adidxbot/2.0; +http://www.bing.com/bingbot.htm)',
            'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 530) like Gecko (compatible; adidxbot/2.0; +http://www.bing.com/bingbot.htm)',
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534+ (KHTML, like Gecko) BingPreview/1.0b',
            'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 530) like Gecko BingPreview/1.0b'
        );

        testUaList($this,'Robot','Name',$ualist,'Bing');
        testUaList($this,'Robot','Type',$ualist,'Search Engine');
        testUaListBooleanTrue($this,'Robot','SearchEngine',$ualist);
    }
    /**
     * Test WASALive
     */
    public function testWasaLiveBot()
    {
        $ualist = array(
            'Mozilla/5.0 (compatible; WASALive-Bot ; http://blog.wasalive.com/wasalive-bots/) '
        );

        testUaList($this,'Robot','Name',$ualist,'WASALive Bot');
        testUaList($this,'Robot','Type',$ualist,'Bot/Crawler');
    }
    /**
     * Test .Net robot
     */
    public function testDotNetBot()
    {
        $ualist = array(
            'MS Web Services Client Protocol 1.0.3705.0'
        );

        testUaList($this,'Robot','Name',$ualist,'.NET Framework CLR');
        testUaList($this,'Robot','Type',$ualist,'Bot/Crawler');
    }
    /**
     * Test 007ac9 robot
     */
    public function test007ac9Bot()
    {
        $ualist = array(
            'Mozilla/5.0 (compatible; 007ac9 Crawler; http://crawler.007ac9.net/) '
        );

        testUaList($this,'Robot','Name',$ualist,'007ac9 Crawler');
        testUaList($this,'Robot','Type',$ualist,'Bot/Crawler');
    }
    /**
     * Test 80legs robot
     */
    public function test80legsBot()
    {
        $ualist = array(
            'Mozilla/5.0 (compatible; 008/0.83; http://www.80legs.com/webcrawler.html) Gecko/2008032620 '
        );

        testUaList($this,'Robot','Name',$ualist,'80legs Crawler');
        testUaList($this,'Robot','Type',$ualist,'Bot/Crawler');
    }
    /**
     * Test 80123metaspider robot
     */
    public function test123metaspiderBot()
    {
        $ualist = array(
            '123metaspider-Bot (Version: 1.04, powered by www.123metaspider.com) '
        );

        testUaList($this,'Robot','Name',$ualist,'123metaspider Crawler');
        testUaList($this,'Robot','Type',$ualist,'Bot/Crawler');
    }
    /**
     * Test 1470 robot
     */
    public function test1470Bot()
    {
        $ualist = array(
            '1470.net crawler '
        );

        testUaList($this,'Robot','Name',$ualist,'1470 Crawler');
        testUaList($this,'Robot','Type',$ualist,'Bot/Crawler');
    }
}
