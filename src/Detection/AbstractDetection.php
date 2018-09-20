<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Data\AbstractData;
use EndorphinStudio\Detector\Detector;
use EndorphinStudio\Detector\Tools;

/**
 * Class AbstractDetection
 * Abstract detector class
 * @package EndorphinStudio\Detector\Detection
 */
abstract class AbstractDetection implements DetectionInterface
{
    /**
     * @var array Additional Info
     */
    protected $additionalInfo = [];
    /**
     * @var string Key in config (os, device, etc.)
     */
    protected $configKey = 'none';

    /** @var array Data for detection (patterns, etc.) */
    protected $config;
    /** @var Detector Detector class */
    protected $detector;

    /** @var AbstractData Result object */
    protected $resultObject;

    /**
     * @param Detector $detector Init detection class with detector
     */
    public function init(Detector $detector)
    {
        $this->detector = $detector;
    }

    /**
     * Result object initialisation
     * @return null
     */
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

    /**
     * Detect method
     * @param array $additional Additional info
     */
    public function detect(array $additional = [])
    {
        if ($this->configKey !== 'none') {
            $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), $this->configKey);
            $resultObject = $this->detector->getResultObject();
            $this->resultObject = Tools::runGetter($resultObject, $this->configKey);
        }
        $this->initResultObject();
        $this->setupResultObject();
        $this->afterDetection();
    }

    /**
     * Setup Result Object
     * @return void
     */
    protected abstract function setupResultObject();

    /**
     * Detect by pattern
     * @param array $patternList list of patterns
     * @return array|null
     */
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

    /**
     * Get pattern form array
     * @param string $patternId ID in config
     * @param array $patternData array from yaml file
     * @return array
     */
    private function getPattern(string $patternId, array $patternData): array
    {
        if (array_key_exists('default', $patternData) && $patternData['default'] === true) {
            return ['pattern' => sprintf('/%s/', $patternId), 'version' => $patternId];
        }
        return ['pattern' => sprintf('/%s/', $patternData['pattern']), 'version' => array_key_exists('version', $patternData) ? $patternData['version'] : $patternId];
    }

    /**
     * Set attributes of result object
     * @param array $info Array
     */
    protected function setAttributes(array $info)
    {
        $result = $this->detector->getResultObject();
        if (array_key_exists('attributes', $info)) {
            foreach ($info['attributes'] as $attributeKey => $attributeValue) {
                Tools::runSetter($result, $attributeKey, $attributeValue);
            }
        }
    }

    /**
     * Detect by type
     * @param string $key
     * @return array
     */
    protected function detectByType($key = 'none'): array
    {
        $container = $key === 'none' ? $this->config : $this->config[$key];
        foreach ($container as $type => $patternList) {
            if ($type === 'default') {
                continue;
            }
            $browser = $this->detectByPattern($patternList);
            if (!empty($browser)) {
                return array_merge($browser, ['type' => $type]);
            }
        }
        return [];
    }

    /**
     * Detect by Key
     * @param string $keyName
     * @return array
     */
    protected function detectByKey($keyName = 'family'): array
    {
        foreach ($this->config as $key => $data) {
            if ($key === 'default') {
                continue;
            }
            $detectedData = $this->detectByType($key);
            if (!empty($detectedData)) {
                return array_merge($detectedData, [$keyName => $key]);
            }
        }
        return [];
    }

    protected function afterDetection() {
        /** Not required implementation */
    }
}