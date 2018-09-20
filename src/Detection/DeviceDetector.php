<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Detection;

/**
 * Detector for device
 * Class DeviceDetector
 * @package EndorphinStudio\Detector\Detection
 */
class DeviceDetector extends BrowserDetector
{
    /**
     * @var string Key in config
     */
    protected $configKey = 'device';

    protected function afterDetection()
    {
        if (
            \array_key_exists('originalInfo', $this->additionalInfo) &&
            \array_key_exists('hasModel', $this->additionalInfo['originalInfo']) &&
            $this->additionalInfo['originalInfo']['hasModel'] === true) {
            // detect model
            $detector = new ModelDetector();
            $detector->init($this->detector);
            $detector->detect($this->additionalInfo);
        }
        parent::afterDetection();
    }
}