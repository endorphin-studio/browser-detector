<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 3.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class OS extends DataWithVersion
{
    /** @var string $Family */
    public $Family = D_NA;

    /**
     * OS constructor.
     * @param \SimpleXMLElement $xmlData Xml data from file
     */
    public function __construct(\SimpleXMLElement $xmlData)
    {
        parent::__construct($xmlData);
        if($xmlData !== null)
        {
            foreach ($xmlData->children() as $child) {
                switch ($child->getName()) {
                    case 'family':
                        switch ($child->__toString()) {
                            case 'UNX':
                                $this->Family = UNX;
                                break;
                            case 'MC':
                                $this->Family = MC;
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

    public static function initEmpty()
    {
        return new self(new \SimpleXMLElement('<null>null</null>'));
    }

}

define('UNX','unix');
define('WIN','windows');
define('MC','mac');
