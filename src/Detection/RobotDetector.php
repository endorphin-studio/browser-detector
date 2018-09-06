<?php

namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

class RobotDetector extends AbstractDetection
{
    protected $configKey = 'robot';

    /** @var array */
    private $homepages;

    protected function setupResultObject()
    {
        $this->homepages = $this->config['homepages'];
        $this->config = $this->config['types'];
        $object = $this->detectByConfig();
        foreach ($object as $key => $value) {
            Tools::runSetter($this->resultObject, $key, $value);
        }
        if (\array_key_exists('name', $object) && $object['name']) {
            $this->detector->getResultObject()->setIsRobot(true);
        }
    }

    protected function detectByConfig(): array
    {
        foreach ($this->config as $type => $companyList) {
            $data = $this->detectByType($type);
            if ($data) {
                return \array_merge($data, ['homepage' => \array_key_exists($data['owner'], $this->homepages) ? $this->homepages[$data['owner']] : null, 'type' => $type]);
            }
        }
        return [];
    }

    protected function detectByType($key = 'none'): array
    {
        foreach ($this->config[$key] as $companyName => $patternList) {
            $data = $this->detectByPattern($patternList);
            if ($data) {
                return \array_merge($data, ['owner' => $companyName]);
            }
        }
        return [];
    }

    protected function detectByPattern(array $patternList)
    {
        foreach ($patternList as $name => $pattern) {
            $pattern = $this->getPattern($pattern);

            if (preg_match($pattern, $this->detector->getUserAgent())) {
                return ['name' => $name];
            }
        }
        return null;
    }

    private function getPattern(string $pattern): string
    {
        return sprintf('/%s/', $pattern);
    }
}