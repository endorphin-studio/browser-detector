<?php

namespace EndorphinStudio\Detector\Data;

class Result
{
    /**
     * @var Os
     */
    protected $os;
    /**
     * @var Browser
     */
    protected $browser;
    /**
     * @var Device
     */
    protected $device;
    /**
     * @var Robot
     */
    protected $robot;

    /**
     * @var boolean
     */
    protected $isRobot = false;

    /**
     * @var boolean
     */
    protected $isTouch = false;
    /**
     * @var boolean
     */
    protected $isMobile = false;

    /**
     * @return bool
     */
    public function isRobot(): bool
    {
        return $this->isRobot;
    }

    /**
     * @param bool $isRobot
     */
    public function setIsRobot(bool $isRobot)
    {
        $this->isRobot = $isRobot;
    }

    /**
     * @return bool
     */
    public function isTouch(): bool
    {
        return $this->isTouch;
    }

    /**
     * @param bool $isTouch
     */
    public function setIsTouch(bool $isTouch)
    {
        $this->isTouch = $isTouch;
    }

    /**
     * @return bool
     */
    public function isMobile(): bool
    {
        return $this->isMobile;
    }

    /**
     * @param bool $isMobile
     */
    public function setIsMobile(bool $isMobile)
    {
        $this->isMobile = $isMobile;
    }

    /**
     * @return bool
     */
    public function isTablet(): bool
    {
        return $this->isTablet;
    }

    /**
     * @param bool $isTablet
     */
    public function setIsTablet(bool $isTablet)
    {
        $this->isTablet = $isTablet;
    }

    /** @var boolean */
    protected $isTablet = false;

    public function __construct()
    {
        $this->os = new Os($this);
        $this->device = new Device($this);
        $this->browser = new Browser($this);
        $this->robot = new Robot($this);
    }

    /**
     * @return Os
     */
    public function getOs(): Os
    {
        return $this->os;
    }

    /**
     * @return Browser
     */
    public function getBrowser(): Browser
    {
        return $this->browser;
    }

    /**
     * @return Device
     */
    public function getDevice(): Device
    {
        return $this->device;
    }

    /**
     * @return Robot
     */
    public function getRobot(): Robot
    {
        return $this->robot;
    }
}