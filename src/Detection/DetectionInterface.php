<?php


namespace EndorphinStudio\Detector\Detection;


use EndorphinStudio\Detector\Detector;

interface DetectionInterface
{
    public function init(Detector $detector);
    public function detect(string $ua);
}