<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Data;

class Browser extends AbstractDataWithVersion
{
    /** @var string */
    protected $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}