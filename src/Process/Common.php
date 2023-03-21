<?php

declare(strict_types=1);

namespace Process;

abstract class Common implements \Interfaces\Process
{
    protected $factory;
    protected $fields = [];

    public function __construct(\Interfaces\Factory $factory)
    {
        $this->factory = $factory;
    }

    public function addField(array $data):void
    {
        $field = $this->factory->create($data);
        $this->fields[md5($field->getName())]=$field;
    }

    public function addFields(array $data):void
    {
        foreach ($data as $item) {
            $this->addField($item);
        }
    }
}
