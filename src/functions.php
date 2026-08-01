<?php

declare(strict_types=1);

use TurkiyeIban\Iban;
use TurkiyeIban\ProviderRepository;

function parse_iban(string $iban): array { return Iban::parse($iban); }
function validate_turkish_iban(string $iban): bool { return Iban::validate($iban); }
function get_bank_code_from_iban(string $iban): ?string { return Iban::providerCode($iban); }
function find_bank_by_code(string $code): ?array { return ProviderRepository::find($code); }
function identify_bank_from_iban(string $iban): array { return ProviderRepository::identify($iban); }
function format_iban(string $iban): string { return Iban::format($iban); }
function mask_iban(string $iban): string { return Iban::mask($iban); }
