<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector;

use EndorphinStudio\Detector\Data\Result;
use EndorphinStudio\Detector\Exception\StorageException;
use EndorphinStudio\Detector\Storage\AbstractStorage;
use EndorphinStudio\Detector\Storage\StorageInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Detector
 * Detect OS, Device, Browser, Robot
 * @package EndorphinStudio\Detector
 */
class Detector
{
    /**
     * @var StorageInterface
     */
    private $dataProvider;

    /**
     * Get storage provider
     * @return StorageInterface
     */
    public function getDataProvider(): StorageInterface
    {
        return $this->dataProvider;
    }

    /**
     * Get result object
     * @return Result Result object
     */
    public function getResultObject(): Result
    {
        return $this->resultObject;
    }

    /**
     * @var Result Result object
     */
    private $resultObject;

    /**
     * Set data provider
     * @param StorageInterface $dataProvider
     */
    public function setDataProvider(StorageInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->ua;
    }

    private $ua;

    /**
     * @var array
     */
    private $detectors;

    /**
     * Detector constructor.
     * @param string $dataProvider
     * @param string $format
     */
    public function __construct(string $dataProvider = '\\EndorphinStudio\\Detector\\Storage\\YamlStorage', string $format = 'yaml')
    {
        $dataDirectory = sprintf('%s/var/%s', dirname(__DIR__), $format);
        /** @var StorageInterface $dataProvider */
        $dataProvider = new $dataProvider();
        $dataProvider->setDataDirectory($dataDirectory);
        $this->setDataProvider($dataProvider);
        $this->detectors = [];
        $this->resultObject = new Result();
        $check = ['os','device', 'browser', 'robot'];
        Tools::setWindowsConfig($dataProvider->getConfig()['windows']);
        foreach ($check as $detectionType) {
            $className = sprintf('\\EndorphinStudio\\Detector\\Detection\\%s', ucfirst(sprintf('%sDetector', $detectionType)));
            if(class_exists($className)) {
                $this->detectors[$detectionType] = new $className();
                $this->detectors[$detectionType]->init($this);
            }
        }
    }

    /**
     * Analyse User Agent String
     * @param string $ua
     * @return Result
     */
    public function analyze(string $ua = 'ua'): Result
    {
        $request = Request::createFromGlobals();
        $this->ua = $ua === 'ua' ? $request->server->get('HTTP_USER_AGENT') : $ua;
        $this->resultObject = new Result();
        foreach ($this->detectors as $detectionType => $detector) {
            $detector->detect($ua);
        }
        return $this->resultObject;
    }

    /**
     * Get list of patterns from config
     * @param $list
     * @param $type
     * @return array
     */
    public function getPatternList($list, $type)
    {
        return array_key_exists($type, $list) ? $list[$type] : [];
    }
}