<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 2.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class OS extends DataWithVersion
{
    /** @var string $Family */
    public $Family;

    /**
     * OS constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct($xmlData)
    {
        parent::__construct($xmlData);
        if($xmlData != null)
        {
            foreach ($xmlData->children() as $child) {
                switch ($child->getName()) {
                    case 'family':
                        switch ($child->__toString()) {
                            case 'UNX':
                                $this->Family = UNX;
                                break;
                            case 'MAC':
                                $this->Family = MAC;
                                break;
                            case 'WIN':
                                $this->Family = WIN;
                                break;
                        }
                        break;
                }
            }
        }
    }

}

define('UNX','unix');
define('WIN','windows');
define('MAC','mac');