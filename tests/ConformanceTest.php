<?php

declare(strict_types=1);

namespace TurkiyeIban\Tests;

use PHPUnit\Framework\TestCase;

use function identify_bank_from_iban;
use function validate_turkish_iban;

final class ConformanceTest extends TestCase
{
    private const FIXTURE_DIR = __DIR__ . '/fixtures/';

    public function testManifestMatchesFixtureBytes(): void
    {
        $manifest = json_decode(
            (string) file_get_contents(self::FIXTURE_DIR . 'conformance.manifest.json'),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        self::assertSame('1.0.0', $manifest['contractVersion']);
        self::assertSame('2026-07-31', $manifest['dataVersion']);
        self::assertSame('v0.2.1', $manifest['sourceRelease']);
        self::assertCount(3, $manifest['fixtures']);

        foreach ($manifest['fixtures'] as $fixture) {
            $path = self::FIXTURE_DIR . $fixture['file'];
            self::assertFileExists($path);
            self::assertSame(
                $fixture['sha256'],
                self::canonicalFixtureSha256((string) file_get_contents($path)),
            );
        }
    }

    public function testManifestHashIsStableForWindowsLineEndings(): void
    {
        $manifest = json_decode(
            (string) file_get_contents(self::FIXTURE_DIR . 'conformance.manifest.json'),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );
        $fixture = $manifest['fixtures'][0];
        $content = str_replace(
            "\r\n",
            "\n",
            (string) file_get_contents(self::FIXTURE_DIR . $fixture['file']),
        );

        self::assertSame(
            $fixture['sha256'],
            self::canonicalFixtureSha256(str_replace("\n", "\r\n", $content)),
        );
    }

    public function testSharedFixtureSemantics(): void
    {
        $valid = json_decode((string) file_get_contents(self::FIXTURE_DIR . 'valid.synthetic.json'), true, 512, JSON_THROW_ON_ERROR);
        foreach ($valid as $fixture) {
            self::assertTrue(validate_turkish_iban($fixture['iban']));
        }

        $lookup = json_decode((string) file_get_contents(self::FIXTURE_DIR . 'lookup.synthetic.json'), true, 512, JSON_THROW_ON_ERROR);
        foreach ($lookup as $fixture) {
            $result = identify_bank_from_iban($fixture['iban']);
            self::assertSame($fixture['providerStatus'], $result['providerStatus']);
            self::assertSame($fixture['providerCode'], $result['providerCode']);
        }
    }

    private static function canonicalFixtureSha256(string $content): string
    {
        return hash('sha256', str_replace("\r\n", "\n", $content));
    }
}
