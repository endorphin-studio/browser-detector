Detect user Browser, OS and Device through USER AGENT
[Live demo](http://detector.endorphin-studio.ru/demo/)

## Code Status
[![Latest Stable Version](https://poser.pugx.org/endorphin-studio/browser-detector/v/stable)](https://packagist.org/packages/endorphin-studio/browser-detector) [![Total Downloads](https://poser.pugx.org/endorphin-studio/browser-detector/downloads)](https://packagist.org/packages/endorphin-studio/browser-detector) [![Latest Unstable Version](https://poser.pugx.org/endorphin-studio/browser-detector/v/unstable)](https://packagist.org/packages/endorphin-studio/browser-detector) [![License](https://poser.pugx.org/endorphin-studio/browser-detector/license)](https://packagist.org/packages/endorphin-studio/browser-detector)
[![Build Status](https://travis-ci.org/endorphin-studio/browser-detector.svg?branch=v2.0)](https://travis-ci.org/endorphin-studio/browser-detector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/badges/quality-score.png?b=v2.0)](https://scrutinizer-ci.com/g/endorphin-studio/browser-detector/?branch=v2.0)

## About
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