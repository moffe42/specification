<?php

namespace Jach\Specification;

use Jach\Specification\NotSpecification;
use Jach\Specification\OverDueSpecification;
use Jach\Specification\NoticeNotSentSpecification;
use Jach\Specification\InCollectionSpecification;

class SpecificationTests extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->invoices       = json_decode(file_get_contents(__DIR__ . '/fixture/db.json'));
        $this->overDue        = new OverDueSpecification(time());
        $this->noticeNotSent  = new NoticeNotSentSpecification();
        $this->inCollection   = new InCollectionSpecification();
    }

    public function usingSpec($spec)
    {
        $res = [];
        foreach ($this->invoices as $invoice) {
            if ($spec->isSatisfiedBy($invoice)) {
                $res[] = $invoice;
            }
        }

        return $res;
    }

    public function testOverDueSpecification(){
        $this->assertFalse($this->overDue->isSatisfiedBy($this->invoices[0]));
        $this->assertTrue($this->overDue->isSatisfiedBy($this->invoices[1]));
        $this->assertTrue($this->overDue->isSatisfiedBy($this->invoices[2]));
        $this->assertTrue($this->overDue->isSatisfiedBy($this->invoices[3]));
    }

    public function testNoticeSentSpecification(){
        $this->assertTrue($this->noticeNotSent->isSatisfiedBy($this->invoices[0]));
        $this->assertTrue($this->noticeNotSent->isSatisfiedBy($this->invoices[1]));
        $this->assertFalse($this->noticeNotSent->isSatisfiedBy($this->invoices[2]));
        $this->assertTrue($this->noticeNotSent->isSatisfiedBy($this->invoices[3]));
    }

    public function testInCollectionSpecification(){
        $this->assertFalse($this->inCollection->isSatisfiedBy($this->invoices[0]));
        $this->assertTrue($this->inCollection->isSatisfiedBy($this->invoices[1]));
        $this->assertFalse($this->inCollection->isSatisfiedBy($this->invoices[2]));
        $this->assertFalse($this->inCollection->isSatisfiedBy($this->invoices[3]));
    }

    public function testAndX()
    {
        $spec = $this->overDue->_and($this->noticeNotSent);
        $this->assertCount(2, $this->usingSpec($spec));
    }

    public function testAndXandNot()
    {
        $spec = $this->overDue
            ->_and($this->noticeNotSent)
            ->_not(new NotSpecification($this->inCollection));
        $this->assertCount(2, $this->usingSpec($spec));
    }

    public function testOr()
    {
        $spec = $this->overDue
            ->_or(new NotSpecification($this->overDue));

        $this->assertCount(4, $this->usingSpec($spec));
    }
}
