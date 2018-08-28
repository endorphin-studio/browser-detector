<?php


namespace EndorphinStudio\Detector\Detection;


use EndorphinStudio\Detector\Tools;

class BrowserDetector extends AbstractDetection
{
    public function detect(string $ua)
    {
        $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), 'browser');
        $this->initResultObject();
        $this->setupResultObject();
    }


    private function initResultObject()
    {
        $result = $this->detector->getResultObject()->getBrowser();

        // init default value from data
        foreach ($this->config['default'] as $defaultKey => $defaultValue) {
            Tools::runSetter($result, $defaultKey, $defaultValue);
        }
    }

    private function setupResultObject()
    {
        $result = $this->detector->getResultObject()->getBrowser();
        $browserData = $this->detectByType();
        foreach ($browserData as $key => $value) {
            if ($key === 'originalInfo') {
                $this->setAttributes($value);
                continue;
            }
            Tools::runSetter($result, $key, $value);
        }
    }

    private function detectByType(): array
    {
        foreach ($this->config as $type => $patternList) {
            if ($type === 'default') {
                continue;
            }
            $browser = $this->detectByPattern($patternList);
            if ($browser) {
                return array_merge($browser, ['type' => $type]);
            }
        }
        return [];
    }
}