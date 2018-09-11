<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Data;

/**
 * Class Result
 * Class with result of detection
 * @package EndorphinStudio\Detector\Data
 */
class Result implements \JsonSerializable
{
    /**
     * Get User Agent
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /** @var string UserAgent */
    protected $userAgent = null;

    /**
     * @var Os Result of os detection
     */
    protected $os;
    /**
     * @var Browser Result of browser detection
     */
    protected $browser;
    /**
     * @var Device Result of device detection
     */
    protected $device;
    /**
     * @var Robot Result of robot detection
     */
    protected $robot;

    /**
     * @var boolean true if user is robot
     */
    protected $isRobot = false;

    /**
     * @var boolean true if device is touch
     */
    protected $isTouch = false;
    /**
     * @var boolean true if device is mobile
     */
    protected $isMobile = false;

    /**
     * True if user is robot
     * @return bool
     */
    public function isRobot(): bool
    {
        return $this->isRobot;
    }

    /**
     * Setter
     * @param bool $isRobot
     */
    public function setIsRobot(bool $isRobot)
    {
        $this->isRobot = $isRobot;
    }

    /**
     * True if user is touch
     * @return bool
     */
    public function isTouch(): bool
    {
        return $this->isTouch;
    }

    /**
     * Setter
     * @param bool $isTouch
     */
    public function setIsTouch(bool $isTouch)
    {
        $this->isTouch = $isTouch;
    }

    /**
     * True if user is mobile
     * @return bool
     */
    public function isMobile(): bool
    {
        return $this->isMobile;
    }

    /**
     * Setter
     * @param bool $isMobile
     */
    public function setIsMobile(bool $isMobile)
    {
        $this->isMobile = $isMobile;
    }

    /**
     * True if user is tablet
     * @return bool
     */
    public function isTablet(): bool
    {
        return $this->isTablet;
    }

    /**
     * Setter
     * @param bool $isTablet
     */
    public function setIsTablet(bool $isTablet)
    {
        $this->isTablet = $isTablet;
    }

    /** @var boolean true if user is tablet */
    protected $isTablet = false;

    /**
     * Result constructor.
     * @param string $userAgent User Agent
     */
    public function __construct(string $userAgent)
    {
        $this->os = new Os($this);
        $this->device = new Device($this);
        $this->browser = new Browser($this);
        $this->robot = new Robot($this);
        $this->userAgent = $userAgent;
    }

    /**
     * Get result of os detection
     * @return Os
     */
    public function getOs(): Os
    {
        return $this->os;
    }

    /**
     * Get result of browser detection
     * @return Browser
     */
    public function getBrowser(): Browser
    {
        return $this->browser;
    }

    /**
     * Get result of device detection
     * @return Device
     */
    public function getDevice(): Device
    {
        return $this->device;
    }

    /**
     * Get result of robot detection
     * @return Robot
     */
    public function getRobot(): Robot
    {
        return $this->robot;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}