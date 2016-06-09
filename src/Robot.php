<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 3.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;


class Robot extends Data
{
    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->Homepage;
    }

    /**
     * @return boolean
     */
    public function isSearchEngine()
    {
        return $this->SearchEngine;
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->Owner;
    }

    /**
     * @param string $Homepage
     */
    public function setHomepage($Homepage)
    {
        $this->Homepage = $Homepage;
    }

    /**
     * @param string $Owner
     */
    public function setOwner($Owner)
    {
        $this->Owner = $Owner;
    }

    /**
     * @param boolean $isSearchEngine
     */
    public function setSearchEngine($isSearchEngine)
    {
        $this->SearchEngine = $isSearchEngine;
    }
    /** @var string Crawler homepage */
    private $Homepage = D_NA;

    /** @var boolean Search Engine */
    private $SearchEngine = false;

    /** @var string Crawler Owner */
    private $Owner = D_NA;

    public function __construct(\SimpleXMLElement $xmlData)
    {
        parent::__construct($xmlData);

        if($xmlData !== null)
        {
            foreach ($xmlData->children() as $child)
            {
                switch ($child->getName())
                {
                    case 'url':
                        $this->Homepage = $child->__toString();
                        break;
                    case 'owner':
                        $this->Owner = $child->__toString();
                        break;
                    case 'isse':
                        $val = $child->__toString();
                        if($val == 'true')
                        {
                            $this->setSearchEngine(true);
                        }
                        else
                            $this->setSearchEngine(false);
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
