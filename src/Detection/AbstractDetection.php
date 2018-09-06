<?php

namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Data\AbstractData;
use EndorphinStudio\Detector\Detector;
use EndorphinStudio\Detector\Tools;

abstract class AbstractDetection implements DetectionInterface
{
    /**
     * @var string Key in config (os, device, etc.)
     */
    protected $configKey = 'none';

    /** @var array */
    protected $config;
    /** @var Detector */
    protected $detector;

    /** @var AbstractData */
    protected $resultObject;

    public function init(Detector $detector)
    {
        $this->detector = $detector;
    }

    protected function initResultObject()
    {
        if(!array_key_exists('default', $this->config)) {
            return null;
        }
        // init default value from data
        foreach ($this->config['default'] as $defaultKey => $defaultValue) {
            Tools::runSetter($this->resultObject, $defaultKey, $defaultValue);
        }
    }

    public function detect(string $ua)
    {
        if ($this->configKey !== 'none') {
            $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), $this->configKey);
            $resultObject = $this->detector->getResultObject();
            $this->resultObject = Tools::runGetter($resultObject, $this->configKey);
        }
        $this->initResultObject();
        $this->setupResultObject();
    }

    protected abstract function setupResultObject();

    protected function detectByPattern(array $patternList)
    {
        foreach ($patternList as $patternId => $patternData) {
            $pattern = $this->getPattern($patternId, $patternData);

            if (preg_match($pattern['pattern'], $this->detector->getUserAgent())) {
                return ['name' => $patternId, 'version' => Tools::getVersion($pattern['version'], $this->detector->getUserAgent()), 'originalInfo' => $patternData];
            }
        }
        return null;
    }

    private function getPattern(string $patternId, array $patternData): array
    {
        if (array_key_exists('default', $patternData) && $patternData['default'] === true) {
            return ['pattern' => sprintf('/%s/', $patternId), 'version' => $patternId];
        }
        return ['pattern' => sprintf('/%s/', $patternData['pattern']), 'version' => array_key_exists('version', $patternData) ? $patternData['version'] : $patternId];
    }

    protected function setAttributes($info)
    {
        $result = $this->detector->getResultObject();
        if (array_key_exists('attributes', $info)) {
            foreach ($info['attributes'] as $attributeKey => $attributeValue) {
                Tools::runSetter($result, $attributeKey, $attributeValue);
            }
        }
    }

    protected function detectByType($key = 'none'): array
    {
        $container = $key === 'none' ? $this->config : $this->config[$key];
        foreach ($container as $type => $patternList) {
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

    protected function detectByKey($keyName = 'family'): array
    {
        foreach ($this->config as $key => $data) {
            if ($key === 'default') {
                continue;
            }
            $detectedData = $this->detectByType($key);
            if ($detectedData) {
                return array_merge($detectedData, [$keyName => $key]);
            }
        }
        return [];
    }
}