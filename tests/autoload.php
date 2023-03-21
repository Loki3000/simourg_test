<?php

spl_autoload_register('autoloader');

function autoloader($class)
{
    $path=explode('\\', $class);
    $path=dirname(__FILE__).'/../src/'.implode(DIRECTORY_SEPARATOR, $path).'.php';
    if (is_readable($path)) {
        include_once $path;
    }
}
