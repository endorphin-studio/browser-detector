<?php


namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

class DeviceDetector extends AbstractDetection
{
    public function detect(string $ua)
    {
        $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), 'device');
        $this->resultObject = $this->detector->getResultObject()->getDevice();
        $this->initResultObject();
        $this->setupResultObject();
    }


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
    }
}