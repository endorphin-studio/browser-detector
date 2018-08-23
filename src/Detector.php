<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;

use EndorphinStudio\Detector\Data\Result;
use EndorphinStudio\Detector\Exception\StorageException;
use EndorphinStudio\Detector\Storage\StorageInterface;
use Twig\Parser;

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

    private $ua;

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
    }

    public function analyze(string $ua = 'ua')
    {
        $this->ua = $ua === 'ua' ? $_SERVER['HTTP_USER_AGENT'] : $ua;
        $config = $this->getDataProvider()->getConfig();
        $check = ['device', 'os', 'browser', 'robots'];
        $this->resultObject = new Result();
        foreach ($check as $type) {
            $this->detect($config, $type);
        }
        var_dump($this->resultObject);
    }

    private function detect($config, $type)
    {

    }

    private function getPatternList($list, $type)
    {
        return array_key_exists($type, $list) ? $list[$type] : [];
    }
}