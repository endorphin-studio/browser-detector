<?php


namespace EndorphinStudio\Detector\Detection;


use EndorphinStudio\Detector\Data\AbstractData;
use EndorphinStudio\Detector\Detector;
use EndorphinStudio\Detector\Tools;

abstract class AbstractDetection implements DetectionInterface
{
    /** @var array */
    protected $config;
    /** @var Detector */
    protected $detector;

    /** @var AbstractData */
    protected $resultObject;

    public function init(Detector $detector)
    {
        $this->detector = $detector;
        echo static::class.PHP_EOL;
    }

    protected function initResultObject()
    {
        // init default value from data
        foreach ($this->config['default'] as $defaultKey => $defaultValue) {
            Tools::runSetter($this->resultObject, $defaultKey, $defaultValue);
        }
    }

    public abstract function detect(string $ua);

    protected function detectByPattern(array $patternList)
    {
        foreach ($patternList as $patternId => $patternData) {
            $useDefault = false;
            $pattern = '/%s/';
            $version = '%s';
            if (array_key_exists('default', $patternData) && $patternData['default'] === true) {
                $useDefault = true;
                $pattern = sprintf($pattern, $patternId);
                $version = sprintf($version, $patternId);
            }

            if (!$useDefault) {
                $pattern = sprintf($pattern, $patternData['pattern']);
                if (array_key_exists('version', $patternData)) {
                    $version = sprintf($version, $patternData['version']);
                }
            }

            if (preg_match($pattern, $this->detector->getUserAgent())) {
                $version = Tools::getVersion($version, $this->detector->getUserAgent());
                return ['name' => $patternId, 'version' => $version, 'originalInfo' => $patternData];
            }
        }
        return null;
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

    protected function detectByType(): array
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