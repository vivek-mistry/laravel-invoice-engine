<?php

namespace VivekMistry\InvoiceEngine\Tests;

use VivekMistry\InvoiceEngine\Facades\Invoice;

class InvoiceTest extends TestCase
{
    /** @test */
    public function it_calculates_tax_correctly()
    {
        $result = Invoice::amount(1000)
            ->country('IN')
            ->taxRate(18)
            ->summary();

        $this->assertEquals(180, $result['tax']);
    }
}
