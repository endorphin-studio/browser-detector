<?php

namespace EndorphinStudio\Detector\Data;

class Os extends AbstractDataWithVersion
{
    /**
     * @return string
     */
    public function getFamily(): string
    {
        return $this->family;
    }

    /**
     * @param string $family
     */
    public function setFamily(string $family)
    {
        $this->family = $family;
    }

    /** @var string */
    protected $family;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @var string
     */
    protected $type;
}