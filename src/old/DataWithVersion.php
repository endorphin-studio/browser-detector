<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 3.0.0
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
    protected $Version = D_NA;

    /**
     * DataWithVersion constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct(\SimpleXMLElement $xmlData)
    {
        parent::__construct($xmlData);
    }

    public static function initEmpty()
    {
        return new self(new \SimpleXMLElement('<null>null</null>'));
    }
}
