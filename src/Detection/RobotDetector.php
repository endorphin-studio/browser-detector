<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Tools;

/**
 * Detector for robot
 * Class RobotDetector
 * @package EndorphinStudio\Detector\Detection
 */
class RobotDetector extends AbstractDetection
{
    /**
     * @var string Key in array
     */
    protected $configKey = 'robot';

    /** @var array List of objects */
    private $homepages;

    /**
     * Setup result object
     */
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
        $this->additionalInfo = $object;
    }

    /**
     * @return array List with result
     */
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

    /**
     * Detect by type
     * @param string $key
     * @return array
     */
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

    /**
     * Detect by pattern
     * @param array $patternList
     * @return array|null
     */
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

    /**
     * Get regex pattern
     * @param string $pattern
     * @return string
     */
    private function getPattern(string $pattern): string
    {
        return sprintf('/%s/', $pattern);
    }
}