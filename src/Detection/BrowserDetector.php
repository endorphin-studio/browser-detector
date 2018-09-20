<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

/**
 * Detector of browser
 * Class BrowserDetector
 * @package EndorphinStudio\Detector\Detection
 */
class BrowserDetector extends AbstractDetection
{
    /**
     * @var string Key in config
     */
    protected $configKey = 'browser';

    /**
     * Setup result of object
     */
    protected function setupResultObject()
    {
        $browserData = $this->detectByType();
        foreach ($browserData as $key => $value) {
            if ($key === 'originalInfo') {
                $this->setAttributes($value);
                continue;
            }
            Tools::runSetter($this->resultObject, $key, $value);
        }
        $this->additionalInfo = $browserData;
    }
}