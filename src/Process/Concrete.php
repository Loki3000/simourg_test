<?php

declare(strict_types=1);

namespace Process;

class Concrete extends Common
{

    //по заданию это не нужно, но пусть эта конкретная реализация процесса
    //будет уметь удалять добавленные поля 
    public function deleteField(string $name):void
    {
        if (isset($this->fields[md5($name)])) {
            unset($this->fields[md5($name)]);
        }
    }

    public function resetFields():void
    {
        $this->fields = [];
    }

    public function showFields():void
    {
        echo "<pre>";
        foreach ($this->fields as $field) {
            echo '<p>'.$field.'</p>';
        }
        echo "</pre>";
    }
}
