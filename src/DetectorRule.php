<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 3.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class DetectorRule
{
    private $RuleType;
    private $ObjectProperty;
    private $ObjectPropertyValue;

    public function __construct(\SimpleXMLElement $xmlData)
    {

    }

    public static function loadRulesFromFile($path)
    {

    }
}