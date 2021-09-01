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
use EndorphinStudio\Detector\Storage\YamlStorage;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Detector
 * Detect OS, Device, Browser, Robot
 * @package EndorphinStudio\Detector
 */
class Detector
{
    private const DATA_PACKAGE = 'endorphin-studio/browser-detector-data-yaml';

    /**
     * @var array Array of options
     */
    protected $options = [
        'dataProvider' => YamlStorage::class,
        'dataDirectory' => 'auto',
        'cacheDirectory' => 'auto',
        'format' => 'yaml'
    ];

    private $version = '6.0.3';

    /**
     * @var StorageInterface
     */
    private $dataProvider;

    /**
     * @var Result Result object
     */
    private $resultObject;

    /**
     * @var string $ua User Agent
     */
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
     * @throws StorageException
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge_recursive($options, $this->options);

        $this->init();
        $this->detectors = [];
        Tools::setWindowsConfig($this->dataProvider->getConfig()['windows']);
        foreach (['os', 'device', 'browser'] as $detectionType) {
            $this->initDetector($detectionType);
        }
    }

    /**
     * Initialisation method
     * @throws StorageException
     * @throws RuntimeException
     */
    protected function init(): void
    {
        $this->setDataProvider($this->createDataProvider());
        $this->dataProvider->setDataDirectory($this->findDataDirectory());
        $this->callMethod($this->dataProvider, 'setCacheDirectory', $this->findCacheDirectory());
        $this->callMethod($this->dataProvider, 'setCacheEnabled', true);
    }

    private function createDataProvider()
    {
        if (class_exists($this->options['dataProvider'])) {
            return new $this->options['dataProvider']();
        }
        throw new RuntimeException('Data Provider class isn\'t exist');
    }

    /**
     * @return string
     * @throws StorageException
     */
    private function findDataDirectory(): string
    {
        $dataDirectory = $this->options['dataDirectory'];
        if ($this->options['dataDirectory'] === 'auto') {
            $dataDirectory = sprintf('%s/data', $this->getPackagePath(self::DATA_PACKAGE));
        }
        if (is_dir($dataDirectory)) {
            return $dataDirectory;
        }
        throw new StorageException(sprintf(StorageException::DIRECTORY_NOT_FOUND, $dataDirectory));
    }

    private function getPackagePath(string $package): string
    {
        $vendorDir = dirname(__FILE__, 3);
        return sprintf('%s/%s', $vendorDir, $package);
    }

    protected function callMethod($object, string $methodName, ...$arguments): void
    {
        if (method_exists($object, $methodName)) {
            $object->$methodName($arguments);
        }
    }

    /**
     * @return string
     * @throws StorageException
     */
    private function findCacheDirectory(): string
    {
        $cacheDirectory = $this->options['cacheDirectory'];
        if ($this->options['cacheDirectory'] === 'auto') {
            $cacheDirectory = sprintf('%s/var/cache', dirname(__FILE__, 1));
        }
        if (is_dir($cacheDirectory)) {
            return $cacheDirectory;
        }
        throw new StorageException(sprintf(StorageException::DIRECTORY_NOT_FOUND, $cacheDirectory));
    }

    private function initDetector(string $type): void
    {
        $className = sprintf('\\EndorphinStudio\\Detector\\Detection\\%s', ucfirst(sprintf('%sDetector', $type)));
        if (class_exists($className)) {
            $this->detectors[$type] = new $className();
            $this->detectors[$type]->init($this);
        }
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Get storage provider
     * @return StorageInterface
     */
    public function getDataProvider(): StorageInterface
    {
        return $this->dataProvider;
    }

    /**
     * Set data provider
     * @param StorageInterface $dataProvider
     */
    public function setDataProvider(StorageInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
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
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->ua;
    }

    /**
     * Analyse User Agent String
     * @param string $ua
     * @return Result
     * @SuppressWarnings(PHPMD.StaticAccess)
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
    public function getPatternList($list, $type): array
    {
        return array_key_exists($type, $list) ? $list[$type] : [];
    }
}
