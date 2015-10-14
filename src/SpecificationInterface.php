<?php

namespace Jach\Specification;

interface SpecificationInterface
{
    public function isSatisfiedBy($candidate);
}
