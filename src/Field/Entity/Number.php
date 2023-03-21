<?php

declare(strict_types=1);

namespace Field\Entity;

class Number extends Common
{
    protected $format='%s';

    public function __construct(array $data)
    {
        parent::__construct($data);
        if (isset($data['format'])) {
            $this->format = $data['format'];
        }
    }

    public function __toString(): string
    {
        return sprintf($this->format, $this->value);
    }

    protected function setValue($value):void
    {
        if (is_numeric($value)) {
            $this->value = $value;
            return;
        }
        throw new \InvalidArgumentException('Ожидается число');
    }

    protected function getDefaultValue()
    {
        return 0;
    }
}
