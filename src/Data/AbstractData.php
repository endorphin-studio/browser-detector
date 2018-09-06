<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Data;


abstract class AbstractData
{
    /**
     * @var Result Link to Result object
     */
    protected $result;

    /**
     * @var string Name
     */
    protected $name;

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @var string Type
     */
    protected $type;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name ?? 'not available';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type ?? 'not available';
    }

    public function __construct(Result $result)
    {
        $this->result = $result;
    }
}