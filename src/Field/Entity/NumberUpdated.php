<?php

declare(strict_types=1);

namespace Field\Entity;

class NumberUpdated extends Number
{
    public function __toString(): string
    {
        return 'Это класс с переопределенным поведением: '.sprintf($this->format, $this->value);
    }
}