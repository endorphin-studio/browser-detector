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
    }
}
