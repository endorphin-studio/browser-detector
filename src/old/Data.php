<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 3.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class Data
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @param string $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }
    /**
     * @var string Name
     */
    protected $Name = D_NA;
    /** @var string Type */
    protected $Type = D_NA;

    /**
     * Data constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct(\SimpleXMLElement $xmlData)
    {
        if($xmlData !== null)
        {
            foreach ($xmlData->children() as $child) {
                switch ($child->getName()) {
                    case 'name':
                        $this->Name = $child->__toString();
                        break;
                    case 'type':
                        $this->Type = $child->__toString();
                        break;
                }
            }
        }
    }

    public static function initEmpty()
    {
        return new self(new \SimpleXMLElement('<null>null</null>'));
    }
}
