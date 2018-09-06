<?php

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