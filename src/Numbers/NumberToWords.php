<?php

namespace VivekMistry\InvoiceEngine\Numbers;

use NumberFormatter;

class NumberToWords
{
    public function convert(float $amount, string $locale): string
    {
        $formatter = new NumberFormatter($locale, NumberFormatter::SPELLOUT);
        return ucfirst($formatter->format($amount));
    }
}
