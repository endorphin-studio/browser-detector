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
    /**
     * @return string
     */
    public function getObjectType()
    {
        return $this->ObjectType;
    }

    /**
     * @return string
     */
    public function getObjectProperty()
    {
        return $this->ObjectProperty;
    }

    /**
     * @return string
     */
    public function getObjectPropertyValue()
    {
        return $this->ObjectPropertyValue;
    }

    /**
     * @return string
     */
    public function getTargetType()
    {
        return $this->TargetType;
    }

    /**
     * @return boolean
     */
    public function isTargetValue()
    {
        return $this->TargetValue;
    }

    /**
     * @param string $ObjectType
     */
    public function setObjectType($ObjectType)
    {
        $this->ObjectType = $ObjectType;
    }

    /**
     * @param boolean $TargetValue
     */
    public function setTargetValue($TargetValue)
    {
        $this->TargetValue = $TargetValue;
    }

    /**
     * @param string $TargetType
     */
    public function setTargetType($TargetType)
    {
        $this->TargetType = $TargetType;
    }

    /**
     * @param string $ObjectPropertyValue
     */
    public function setObjectPropertyValue($ObjectPropertyValue)
    {
        $this->ObjectPropertyValue = $ObjectPropertyValue;
    }

    /**
     * @param string $ObjectProperty
     */
    public function setObjectProperty($ObjectProperty)
    {
        $this->ObjectProperty = $ObjectProperty;
    }
    /** @var string EndorphinStudio\Detector\DetectorResult object name */
    private $ObjectType;
    /** @var string EndorphinStudio\Detector\DetectorResult property name */
    private $ObjectProperty;
    /** @var string EndorphinStudio\Detector\DetectorResult property value */
    private $ObjectPropertyValue;
    /** @var string EndorphinStudio\Detector\DetectorResult property name */
    private $TargetType;
    /** @var boolean boolean value */
    private $TargetValue;

    public function __construct(\SimpleXMLElement $xmlData)
    {
        if($xmlData !== null)
        {
            foreach ($xmlData->children() as $child) {
                switch ($child->getName())
                {
                    case 'objectType':
                        $this->ObjectType = $child->__toString();
                        break;
                    case 'objectProperty':
                        $this->ObjectProperty = $child->__toString();
                        break;
                    case 'objectPropertyValue':
                        $this->ObjectPropertyValue = $child->__toString();
                        break;
                    case 'targetType':
                        $this->TargetType = $child->__toString();
                        break;
                    case 'targetProperty':
                        $boolVal = $child->__toString();
                        if($boolVal == 'true')
                        {
                            $this->TargetValue = true;
                        }
                        else
                        {
                            $this->TargetValue = false;
                        }
                        break;
                }
            }
        }
    }

    /**
     * @return array Array of EndorphinStudio\Detector\DetectorRule objects
     */
    public static function loadRulesFromFile()
    {
        $path = str_replace('src','data',__DIR__).'/rules/';
        $files = scandir($path);
        $rules = array();
        foreach($files as $file)
        {
            if($file != '.' && $file != '..')
            {
                $xmlObj = simplexml_load_file($path.$file);
                foreach($xmlObj->children() as $rule)
                {
                    $rules[] = new self($rule);
                }
            }
        }

        return $rules;
    }
}
