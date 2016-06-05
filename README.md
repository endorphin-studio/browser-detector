Detect user Browser, OS and Device through USER AGENT
[Live demo](http://detector.endorphin-studio.ru/demo/)

## Code Status
[![Latest Stable Version](https://poser.pugx.org/endorphin-studio/browser-detector/v/stable)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![Total Downloads](https://poser.pugx.org/endorphin-studio/browser-detector/downloads)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![License](https://poser.pugx.org/endorphin-studio/browser-detector/license)](https://packagist.org/packages/endorphin-studio/browser-detector)


[![Build Status](https://travis-ci.org/endorphin-studio/browser-detector.svg?branch=2.0.1)](https://travis-ci.org/endorphin-studio/browser-detector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/badges/quality-score.png?b=2.0.1)](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/?branch=2.0.1)
[![Percentage of issues still open](http://isitmaintained.com/badge/open/endorphin-studio/browser-detector.svg)](http://isitmaintained.com/project/endorphin-studio/browser-detector "Percentage of issues still open")
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7fd738b4-54a9-4e02-b647-adf14dd4e5ff/mini.png)](https://insight.sensiolabs.com/projects/7fd738b4-54a9-4e02-b647-adf14dd4e5ff)

## About
This version is refactoring of [endorphinua/browser-detector](https://github.com/endorphinua/browser-detector) repository

	Author: Sergey Nehaenko <sergey.nekhaenko@gmail.com>
	Current Version: 2.0.1
	Stable Version: 2.0
	Last Update: 05.06.2016
	License: GPLv3

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

#### Operating System Detection Support

    Windows Phone, Windows Mobile, Windows, iOS, Android, Linux, Ubuntu, Chromium OS, Bada, Maemo

#### Device Detection Support

    Microsoft Lumia, iPhone, iPod, iPad, Android based, Dell, NOOK, Samsung, Toshiba, HTC, Cisco, Asus,
    Google Nexus, Kindle Fire, Motorolla, Microsoft Sursace, Sony Ericsson, Nokia

#### Crawlers (Robots) Detection Support

    Google Bots, Tiny RSS, Yandex Bots
