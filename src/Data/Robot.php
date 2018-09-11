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
 * Class Robot
 * Result of robot detection
 * @package EndorphinStudio\Detector\Data
 */
class Robot extends AbstractData
{
    /**
     * Get robot owner
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * Set robot owner
     * @param string $owner
     */
    public function setOwner(string $owner)
    {
        $this->owner = $owner;
    }

    /** @var string Owner robot */
    protected $owner;

    /**
     * Get robot homepage
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * Set robot homepage
     * @param string $homepage
     */
    public function setHomepage(string $homepage)
    {
        $this->homepage = $homepage;
    }

    /** @var string Robot homepage */
    protected $homepage;
}