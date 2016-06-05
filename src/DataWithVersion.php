<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 2.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class DataWithVersion extends Data
{
    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->Version;
    }

    /**
     * @param string $Version
     */
    public function setVersion($Version)
    {
        $this->Version = $Version;
    }
    /**
     * @var string Version
     */
    protected $Version;

    /**
     * DataWithVersion constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct($xmlData)
    {
        parent::__construct($xmlData);
    }
}