<?php

declare(strict_types=1);

namespace Interfaces;

interface Factory
{
    public function create(array $data):\Interfaces\Field;
}
