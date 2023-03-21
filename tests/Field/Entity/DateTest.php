<?php
namespace Field\Entity;

use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testDefaultValue()
    {
        $entity=new Date(['name'=>'name', 'type'=>'date']);
        $this->assertEquals(date('d.m.Y'), $entity->__toString());
    }

    public function testValue()
    {
        $entity=new Date(['name'=>'name', 'type'=>'date', 'value'=>'11.10.2005']);
        $this->assertEquals('11.10.2005', $entity->__toString());
    }

    public function testNotADateValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Date(['name'=>'name', 'type'=>'date', 'value'=>'NotADate']);
    }

    public function testWrongDateFormatValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $entity=new Date(['name'=>'name', 'type'=>'date', 'value'=>'99.00.1000']);

        $this->expectException(\InvalidArgumentException::class);
        $entity=new Date(['name'=>'name', 'type'=>'date', 'value'=>'30.02.2023']);
    }
}