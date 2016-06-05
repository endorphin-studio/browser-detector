<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 2.0
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
    public function isIsSearchEngine()
    {
        return $this->isSearchEngine;
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
    public function setIsSearchEngine($isSearchEngine)
    {
        $this->isSearchEngine = $isSearchEngine;
    }
    /** @var string Crawler homepage */
    private $Homepage;

    /** @var boolean Search Engine */
    private $isSearchEngine;

    /** @var string Crawler Owner */
    private $Owner;

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
                }
            }
        }
    }
}
