<?php


namespace EndorphinStudio\Detector\Data;


abstract class AbstractDataWithVersion extends AbstractData
{
    /**
     * @var string Version
     */
    protected $version;

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }

}