<?php

namespace VivekMistry\InvoiceEngine\Tax\Calculators;

use VivekMistry\InvoiceEngine\Tax\Contracts\TaxCalculatorInterface;

class GstCalculator implements TaxCalculatorInterface
{
    public function calculate(float $amount, array $data = []): array
    {
        $rate = $data['rate'];
        $inclusive = $data['inclusive'];

        if ($inclusive) {
            $tax = $amount - ($amount / (1 + $rate / 100));
            return [
                'tax' => round($tax, 2),
                'total' => round($amount, 2),
            ];
        }

        $tax = ($amount * $rate) / 100;

        return [
            'tax' => round($tax, 2),
            'total' => round($amount + $tax, 2),
        ];
    }
}
