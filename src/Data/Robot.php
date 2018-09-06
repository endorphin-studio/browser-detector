<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Data;

class Robot extends AbstractData
{
    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner)
    {
        $this->owner = $owner;
    }

    /** @var string */
    protected $owner;

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     */
    public function setHomepage(string $homepage)
    {
        $this->homepage = $homepage;
    }

    /** @var string */
    protected $homepage;
}