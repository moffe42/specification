<?php

namespace Jach\Specification;

use \Jach\Specification\SpecificationInterface;
use \Jach\Specification\CompositeSpecification;

class AllSpecificationTest extends \PHPUnit_Framework_TestCase
{
    public function testWeAreSatisfiedWhenEveryElementIsGood()
    {
        $spec = $this->getMockBuilder(SpecificationInterface::CLASS)->getMock();
        $spec->method('isSatisfiedBy')
            ->will($this->onConsecutiveCalls(true, true, true, true));

        $allSpec = new AllSpecification($spec);
        $this->assertTrue($allSpec->isSatisfiedBy(['e', 'e', 'e', 'e']));
    }

    public function testWeAreNotSatisfiedWhenJustOneElementIsNotGood()
    {
        $spec = $this->getMockBuilder(SpecificationInterface::CLASS)->getMock();
        $spec->method('isSatisfiedBy')
            ->will($this->onConsecutiveCalls(true, true, false, true));

        $allSpec = new AllSpecification($spec);
        $this->assertFalse($allSpec->isSatisfiedBy(['e', 'e', 'e', 'e']));
    }
}
