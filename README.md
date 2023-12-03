# Prism2Torchlight

**Prism2Torchlight** is a Laravel package designed to effortlessly convert PrismJS HTML code blocks to Torchlight syntax highlighting.

## Installation

You can install the package via Composer:

```bash
composer require aozen/prism2torchlight
```

## Usage

To use Prism2Torchlight, you need to include the TorchlightCast class in your Eloquent model's $casts property.
This will automatically convert PrismJS code blocks when retrieving data from the database.

```php
use Aozen\Prism2Torchlight\TorchlightCast;

class YourModel extends Model
{
    protected $casts = [
        'text' => TorchlightCast::class,
    ];
}
```

## Example

```php
$text = '<pre class="language-php"><code>echo "Hello, Laravel!";</code></pre>';
$convertedText = Prism2Torchlight\Prism2Torchlight::convertToTorchlight($text);

echo $convertedText;
```

## Requirements

1. PHP >= 7.3
2. Laravel >= 7.0

## License
This package is open-source software licensed under the MIT license.
Feel free to copy and paste this content into your README.md file. Let me know if you have any further requests or modifications!