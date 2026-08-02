<?php

declare(strict_types=1);

namespace TurkiyeIban\Tests;

use PHPUnit\Framework\TestCase;

use function find_bank_by_code;
use function format_iban;
use function get_bank_code_from_iban;
use function identify_bank_from_iban;
use function mask_iban;
use function parse_iban;
use function validate_turkish_iban;

final class PublicApiTest extends TestCase
{
    private const SYNTHETIC_KNOWN_IBAN = 'TR280000109999000000000001';

    public function testParseIban(): void
    {
        $parsed = parse_iban(self::SYNTHETIC_KNOWN_IBAN);

        self::assertTrue($parsed['isValid']);
        self::assertSame('TR', $parsed['countryCode']);
        self::assertSame('00001', $parsed['bankCode']);
        self::assertSame('9999000000000001', $parsed['accountNumber']);
    }

    public function testValidateTurkishIban(): void
    {
        self::assertTrue(validate_turkish_iban(self::SYNTHETIC_KNOWN_IBAN));
        self::assertFalse(validate_turkish_iban('TR2900000109999000000000001'));
    }

    public function testGetBankCodeFromIban(): void
    {
        self::assertSame('00001', get_bank_code_from_iban(self::SYNTHETIC_KNOWN_IBAN));
    }

    public function testFindBankByCode(): void
    {
        $provider = find_bank_by_code('1');

        self::assertNotNull($provider);
        self::assertSame('00001', $provider['code']);
        self::assertNull(find_bank_by_code('99999'));
    }

    public function testIdentifyBankFromIban(): void
    {
        $identified = identify_bank_from_iban(self::SYNTHETIC_KNOWN_IBAN);
        $unknown = identify_bank_from_iban('TR16999990ABC123DEF456GHIJ');

        self::assertSame('known', $identified['providerStatus']);
        self::assertSame('00001', $identified['providerCode']);
        self::assertSame('unknown', $unknown['providerStatus']);
        self::assertNull($unknown['provider']);
    }

    public function testFormatIban(): void
    {
        self::assertSame(
            'TR28 0000 1099 9900 0000 0000 01',
            format_iban(self::SYNTHETIC_KNOWN_IBAN),
        );
    }

    public function testMaskIban(): void
    {
        self::assertSame(
            'TR28 **** **** **** **** **00 01',
            mask_iban(self::SYNTHETIC_KNOWN_IBAN),
        );
    }
}
