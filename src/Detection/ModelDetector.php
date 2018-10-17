<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.2
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Data\Model;

class ModelDetector extends AbstractDetection
{
    /**
     * @var string Key in config (os, device, etc.)
     */
    protected $configKey = 'model';

    /**
     * Setup result of object
     */
    protected function setupResultObject()
    {
        $name = $this->additionalInfo['name'];
        if (!\array_key_exists($name, $this->config)) {
            return;
        }
        $patternList = $this->config[$name];
        foreach ($patternList as $series => $data) {
            if(array_key_exists('pattern', $data)) {
                $this->detectModelByPattern($series,$data['pattern']);
            } elseif (array_key_exists('models', $data)) {
                $this->detectModelByModelList($series, $data['models']);
            }
        }
    }

    private function detectModelByPattern(string $series, string $pattern)
    {
        $pattern = sprintf('/%s/', $pattern);
        $result = \preg_match($pattern, $this->detector->getUserAgent(), $model);
        if ($result) {
            $model = count($model) > 1 ? sprintf('%s%s', $series, end($model)) : $series;
            $this->resultObject->setModel($model);
            $this->resultObject->setSeries($series);
            return $result;
        }
    }

    private function detectModelByModelList(string $series, array $data)
    {
        foreach ($data as $model => $pattern) {
            $pattern = sprintf('/%s/', $pattern);
            $result = \preg_match($pattern, $this->detector->getUserAgent());
            if ($result) {
                $model = sprintf('%s%s', $series, $model);
                $this->resultObject->setModel($model);
                $this->resultObject->setSeries($series);
                return $result;
            }
        }
    }

    /**
     * Detect method
     * @param array $additional Additional Info
     */
    public function detect(array $additional = [])
    {
        $this->additionalInfo = $additional;
        if ($this->configKey !== 'none') {
            $this->config = $this->detector->getPatternList($this->detector->getDataProvider()->getConfig(), $this->configKey);
            $this->resultObject = new Model();
        }
        $this->setupResultObject();
        if ($this->resultObject->getModel()) {
            $this->detector->getResultObject()->getDevice()->setModel($this->resultObject);
            $this->detector->getResultObject()->getDevice()->setHasModel(true);
        }
    }
}