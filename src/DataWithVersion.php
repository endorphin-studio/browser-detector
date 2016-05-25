<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 2.0
 * @project browser-detector
 */

namespace EndorphinStudio;


class DataWithVersion extends Data
{
    /**
     * @var string Version
     */
    public $Version;

    /**
     * DataWithVersion constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct($xmlData)
    {
        parent::__construct($xmlData);
    }
}