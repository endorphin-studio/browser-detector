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

    /** @var  \EndorphinStudio\Detector\Device Device */
    public $Device;

    /** @var  \EndorphinStudio\Detector\OS Operating System */
    public $OS;

    /** @var \EndorphinStudio\Detector\Browser */
    public $Browser;

    /** @var \EndorphinStudio\Detector\Robot */
    public $Robot;
}
