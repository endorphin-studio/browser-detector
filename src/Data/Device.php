<?php
/**
 * @author Serhii Nekhaienko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Serhii Nekhaienko &copy 2018
 * @version 4.0.2
 * @project endorphin-studio/browser-detector
 */

namespace EndorphinStudio\Detector\Data;

/**
 * Class Device
 * Result of device detection
 * @package EndorphinStudio\Detector\Data
 */
class Device extends AbstractDataWithVersion
{
    /**
     * @return Model|null
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model|null $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return bool
     */
    public function isHasModel(): bool
    {
        return $this->hasModel;
    }

    /**
     * @param bool $hasModel
     */
    public function setHasModel(bool $hasModel)
    {
        $this->hasModel = $hasModel;
    }

    /**
     * @var Model | null
     */
    private $model = null;

    /**
     * @var bool
     */
    private $hasModel = false;


    public function jsonSerialize()
    {
        $fields = get_object_vars($this);
        unset($fields['result']);
        return $fields;
    }
}