<?php

namespace Process;

use Field\Entity\Number;
use Field\Factory;
use PHPUnit\Framework\TestCase;

class ConcreteTest extends TestCase
{
    private $process = null;

    protected function setUp(): void
    {
        $factoryMock = $this->createMock(Factory::class);
        $dummyClass = $this->createMock(\Interfaces\Field::class);
        $dummyClass->method('getName')->will($this->onConsecutiveCalls('name1', 'name with space', 'name2', 'name2'));

        $factoryMock->method('create')->will($this->returnValue($dummyClass));
        $this->process = new Concrete($factoryMock);
    }


    public function testAddField()
    {
        $this->process->addField(['name'=>'name']);
        $this->assertEquals(1, count($this->getProperty($this->process, 'fields')));
    }
    
    public function testAddFields()
    {
        $this->process->addFields([['name'=>'name'],['name'=>'name'],['name'=>'name']]);
        $this->assertEquals(3, count($this->getProperty($this->process, 'fields')));
    }
    
    public function testUniquieNames()
    {
        $this->process->addFields([['name'=>'name'],['name'=>'name'],['name'=>'name'],['name'=>'name']]);
        $this->assertEquals(3, count($this->getProperty($this->process, 'fields')));
    }

    public function testDeleteField()
    {
        $this->process->addFields([['name'=>'name'],['name'=>'name'],['name'=>'name']]);
        $this->process->deleteField('name1');
        $this->assertEquals(2, count($this->getProperty($this->process, 'fields')));
    }

    public function testResetFields()
    {
        $this->process->addFields([['name'=>'name'],['name'=>'name'],['name'=>'name']]);
        $this->process->resetFields();
        $this->assertEquals(0, count($this->getProperty($this->process, 'fields')));
    }

    private function getProperty($object, $property)
    {
        $reflectedClass = new \ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);
        return $reflection->getValue($object);
    }
}
