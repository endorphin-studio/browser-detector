<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 3.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class Device extends Data
{
    /**
     * @return string
     */
    public function getModelName()
    {
        return $this->ModelName;
    }

    /**
     * @param string $ModelName
     */
    public function setModelName($ModelName)
    {
        $this->ModelName = $ModelName;
    }

    /** @var string Model Name */
    public $ModelName = D_NA;

    /**
     * Device constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct(\SimpleXMLElement $xmlData)
    {
        if($xmlData === null || $xmlData->getName() == 'null')
        {
            parent::__construct($xmlData);

            $this->setName('Desktop');
            $this->setType('desktop');
        }
        else
        {
            parent::__construct($xmlData);

            foreach ($xmlData->children() as $child)
            {
                switch ($child->getName()) {
                    case 'modelName':
                        $this->ModelName = $child->__toString();
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
