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
use EndorphinStudio\Detector\Storage\StorageInterface;
use Symfony\Component\HttpFoundation\Request;

class Detector
{
    /**
     * @var StorageInterface
     */
    private $dataProvider;

    /**
     * @return StorageInterface
     */
    public function getDataProvider(): StorageInterface
    {
        return $this->dataProvider;
    }

    /**
     * @return Result
     */
    public function getResultObject(): Result
    {
        return $this->resultObject;
    }

    /**
     * @var Result
     */
    private $resultObject;

    /**
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
     * @throws StorageException
     */
    public function __construct(string $dataProvider = '\\EndorphinStudio\\Detector\\Storage\\YamlStorage', string $format = 'yaml')
    {
        $dataDirectory = sprintf('%s/var/%s', dirname(__DIR__), $format);
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

    public function getPatternList($list, $type)
    {
        return array_key_exists($type, $list) ? $list[$type] : [];
    }
}