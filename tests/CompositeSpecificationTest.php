<?php

namespace Jach\Specification;

class CompositeSpecificationTests extends \PHPUnit_Framework_TestCase
{
    public function testAnd()
    {
        $spec = $this->getCompositSpecWith(true);

        $spec = $spec->_and($this->getTrueSpec());

        $this->assertTrue($spec->isSatisfiedBy(new \stdClass));
    }

    public function testOr()
    {
        $spec = $this->getCompositSpecWith(false);

        $spec = $spec->_or($this->getTrueSpec());

        $this->assertTrue($spec->isSatisfiedBy(new \stdClass));
    }

    public function testNot()
    {
        $spec = $this->getCompositSpecWith(true);

        $spec = $spec->_not();

        $this->assertFalse($spec->isSatisfiedBy(new \stdClass));
    }

    private function getCompositSpecWith($bool)
    {
        $spec = $this->getMockForAbstractClass(CompositeSpecification::CLASS);
        $spec->expects($this->any())
             ->method('isSatisfiedBy')
             ->will($this->returnValue($bool));

        return $spec;
    }

    private function getTrueSpec()
    {
        $spec = $this->getMockBuilder(SpecificationInterface::CLASS)
                     ->getMock();
        $spec->expects($this->once())
             ->method('isSatisfiedBy')
             ->with(new \stdClass)
             ->will($this->returnValue(true));

        return $spec;
    }
}
