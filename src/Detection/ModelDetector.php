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
        if(!\array_key_exists($name, $this->config)) {
            return;
        }
        $patternList = $this->config[$name];
        foreach ($patternList as $series => $pattern) {
            $pattern = sprintf('/%s/', $pattern);
            $result = \preg_match($pattern, $this->detector->getUserAgent(), $model);
            if($result) {
                $this->resultObject->setModel(sprintf('%s%s', $series, $model[1]));
                $this->resultObject->setSeries($series);
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
        if($this->resultObject->getModel()) {
            $this->detector->getResultObject()->getDevice()->setModel($this->resultObject);
            $this->detector->getResultObject()->getDevice()->setHasModel(true);
        }
    }
}