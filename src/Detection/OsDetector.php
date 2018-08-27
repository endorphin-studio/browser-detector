<?php


namespace EndorphinStudio\Detector\Detection;


use EndorphinStudio\Detector\Data\AbstractData;
use EndorphinStudio\Detector\Data\Os;
use EndorphinStudio\Detector\Tools;

class OsDetector extends AbstractDetection
{
    public function detect(string $ua)
    {
        $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), 'os');
        $result = $this->detector->getResultObject()->getOs();

        // init default value from data
        foreach ($this->config['default'] as $defaultKey => $defaultValue) {
            $methodName = sprintf('set%s', ucfirst($defaultKey));
            if (!method_exists($result, $methodName)) {
                continue;
            }
            $result->$methodName($defaultValue);
        }
        $this->detectByFamily();
    }

    private function detectByFamily(): array
    {
        $result = [];
        foreach ($this->config as $family => $data) {
            if($family === 'default') {
                continue;
            }
            $this->detectByDeviceType($family);
        }
        return $result;
    }

    private function detectByDeviceType($family): array
    {
        $result = [];
        foreach ($this->config[$family] as $deviceType => $patternList) {
            $this->detectByPattern($patternList);
        }
        return $result;
    }

    private function detectByPattern(array $deviceList)
    {
        $result = null;
        foreach ($deviceList as $patternId => $patternData) {
            $useDefault = false;
            $pattern = '/%s/';
            $version = '%s';
            if(array_key_exists('default', $patternData) && $patternData['default'] === true) {
                $useDefault = true;
                $pattern = sprintf($pattern, $patternId);
                $version = Tools::getVersionPattern(sprintf($version, $patternId));
            }

            if(!$useDefault) {
                $pattern = sprintf($pattern, $patternData['pattern']);
                $version = Tools::getVersionPattern(sprintf($version, $patternData['version']));
            }

            if(preg_match($pattern, $this->detector->getUserAgent())) {
                echo 'BINGO';
            }
        }
        return $result;
    }

}