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