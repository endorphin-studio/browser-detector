<?php


namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

class OsDetector extends AbstractDetection
{
    public function detect(string $ua)
    {
        $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), 'os');
        $this->resultObject = $this->detector->getResultObject()->getOs();
        $this->initResultObject();
        $this->setupResultObject();
    }

    protected function setupResultObject()
    {
        $osData = $this->detectByFamily();
        foreach ($osData as $key => $value) {
            if ($key === 'originalInfo') {
                $this->setAttributes($value);
                continue;
            }
            Tools::runSetter($this->resultObject, $key, $value);
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