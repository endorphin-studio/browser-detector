<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class DetectorResult
{
    /**
     * @var string User Agent
     */
    public $uaString;
    /**
     * @var boolean Is Bot
     */
    public $isBot;

    /** @var boolean Is Mobile */
    public $isMobile;

    /** @var  \EndorphinStudio\Device Device */
    public $Device;

    /** @var  \EndorphinStudio\OS Operating System */
    public $OS;

    /** @var \EndorphinStudio\Browser */
    public $Browser;

    /** @var \EndorphinStudio\SearchRobot */
    public $Crawler;
}