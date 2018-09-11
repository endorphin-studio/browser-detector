<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Data;

/**
 * Class AbstractData Abstract data with result detector
 * @package EndorphinStudio\Detector\Data
 */
abstract class AbstractData implements \JsonSerializable
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
     * Set name of object
     * @param string $name Name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Set object type
     * @param string $type Type
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
     * Get object name
     * @return string
     */
    public function getName(): string
    {
        return $this->name ?? 'not available';
    }

    /**
     * Get object type
     * @return string
     */
    public function getType(): string
    {
        return $this->type ?? 'not available';
    }

    /**
     * AbstractData constructor.
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    public function jsonSerialize()
    {
        $fields = get_object_vars($this);
        unset($fields['result']);
        return $fields;
    }
}