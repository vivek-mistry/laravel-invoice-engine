<p align="center">
  <img src="docs/images/laravel_invoice_engine.png" alt="Laravel Invoice Engine"  width="80%">
</p>
## 🧾 Laravel Invoice Engine

Global invoice utilities for Laravel
<ul>
<li>Tax</li>
<li>Discounts</li>
<li>Currency</li>
<li>Number to Words</li>
</ul>

## 🚀 Features

<ul>
<li>🌍 Multi-country tax (GST, VAT, Sales Tax)</li>
<li>💸 Percentage & flat discounts</li>
<li>🔢 Number to words (locale-based)</li>
<li>💱 Currency formatting (Intl)</li>
<li>🔄 Inclusive & exclusive tax</li>
<li>🧪 Fully tested (PHPUnit)</li>
<li>⚡ Fluent, developer-friendly API</li>
</ul>

## 🛠️ Installation

Install the package via Composer:
```bash
composer require vivek-mistry/laravel-invoice-engine
```

## ⚙️ Configuration (Optional)
```bash
php artisan vendor:publish --tag=invoice-config
```

## 🧮 Basic Usage
```php
use Invoice;

Invoice::amount(1000)
    ->country('IN')
    ->taxRate(18)
    ->summary();
```

## 💸 Percentage Discount
```php
Invoice::amount(1000)
    ->discountPercent(10)
    ->taxRate(18)
    ->summary();
```

## 💱 Flat Discount
```php
Invoice::amount(1000)
    ->discountPercent(10)
    ->taxRate(18)
    ->summary();
```

## 🔄 Inclusive Tax
```php
Invoice::amount(1180)
    ->inclusive(true)
    ->taxRate(18)
    ->summary();
```

## 🔢 Number to Words
```php
Invoice::amount(1250)->words();
```

## 🌍 Supported Regions
<ul>
<li>🇮🇳 India (GST)</li>
<li>🇺🇸 USA (Sales Tax)</li>
<li>🇬🇧 UK (VAT)</li>
<li>🇪🇺 EU (VAT)</li>
<li>🇦🇪 UAE (VAT)</li>
</ul>

## 🧪 Testing
```php
vendor/bin/phpuit

```

## Change Logs
Initial Release

## Credits

- [Vivek Mistry](https://github.com/vivek-mistry) - Project creator and maintainer

## License
MIT License. See [LICENSE](/vivek-mistry/laravel-invoice-engine/blob/main/LICENSE) for details.