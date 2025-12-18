<?php

namespace VivekMistry\InvoiceEngine\Tax;

use VivekMistry\InvoiceEngine\Tax\Calculators\{
    GstCalculator,
    VatCalculator,
    SalesTaxCalculator
};

class TaxResolver
{
    public function resolve(string $country)
    {
        $type = config("invoice.countries.$country.tax");

        return match ($type) {
            'gst' => new GstCalculator(),
            'vat' => new VatCalculator(),
            'sales' => new SalesTaxCalculator(),
            default => throw new \Exception("Tax type not supported"),
        };
    }
}
