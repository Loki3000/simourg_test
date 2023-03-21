<?php
namespace Field\Entity;

use Field\Factory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    private $factory = null;

    protected function setUp() : void
    {
        $this->factory=new Factory();
    }

    public function testCreate()
    {
        $this->assertInstanceOf(Dummy::class, $this->factory->create(['name'=>'name', 'type'=>'dummy']));
        $this->assertInstanceOf(Dummy::class, $this->factory->create(['name'=>'name', 'type'=>'dUmMy']));
    }

    public function testNonExists()
    {
        $this->expectException(\Exception::class);
        $this->factory->create(['name'=>'name', 'type'=>'nonExists']);
    }

    public function testAddRule()
    {
        $this->factory->addRule('Field\Entity\Dummy', 'Field\Entity\Dummy2');
        $this->assertInstanceOf(Dummy2::class, $this->factory->create(['name'=>'name', 'type'=>'dUmMy']));
    }

    public function testAddNoneExistsRule()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->factory->addRule('Field\Entity\Dummy', 'Field\Entity\Dummy3');
        $this->factory->create(['name'=>'name', 'type'=>'dummy']);
    }

    public function testDeleteRule()
    {
        $this->factory->addRule('Field\Entity\Dummy', 'Field\Entity\Dummy2');
        $this->assertInstanceOf(Dummy2::class, $this->factory->create(['name'=>'name', 'type'=>'dUmMy']));
        $this->factory->deleteRule('Field\Entity\Dummy');
        $this->assertInstanceOf(Dummy::class, $this->factory->create(['name'=>'name', 'type'=>'dUmMy']));
    }
}

class Dummy implements \Interfaces\Field {
    public function __construct(array $data){}
    public function getName(): string
    {
        return '';   
    }
    public function __toString(): string
    {
        return '';
    }
}
class Dummy2 extends Dummy{}