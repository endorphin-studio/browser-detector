<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 2.0
 * @project browser-detector
 */

namespace EndorphinStudio;


class Data
{
    /**
     * @var string Name
     */
    public $Name = 'N\A';
    /** @var string Type */
    public $Type = 'N\A';

    /**
     * Data constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct($xmlData)
    {
        if($xmlData != null)
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

}