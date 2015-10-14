<?php

namespace Jach\Specification;

use \Jach\Specification\SpecificationInterface;
use \Jach\Specification\CompositeSpecification;

class NotSpecificationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->candidate = new \stdClass();
    }

    public function testTrue()
    {
        $orSpec = new NotSpecification($this->getTrueSpec());

        $this->assertFalse($orSpec->isSatisfiedBy($this->candidate));
    }

    public function testFalse()
    {
        $orSpec = new NotSpecification($this->getFalseSpec());

        $this->assertTrue($orSpec->isSatisfiedBy($this->candidate));
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
