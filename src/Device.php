<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 2.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class Device extends Data
{
    /** @var string Model Name */
    public $ModelName = 'N\A';

    /**
     * Device constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct(\SimpleXMLElement $xmlData)
    {
        if($xmlData === null)
        {
            $this->Name = 'Desktop';
            $this->Type = 'desktop';
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
}
