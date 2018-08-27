<?php


namespace EndorphinStudio\Detector\Detection;


use EndorphinStudio\Detector\Detector;

abstract class AbstractDetection implements DetectionInterface
{
    /** @var array */
    protected $config;
    /** @var Detector */
    protected $detector;

    public function init(Detector $detector)
    {
        $this->detector = $detector;
        echo static::class.PHP_EOL;
    }

    public abstract function detect(string $ua);
}