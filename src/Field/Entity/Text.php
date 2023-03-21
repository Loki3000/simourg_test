<?php

declare(strict_types=1);

namespace Field\Entity;

class Text extends Common
{
    protected function setValue($value):void
    {
        if (is_string($value)) {
            $this->value = $value;
            return;
        }
        throw new \InvalidArgumentException('Ожидается строка');
    }

    protected function getDefaultValue(): string
    {
        return '';
    }
}
