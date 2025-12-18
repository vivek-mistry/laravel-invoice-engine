<?php

namespace VivekMistry\InvoiceEngine\Tax\Calculators;

use VivekMistry\InvoiceEngine\Tax\Contracts\TaxCalculatorInterface;

class SalesTaxCalculator implements TaxCalculatorInterface
{
    public function calculate(float $amount, array $data = []): array
    {
        $rate = $data['rate'];
        $tax = ($amount * $rate) / 100;

        return [
            'tax' => round($tax, 2),
            'total' => round($amount + $tax, 2),
        ];
    }
}
