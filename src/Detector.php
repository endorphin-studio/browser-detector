<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector;

use EndorphinStudio\Detector\Data\AbstractData;
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
    private $version = '5.0.0';

    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @var array Array of options
     */
    protected $options = [
        'dataProvider' => '\\EndorphinStudio\\Detector\\Storage\\YamlStorage',
        'dataDirectory' => 'auto',
        'cacheDirectory' => 'auto',
        'format' => 'yaml'
    ];

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
     * Options:
     * 'dataProvider' => '\\EndorphinStudio\\Detector\\Storage\\YamlStorage',
     * 'dataDirectory' => 'auto',
     * 'cacheDirectory' => 'auto',
     * 'format' => 'yaml'
     * @param array $options Array of options
     * @throws \ReflectionException
     * @throws StorageException
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge_recursive($options, $this->options);

        $this->init();
        $this->detectors = [];
        $check = ['os','device', 'browser', 'robot'];
        Tools::setWindowsConfig($this->dataProvider->getConfig()['windows']);
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
    public function analyse(string $ua = 'ua'): Result
    {
        $request = Request::createFromGlobals();
        $this->ua = $ua === 'ua' ? $request->server->get('HTTP_USER_AGENT') : $ua;
        $this->resultObject = new Result($this->ua, $this);
        foreach ($this->detectors as $detectionType => $detector) {
            $detector->detect();
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

    /**
     * Initialisation method
     * @throws \ReflectionException
     * @throws StorageException
     */
    protected function init()
    {
        $dataProvider = new $this->options['dataProvider']();

        /** @var StorageInterface $dataProvider */
        $this->setDataProvider($dataProvider);
        $this->dataProvider->setDataDirectory($this->findDataDirectory());
        if(method_exists($this->dataProvider,'setCacheDirectory')) {
            $this->dataProvider->setCacheDirectory($this->findCacheDirectory());
        }
        if(method_exists($this->dataProvider,'setCacheEnabled')) {
            $this->dataProvider->setCacheEnabled(true);
        }
    }

    /**
     * @return string
     * @throws StorageException
     * @throws \ReflectionException
     */
    private function findDataDirectory(): string
    {
        $dataDirectory = $this->options['dataDirectory'];
        if($this->options['dataDirectory'] === 'auto') {
            $reflection = new \ReflectionClass(AbstractData::class);
            $dataDirectory = sprintf('%s/var/%s', dirname($reflection->getFileName(),3), $this->options['format']);
        }
        if(is_dir($dataDirectory)){
            return $dataDirectory;
        }
        throw new StorageException(sprintf(StorageException::DIRECTORY_NOT_FOUND, $dataDirectory));
    }

    /**
     * @return string
     * @throws StorageException
     * @throws \ReflectionException
     */
    private function findCacheDirectory(): string
    {
        $cacheDirectory = $this->options['cacheDirectory'];
        if($this->options['cacheDirectory'] === 'auto') {
            $reflection = new \ReflectionClass(AbstractData::class);
            $cacheDirectory = sprintf('%s/var/cache', dirname($reflection->getFileName(),3));
        }
        if(is_dir($cacheDirectory)){
            return $cacheDirectory;
        }
        throw new StorageException(sprintf(StorageException::DIRECTORY_NOT_FOUND, $cacheDirectory));
    }
}