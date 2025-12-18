<?php

namespace VivekMistry\InvoiceEngine\Tax\Contracts;

interface TaxCalculatorInterface
{
    public function calculate(float $amount, array $data = []): array;
}
