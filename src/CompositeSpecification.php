<?php

namespace Jach\Specification;

use \Jach\Specification\SpecificationInterface;
use \Jach\Specification\AndSpecification;
use \Jach\Specification\OrSpecification;
use \Jach\Specification\NotSpecification;

abstract class CompositeSpecification implements SpecificationInterface
{
    public abstract function isSatisfiedBy($candidate);

    public function _and(SpecificationInterface $specification)
    {
        return new AndSpecification($this, $specification);
    }

    public function _or(SpecificationInterface $specification)
    {
        return new OrSpecification($this, $specification);
    }

    public function _not()
    {
        return new NotSpecification($this);
    }
}
