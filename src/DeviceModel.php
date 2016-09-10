<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class DeviceModel
{
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * @param string $deviceName
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    private $id;

    private $deviceName;

    private $pattern;

    public function __construct(\SimpleXMLElement $xmlData)
    {
        if($xmlData !== null)
        {
            foreach ($xmlData->children() as $child)
            {
                $name = $child->getName();
                $val = $child->__toString();
                $this->$name = $val;
            }
        }
    }

    /**
     * @return array Array of EndorphinStudio\Detector\DeviceModel objects
     */
    public static function loadFromFile()
    {
        $path = str_replace('src','data',__DIR__).'/deviceModels.xml';
        $models = array();
        $xmlObj = simplexml_load_file($path);
        foreach($xmlObj->children() as $rule)
        {
            $models[] = new self($rule);
        }

        return $models;
    }
}