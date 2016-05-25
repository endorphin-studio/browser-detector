## browser-detector
Detect user Browser, OS and Device through USER AGENT
[Live demo](http://detector.endorphin-studio.ru/demo/)

[![Build Status](https://travis-ci.org/endorphin-studio/browser-detector.svg?branch=v2.0)](https://travis-ci.org/endorphin-studio/browser-detector)

This version is refactoring of [endorphinua/browser-detector](https://github.com/endorphinua/browser-detector) repository

	Author: Sergey Nehaenko <sergey.nekhaenko@gmail.com>
	Current Version: 2.0
	Last Update: 25.05.2016
	License: GPLv3
	Last Readme Fix: 25.05.2016

## Install via Composer
    composer require endorphin-studio/browser-detector

## Basic Usage

    use EndorphinStudio\Detector;

    $result = Detector::Analyse();
    print($result);