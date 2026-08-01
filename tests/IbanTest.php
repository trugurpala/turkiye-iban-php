<?php

declare(strict_types=1);

namespace TurkiyeIban\Tests;

use PHPUnit\Framework\TestCase;
use TurkiyeIban\Iban;
use TurkiyeIban\ProviderRepository;

final class IbanTest extends TestCase
{
    public function testKnownSyntheticIban(): void
    {
        $iban = 'TR280000109999000000000001';
        self::assertTrue(Iban::validate($iban));
        self::assertSame('00001', Iban::providerCode($iban));
        self::assertSame('TR28 0000 0109 9990 0000 0000 0001', Iban::format($iban));
        self::assertSame('TR28 **** **** **** **** **** 0001', Iban::mask($iban));
        self::assertSame('known', ProviderRepository::identify($iban)['providerStatus']);
    }

    public function testAlphanumericAccountAndUnknownProviderAreHandled(): void
    {
        $result = ProviderRepository::identify('TR16999990ABC123DEF456GHIJ');
        self::assertTrue($result['parsed']['isValid']);
        self::assertSame('99999', $result['providerCode']);
        self::assertSame('unknown', $result['providerStatus']);
        self::assertNull($result['provider']);
    }

    public function testBadChecksumIsInvalid(): void
    {
        self::assertFalse(Iban::validate('TR2900000109999000000000001'));
    }
}
