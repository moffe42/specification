<?php

namespace Jach\Specification;

use \Jach\Specification\SpecificationInterface;
use \Jach\Specification\CompositeSpecification;

class AllSpecification extends CompositeSpecification
{
	private $specification;

	public function __construct(SpecificationInterface $specification)
	{
		$this->specification  = $specification;
	}

	public function isSatisfiedBy($candidates)
	{
		foreach ($candidates as $c) {
			if (!$this->specification->isSatisfiedBy($c)) {
				return false;
			}
		}
		return true;
	}
}
