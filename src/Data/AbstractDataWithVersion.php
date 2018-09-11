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
 * Class AbstractDataWithVersion Data Object with version
 * @package EndorphinStudio\Detector\Data
 */
abstract class AbstractDataWithVersion extends AbstractData
{
    /**
     * @var string Version
     */
    protected $version;

    /**
     * Set version of version
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version Version
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }

}