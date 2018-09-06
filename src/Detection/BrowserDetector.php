<?php


namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

class BrowserDetector extends AbstractDetection
{
    protected $configKey = 'browser';

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