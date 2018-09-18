Detect user Browser, OS and Device through USER AGENT
[Live demo](http://detector.endorphin-studio.ru/demo/)

## Code Status
[![Latest Stable Version](https://poser.pugx.org/endorphin-studio/browser-detector/v/stable)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![Total Downloads](https://poser.pugx.org/endorphin-studio/browser-detector/downloads)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![License](https://poser.pugx.org/endorphin-studio/browser-detector/license)](https://packagist.org/packages/endorphin-studio/browser-detector)


[![Build Status](https://travis-ci.org/endorphin-studio/browser-detector.svg?branch=4.0)](https://travis-ci.org/endorphin-studio/browser-detector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/badges/quality-score.png?b=4.0)](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/?branch=4.0)
[![Percentage of issues still open](http://isitmaintained.com/badge/open/endorphin-studio/browser-detector.svg)](http://isitmaintained.com/project/endorphin-studio/browser-detector "Percentage of issues still open")
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/80f8b2e1-434d-43b3-97ab-d77c9cc4b1ef/mini.png)](https://insight.sensiolabs.com/projects/80f8b2e1-434d-43b3-97ab-d77c9cc4b1ef)

## About
	Author: Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
	Current Version: 4.0.1
	Stable Version: 4.0.1
	License: GPL-3.0+

## Requirements
	PHP 7.0+

## Install via Composer
    composer require endorphin-studio/browser-detector
## Basic Usage

    use EndorphinStudio\Detector\Detector;
    
    $detector = new Detector();
    $result = $detector->analyse();
    
    echo json_encode($result);

    // Result
    {
      "userAgent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
      "os": {
        "family": "unix",
        "type": "desktop",
        "version": "x86.64",
        "name": "Linux"
      },
      "browser": {
        "type": "desktop",
        "version": "66.0.3359.181",
        "name": "Chrome"
      },
      "device": {
        "version": null,
        "name": "PC",
        "type": "desktop"
      },
      "robot": {
        "owner": null,
        "homepage": null,
        "name": null,
        "type": null
      },
      "isRobot": false,
      "isTouch": false,
      "isMobile": false,
      "isTablet": false
    }

#### Browser Detection Support

    Google Chrome, Firefox, Opera, Opera Mini, Opera Mobile, Internet Explorer, Internet Explorer Mobile
    Edge, Epiphany, Chimera, CometBird, Kylo, iCab, Chromium, Beamrise, Camino, Columbus,
    Deepnet Explorer, Yandex Browser, AOL Explorer, IceWeasel, Flock, Netscape Navigator,
    Dolphin, Atomic, Chrome Mobile, Arora, Midori, Conkeror, Skyfire, Maxthon, Rekonq, Safari, Konqueror
    QQ Browser, Samsung Browser, UC Browser, Puffin, Safari Mobile, Yandex Browser (mobile)
    Chrome Mobile

#### Operating System Detection Support

    Windows Phone, Windows Mobile, Windows, iOS, Android, Linux, Ubuntu, Chromium OS, Bada, Maemo
    AIX, Aliyun OS, Amiga, Android (TV), Apple (TV), Qtopia, Arch Linux, Mac OS X, AROS, Baidy Yi,
    BeOS, BlackBerry OS, Tizen

#### Device Detection Support

    Microsoft Lumia, iPhone, iPod, iPad, Android based, Dell, NOOK, Samsung, Toshiba, HTC, Cisco, Asus,
    Google Nexus, Kindle Fire, Motorolla, Microsoft Sursace, Sony Ericsson, Nokia, Apple TV, Zune HD
    ZTE, Zaurus, Megafon, Smart TV, Philips Smart TV , Toshiba Smart TV, Sony Bravia Smart TV, LG Smart TV
    Roku, Amazon Fire Stick, Google Chromecast, Xbox One, Playstation 4, Playstation Vita, Nintendo 3DS
    Samsung Galaxy Note, Samsung Galaxy, HTC One, Google Pixel C, Nvidia Shield, Amazon Kindle, Xiaomi

### Device Type Detection

    - tv
    - mobile
    - tablet
    - player
    - console
    - desktop

#### Crawlers (Robots) Detection Support

    Google Bots, Tiny RSS, Yandex Bots, Bing, WASALive, .NET Framework CLR, 007ac9 Crawler, 80legs Crawler,
    123metaspider Crawler, 1470 Crawler, Yodao, Yisou Spider, Yioop Bot, Baidu
