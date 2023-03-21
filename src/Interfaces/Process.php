<?php

declare(strict_types=1);

namespace Interfaces;

interface Process
{
    public function __construct(\Interfaces\Factory $factory);
    public function addField(array $data):void;
    public function addFields(array $data):void;
}
