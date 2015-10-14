<?php

namespace Jach\Specification;

use \Jach\Specification\SpecificationInterface;
use \Jach\Specification\CompositeSpecification;

class OrSpecificationTest extends \PHPUnit_Framework_TestCase
{
     public function setUp()
    {
        $this->candidate = new \stdClass();
    }

    public function testTrueTrue()
    {
        $spec = $this->getSpecMock();
        $spec->expects($this->never())
             ->method('isSatisfiedBy');

        $orSpec = new OrSpecification($this->getTrueSpec(), $spec);

        $this->assertTrue($orSpec->isSatisfiedBy($this->candidate));
    }

    public function testTrueFalse()
    {
        $spec = $this->getSpecMock();
        $spec->expects($this->never())
             ->method('isSatisfiedBy');

        $orSpec = new OrSpecification($this->getTrueSpec(), $spec);

        $this->assertTrue($orSpec->isSatisfiedBy($this->candidate));
    }

    public function testFalseFalse()
    {
        $orSpec = new OrSpecification($this->getFalseSpec(), $this->getFalseSpec());

        $this->assertFalse($orSpec->isSatisfiedBy($this->candidate));
    }

    private function getTrueSpec()
    {
        $spec = $this->getSpecMock();
        $spec->expects($this->once())
             ->method('isSatisfiedBy')
             ->with($this->candidate)
             ->will($this->returnValue(true));

        return $spec;
    }

    private function getFalseSpec()
    {
        $spec = $this->getSpecMock();
        $spec->expects($this->once())
             ->method('isSatisfiedBy')
             ->with($this->candidate)
             ->will($this->returnValue(false));

        return $spec;
    }

    private function getSpecMock()
    {
        return $this->getMockBuilder(SpecificationInterface::CLASS)->getMock();
    }
}
