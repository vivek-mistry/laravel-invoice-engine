<?php

namespace VivekMistry\InvoiceEngine\Tests;

use VivekMistry\InvoiceEngine\Facades\Invoice;

class DiscountTest extends TestCase
{
    /** @test */
    public function it_applies_percentage_discount_before_tax()
    {
        $result = Invoice::amount(1000)
            ->discountPercent(10)
            ->country('IN')
            ->taxRate(18)
            ->summary();

        $this->assertEquals(100, $result['discount']);
        $this->assertEquals(162, $result['tax']);
        $this->assertEquals(1062, $result['total']);
    }

    /** @test */
    public function it_applies_flat_discount()
    {
        $result = Invoice::amount(1000)
            ->discountAmount(200)
            ->country('IN')
            ->taxRate(18)
            ->summary();

        $this->assertEquals(200, $result['discount']);
        $this->assertEquals(144, $result['tax']);
    }

    /** @test */
    public function discount_never_exceeds_amount()
    {
        $result = Invoice::amount(500)
            ->discountAmount(1000)
            ->taxRate(10)
            ->summary();

        $this->assertEquals(0, $result['total']);
    }
}
