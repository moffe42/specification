<?php

namespace Jach\Specification;

use \Jach\Specification\CompositeSpecification;

class NoticeNotSentSpecification extends CompositeSpecification
{
    public function isSatisfiedBy($candidate)
    {
        return $candidate->hasSentNotice == false;
    }
}
