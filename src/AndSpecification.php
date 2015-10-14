<?php

namespace Jach\Specification;

use \Jach\Specification\SpecificationInterface;
use \Jach\Specification\CompositeSpecification;

class AndSpecification extends CompositeSpecification
{
    private $specificationLeft;
    private $specificationRight;

    public function __construct(SpecificationInterface $specificationLeft, SpecificationInterface $specificationRight)
    {
        $this->specificationLeft  = $specificationLeft;
        $this->specificationRight = $specificationRight;
    }

    public function isSatisfiedBy($candidate)
    {
        return $this->specificationLeft->isSatisfiedBy($candidate)
            && $this->specificationRight->isSatisfiedBy($candidate);
    }
}
