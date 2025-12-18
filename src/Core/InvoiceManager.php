<?php
namespace VivekMistry\InvoiceEngine\Core;

use VivekMistry\InvoiceEngine\Currency\CurrencyFormatter;
use VivekMistry\InvoiceEngine\Numbers\NumberToWords;
use VivekMistry\InvoiceEngine\Tax\TaxResolver;

class InvoiceManager
{
    protected float $amount = 0;
    protected string $country = 'IN';
    protected string $locale;
    protected string $currency;
    protected float $taxRate = 0;
    protected bool $inclusive = false;
    protected array $options = [];
    protected float $discountPercent = 0;
    protected float $discountAmount = 0;
    protected bool $discountAfterTax = false;

    public function __construct()
    {
        $this->locale = config('invoice.default_locale');
        $this->currency = config('invoice.default_currency');
    }

    public function amount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function country(string $code): self
    {
        $this->country = strtoupper($code);
        return $this;
    }

    public function taxRate(float $rate): self
    {
        $this->taxRate = $rate;
        return $this;
    }

    public function inclusive(bool $inclusive = true): self
    {
        $this->inclusive = $inclusive;
        return $this;
    }

    public function locale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    public function currency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function summary(): array
    {
        $baseAmount = $this->amount;

        // 1️⃣ Calculate discount
        $discount = 0;

        if ($this->discountPercent > 0) {
            $discount = ($baseAmount * $this->discountPercent) / 100;
        } elseif ($this->discountAmount > 0) {
            $discount = $this->discountAmount;
        }

        $discountedAmount = max(0, $baseAmount - $discount);

        // 2️⃣ Tax calculation
        $taxCalculator = new \VivekMistry\InvoiceEngine\Tax\TaxResolver()->resolve($this->country);

        if ($this->discountAfterTax) {
            // Tax first
            $taxResult = $taxCalculator->calculate($baseAmount, [
                'rate' => $this->taxRate,
                'inclusive' => $this->inclusive,
            ]);

            $totalAfterTax = $taxResult['total'];
            $total = max(0, $totalAfterTax - $discount);

            $tax = $taxResult['tax'];
        } else {
            // Discount first (recommended)
            $taxResult = $taxCalculator->calculate($discountedAmount, [
                'rate' => $this->taxRate,
                'inclusive' => $this->inclusive,
            ]);

            $tax = $taxResult['tax'];
            $total = $taxResult['total'];
        }

        // 3️⃣ Format total
        $formatter = new \VivekMistry\InvoiceEngine\Currency\CurrencyFormatter();

        return [
            'amount' => round($baseAmount, 2),
            'discount' => round($discount, 2),
            'tax' => round($tax, 2),
            'total' => round($total, 2),
            'formatted_total' => $formatter->format($total, $this->currency, $this->locale),
        ];
    }

    public function words(): string
    {
        return new NumberToWords()->convert($this->amount, $this->locale);
    }

    public function discountPercent(float $percent): self
    {
        $this->discountPercent = max(0, min($percent, 100));
        return $this;
    }

    public function discountAmount(float $amount): self
    {
        $this->discountAmount = max(0, $amount);
        return $this;
    }

    public function discountAfterTax(bool $after = true): self
    {
        $this->discountAfterTax = $after;
        return $this;
    }
}
