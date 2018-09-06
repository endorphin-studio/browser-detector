<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Storage;

/**
 * Interface StorageInterface
 * Interface for abstract Storage Provider
 * @package EndorphinStudio\Detector\Storage
 */
interface StorageInterface
{
    /**
     * @param string $directory Set Data directory for loading
     * @return void
     */
    public function setDataDirectory(string $directory);

    /**
     * Get array of Data
     * @return array array of data
     */
    public function getConfig(): array;
}