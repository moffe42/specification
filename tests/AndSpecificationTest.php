<?php

namespace Jach\Specification;

use \Jach\Specification\SpecificationInterface;
use \Jach\Specification\CompositeSpecification;

class AndSpecificationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->candidate = new \stdClass();
    }

    public function testTrueTrue()
    {
        $andSpec = new AndSpecification($this->getTrueSpec(), $this->getTrueSpec());

        $this->assertTrue($andSpec->isSatisfiedBy($this->candidate));
    }

    public function testTrueFalse()
    {
        $andSpec = new AndSpecification($this->getTrueSpec(), $this->getFalseSpec());

        $this->assertFalse($andSpec->isSatisfiedBy($this->candidate));
    }

    public function testFalseFalse()
    {
        $spec = $this->getSpecMock();
        $spec->expects($this->never())
             ->method('isSatisfiedBy');

        $andSpec = new AndSpecification($this->getFalseSpec(), $spec);

        $this->assertFalse($andSpec->isSatisfiedBy($this->candidate));
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
