<?php

spl_autoload_register('autoloader');

$process=new \Process\Concrete(new \Field\Factory());

$fields = [
    ['name' => 'Text', 'type' => 'text', 'value' => 'Text'],
    ['name' => 'Number', 'type' => 'number', 'value' => 455, 'format' => '%+.2f'],
    ['name' => 'Text2', 'type' => 'text', 'value' => 'Text 2'],
    ['name' => 'Start', 'type' => 'date', 'value' => '12.03.2023'],
    ['name' => 'Start1', 'type' => 'date', 'value' => '12.03.2023', 'format'=> 'Y/m/d' ],
];

$process->addFields($fields);
$process->showFields();

echo "<hr>";

//проветяем уникальность имен. Добавляем поле с уже существующим именем
$field=['name' => 'Start1', 'type' => 'text', 'value' => 'Поле перезаписано'];
$process->addField($field);
$process->showFields();

echo "<hr>";

$factory=new \Field\Factory();
//переопределяем поведение класса Number без внесения в него изменений
$factory->addRule('Field\Entity\Number', 'Field\Entity\NumberUpdated');
$process=new \Process\Concrete($factory);
$process->addFields($fields);
$process->showFields();

//пробуем добавить поле несуществующего типа. Должен выбросить исключение
//$process->addField(['name'=>'name', 'type'=>'nonExists']);

//пробуем не указывать тип поля. Должен выбросить исключение
//$process->addField(['name'=>'name']);

//не передаем обязятельный параметр name. Должен выбросить исключение
//$process->addField(['type'=>'text']);

// передаем некорректную дату. Должен выбросить исключение
//$process->addField(['name'=>'name', 'type'=>'date', 'value'=>'30.02.2023']);

// передаем вместо строки - объект. Должен выбросить исключение
//$process->addField(['name'=>'name', 'type'=>'text', 'value'=>new stdClass()]);

// передаем вместо числа - строку. Должен выбросить исключение
//$process->addField(['name'=>'name', 'type'=>'number', 'value'=>'string']);





function autoloader($class)
{
    $path=explode('\\', $class);
    $path=dirname(__FILE__).'/'.implode(DIRECTORY_SEPARATOR, $path).'.php';
    if (is_readable($path)) {
        include_once $path;
    }
}