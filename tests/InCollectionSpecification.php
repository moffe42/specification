<?php

namespace Jach\Specification;;

use \Jach\Specification\CompositeSpecification;

class InCollectionSpecification extends CompositeSpecification
{
    public function isSatisfiedBy($candidate)
    {
        return $candidate->isInCollection;
    }
}
