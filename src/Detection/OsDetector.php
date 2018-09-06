<?php


namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

class OsDetector extends AbstractDetection
{
    protected $configKey = 'os';

    protected function setupResultObject()
    {
        $osData = $this->detectByKey('family');
        foreach ($osData as $key => $value) {
            if ($key === 'originalInfo') {
                $this->setAttributes($value);
                continue;
            }
            Tools::runSetter($this->resultObject, $key, $value);
        }
    }
}