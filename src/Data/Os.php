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
 * Class Os
 * Detect of os detection
 * @package EndorphinStudio\Detector\Data
 */
class Os extends AbstractDataWithVersion
{
    /**
     * @return string Os family
     */
    public function getFamily(): string
    {
        return $this->family;
    }

    /**
     * Set Os family
     * @param string $family
     */
    public function setFamily(string $family)
    {
        $this->family = $family;
    }

    /** @var string Os family */
    protected $family;

    /**
     * @return string Browser type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set browser type
     * @param string $type Browser type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @var string Browser type
     */
    protected $type;
}