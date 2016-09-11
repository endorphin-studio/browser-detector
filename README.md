Detect user Browser, OS and Device through USER AGENT
[Live demo](http://detector.endorphin-studio.ru/demo/)

## Code Status
[![Latest Stable Version](https://poser.pugx.org/endorphin-studio/browser-detector/v/stable)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![Total Downloads](https://poser.pugx.org/endorphin-studio/browser-detector/downloads)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![License](https://poser.pugx.org/endorphin-studio/browser-detector/license)](https://packagist.org/packages/endorphin-studio/browser-detector)


[![Build Status](https://travis-ci.org/endorphin-studio/browser-detector.svg?branch=3.0.0)](https://travis-ci.org/endorphin-studio/browser-detector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/badges/quality-score.png?b=3.0.0)](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/?branch=3.0.0)
[![Percentage of issues still open](http://isitmaintained.com/badge/open/endorphin-studio/browser-detector.svg)](http://isitmaintained.com/project/endorphin-studio/browser-detector "Percentage of issues still open")
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/80f8b2e1-434d-43b3-97ab-d77c9cc4b1ef/mini.png)](https://insight.sensiolabs.com/projects/80f8b2e1-434d-43b3-97ab-d77c9cc4b1ef)

## About
	Author: Sergey Nehaenko <sergey.nekhaenko@gmail.com>
	Current Version: 3.0.1
	Stable Version: 3.0.0
	Last Update: 10.09.2016
	License: GPL-3.0+

## Requirements
	PHP 5.6+

## Install via Composer
    composer require endorphin-studio/browser-detector
## Basic Usage

    use EndorphinStudio\Detector\Detector;

    $result = Detector::analyse();
    print($result);

#### Browser Detection Support

    Google Chrome, Firefox, Opera, Opera Mini, Opera Mobile, Internet Explorer, Internet Explorer Mobile
    Edge, Epiphany, Chimera, CometBird, Kylo, iCab, Chromium, Beamrise, Camino, Columbus,
    Deepnet Explorer, Yandex Browser, AOL Explorer, IceWeasel, Flock, Netscape Navigator,
    Dolphin, Atomic, Chrome Mobile, Arora, Midori, Conkeror, Skyfire, Maxthon, Rekonq, Safari, Konqueror
    QQ Browser

#### Operating System Detection Support

    Windows Phone, Windows Mobile, Windows, iOS, Android, Linux, Ubuntu, Chromium OS, Bada, Maemo
    AIX, Aliyun OS, Amiga, Android (TV), Apple (TV), Qtopia, Arch Linux, Mac OS X, AROS, Baidy Yi,
    BeOS, BlackBerry OS

#### Device Detection Support

    Microsoft Lumia, iPhone, iPod, iPad, Android based, Dell, NOOK, Samsung, Toshiba, HTC, Cisco, Asus,
    Google Nexus, Kindle Fire, Motorolla, Microsoft Sursace, Sony Ericsson, Nokia, Apple TV, Zune HD
    ZTE, Zaurus

#### Device Model Detection Support

    Microsoft Lumia

#### Crawlers (Robots) Detection Support

    Google Bots, Tiny RSS, Yandex Bots, Bing, WASALive, .NET Framework CLR, 007ac9 Crawler, 80legs Crawler,
    123metaspider Crawler, 1470 Crawler, Yodao, Yisou Spider, Yioop Bot, Baidu
