<?php

declare(strict_types=1);

namespace TurkiyeIban;

final class ProviderRepository
{
    /** @return list<array<string, mixed>> */
    public static function all(): array
    {
        $data = json_decode((string) file_get_contents(dirname(__DIR__) . '/resources/tr-banks.json'), true, 512, JSON_THROW_ON_ERROR);
        return $data['providers'] ?? [];
    }
    /** @return array<string, mixed>|null */
    public static function find(string $code): ?array
    {
        $normalized = preg_replace('/\s+/', '', $code);
        if (!is_string($normalized) || !preg_match('/^\d{1,5}$/', $normalized)) return null;
        $normalized = str_pad($normalized, 5, '0', STR_PAD_LEFT);
        foreach (self::all() as $provider) if (($provider['code'] ?? null) === $normalized) return $provider;
        return null;
    }
    /** @return array<string, mixed> */
    public static function identify(string $iban): array
    {
        $parsed = Iban::parse($iban); $code = Iban::providerCode($iban); $provider = $code === null ? null : self::find($code);
        return ['parsed'=>$parsed,'providerCode'=>$code,'provider'=>$provider,'providerStatus'=>$provider === null ? 'unknown' : 'known','dataVersion'=>self::dataVersion(),'bankCode'=>$code,'bank'=>$provider,'isKnownProvider'=>$provider !== null];
    }
    public static function dataVersion(): string
    {
        $data = json_decode((string) file_get_contents(dirname(__DIR__) . '/resources/tr-banks.json'), true, 512, JSON_THROW_ON_ERROR);
        return (string) ($data['dataVersion'] ?? 'unknown');
    }
}
