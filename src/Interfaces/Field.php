<?php

declare(strict_types=1);

namespace Interfaces;

interface Field
{
    public function __construct(array $data);
    public function getName(): string;
    public function __toString(): string;
}
