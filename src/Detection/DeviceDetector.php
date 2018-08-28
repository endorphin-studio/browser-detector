<?php


namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

class DeviceDetector extends BrowserDetector
{
    public function detect(string $ua)
    {
        $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), 'device');
        $this->initResultObject();
        $this->setupResultObject();
    }


    private function initResultObject()
    {
        $result = $this->detector->getResultObject()->getDevice();

        // init default value from data
        foreach ($this->config['default'] as $defaultKey => $defaultValue) {
            Tools::runSetter($result, $defaultKey, $defaultValue);
        }
    }

    private function setupResultObject()
    {
        $result = $this->detector->getResultObject()->getDevice();
        $browserData = $this->detectByType();
        foreach ($browserData as $key => $value) {
            if ($key === 'originalInfo') {
                $this->setAttributes($value);
                continue;
            }
            Tools::runSetter($result, $key, $value);
        }
    }
}