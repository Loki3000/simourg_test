<?php
namespace Field\Entity;

use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function testDefaultValue()
    {
        $entity=new Number(['name'=>'name', 'type'=>'number']);
        $this->assertEquals('0', $entity->__toString());
    }

    public function testFormat()
    {
        $entity=new Number(['name'=>'name', 'type'=>'number', 'value'=>40000, 'format'=>'%d обезьян...']);
        $this->assertEquals('40000 обезьян...', $entity->__toString());
    }

    public function testWrongValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $entity=new Number(['name'=>'name', 'type'=>'number', 'value'=>'NaN']);
    }
}