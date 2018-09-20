<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.0
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Detection;

use EndorphinStudio\Detector\Detector;

/**
 * Interface of abstract detection
 * Interface DetectionInterface
 * @package EndorphinStudio\Detector\Detection
 */
interface DetectionInterface
{
    /**
     * Init method
     * @param Detector $detector
     * @return mixed
     */
    public function init(Detector $detector);

    /**
     * Detect method
     * @param array $additional
     * @return mixed
     */
    public function detect(array $additional);
}