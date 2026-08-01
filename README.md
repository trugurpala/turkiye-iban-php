# turkiye-iban-php

PHP 8.2+ Composer client for Turkish IBAN normalization, validation, formatting, masking, and provider-code lookup.

```bash
composer require trugurpala/turkiye-iban
```

```php
<?php
require 'vendor/autoload.php';

use TurkiyeIban\ProviderRepository;
use TurkiyeIban\Iban;

$iban = 'TR280000109999000000000001'; // synthetic documentation value
$result = ProviderRepository::identify($iban);
echo Iban::format($iban);
```

The package checks Turkish IBAN structure and MOD 97-10 and maps the five-digit provider code to the pinned dataset. It does not verify that an account exists, identify an account holder, prove licensing, or guarantee transferability. `providerStatus=unknown` means the code is absent from the pinned dataset; it is not a claim that the IBAN checksum is invalid.

Data is embedded from the `turkiye-iban` v0.2.1 release and is not fetched at runtime. All examples and tests are synthetic. This package is not TCMB-approved.

## Development

```bash
composer install
composer test
composer analyse
```

## License

MIT. See [LICENSE](LICENSE) and [SECURITY.md](SECURITY.md).
