<?php

declare(strict_types=1);

namespace Field;

class Factory implements \Interfaces\Factory
{
    private $rules = [];

    public function create(array $data):\Interfaces\Field
    {
        if (empty($data['type'])) {
            throw new \InvalidArgumentException('Тип поля не определен');
        }
        $classname = $this->getClassName($data['type']);
        $classname = (array_key_exists($classname, $this->rules)) ? $this->rules[$classname] : $classname;

        if (!class_exists($classname)) {
            throw new \InvalidArgumentException('Тип поля не найден: ' . $data['type']);
        }

        return new $classname($data);
    }

    public function addRule(string $source, string $dest):void
    {
        //на проде такая проверка будет лишней, но при разработке так безопаснее
        if (class_exists($source)) {
            $this->rules[$source] = $dest;
            return;
        }
        throw new \InvalidArgumentException('Класс не найден: ' . $dest);
    }

    public function deleteRule(string $source):void
    {
        if (array_key_exists($source, $this->rules)) {
            unset($this->rules[$source]);
        }
    }

    private function getClassName(string $type):string
    {
        return __NAMESPACE__.'\\Entity\\'.ucfirst(strtolower($type));
    }
}
