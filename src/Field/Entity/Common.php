<?php

declare(strict_types=1);

namespace Field\Entity;

abstract class Common implements \Interfaces\Field
{
    protected $name;
    protected $type;
    protected $value;

    public function __construct(array $data)
    {
        if (empty($data['name'])) {
            throw new \InvalidArgumentException('Имя поля не определено');
        }
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->setValue(isset($data['value']) ? $data['value'] : $this->getDefaultValue());
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    protected abstract function setValue($value):void;
    protected abstract function getDefaultValue();
}
