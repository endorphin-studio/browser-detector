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
 * Class Browser
 * Result of browser detection
 * @package EndorphinStudio\Detector\Data
 */
class Browser extends AbstractDataWithVersion
{
    /** @var string Browser type */
    protected $type;

    /**
     * Get browser type
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type Browser type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}