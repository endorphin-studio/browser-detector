<?php

namespace EndorphinStudio\Detector\Data;

class Browser extends AbstractDataWithVersion
{
    /** @var string */
    protected $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}