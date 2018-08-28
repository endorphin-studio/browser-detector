<?php


namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

class OsDetector extends AbstractDetection
{
    public function detect(string $ua)
    {
        $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), 'os');
        $this->initResultObject();
        $this->setupResultObject();
    }

    private function initResultObject()
    {
        $result = $this->detector->getResultObject()->getOs();

        // init default value from data
        foreach ($this->config['default'] as $defaultKey => $defaultValue) {
            Tools::runSetter($result, $defaultKey, $defaultValue);
        }
    }

    private function setupResultObject()
    {
        $result = $this->detector->getResultObject()->getOs();
        $osData = $this->detectByFamily();
        foreach ($osData as $key => $value) {
            if ($key === 'originalInfo') {
                $this->setAttributes($value);
                continue;
            }
            Tools::runSetter($result, $key, $value);
        }
    }

    private function detectByFamily(): array
    {
        foreach ($this->config as $family => $data) {
            if ($family === 'default') {
                continue;
            }
            $os = $this->detectByDeviceType($family);
            if ($os) {
                return array_merge($os, ['family' => $family]);
            }
        }
        return [];
    }

    private function detectByDeviceType($family): array
    {
        foreach ($this->config[$family] as $deviceType => $patternList) {
            $os = $this->detectByPattern($patternList);
            if ($os) {
                return array_merge($os, ['type' => $deviceType]);
            }
        }
        return [];
    }

}