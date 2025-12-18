<?php

namespace VivekMistry\InvoiceEngine\Currency;

use NumberFormatter;

class CurrencyFormatter
{
    public function format(float $amount, string $currency, string $locale): string
    {
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $currency);
    }
}
