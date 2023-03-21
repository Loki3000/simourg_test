<?php
namespace Field\Entity;

use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function testDefaultValue()
    {
        $entity=new Text(['name'=>'name', 'type'=>'text']);
        $this->assertEquals('', $entity->__toString());
    }

    public function testValue()
    {
        $entity=new Text(['name'=>'name', 'type'=>'text', 'value'=>'newValue']);
        $this->assertEquals('newValue', $entity->__toString());
    }

    public function testWrongValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Text(['name'=>'name', 'type'=>'text', 'value'=>[]]);
    }

    public function testName()
    {
        $entity=new Text(['name'=>'name', 'type'=>'text']);
        $this->assertEquals('name', $entity->getName());

        $this->expectException(\InvalidArgumentException::class);
        $entity=new Text(['name'=>'', 'type'=>'text']);
    }

    public function testWrongParameterType()
    {
        $this->expectException(\TypeError::class);
        $entity=new Text('string');
    }
}
