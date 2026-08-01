<?php

declare(strict_types=1);

namespace TurkiyeIban;

final class Iban
{
    public static function normalize(string $iban): string { return strtoupper((string) preg_replace('/\s+/', '', $iban)); }
    public static function format(string $iban): string { return implode(' ', str_split(self::normalize($iban), 4)); }
    public static function mask(string $iban): string
    {
        $normalized = self::normalize($iban);
        if (strlen($normalized) <= 8) return str_repeat('*', strlen($normalized));
        return self::format(substr($normalized, 0, 4) . str_repeat('*', strlen($normalized) - 8) . substr($normalized, -4));
    }
    public static function parse(string $iban): array
    {
        $normalized = self::normalize($iban); $errors = [];
        if ($normalized === '') $errors[] = 'EMPTY_INPUT';
        if (!preg_match('/^[A-Z0-9]*$/', $normalized)) $errors[] = 'INVALID_CHARACTERS';
        if (strlen($normalized) !== 26) $errors[] = 'INVALID_LENGTH';
        $country = substr($normalized, 0, 2); $check = substr($normalized, 2, 2);
        $code = substr($normalized, 4, 5); $reserve = substr($normalized, 9, 1); $account = substr($normalized, 10, 16);
        if ($country !== 'TR') $errors[] = 'INVALID_COUNTRY_CODE';
        if (!preg_match('/^\d{2}$/', $check)) $errors[] = 'INVALID_CHECK_DIGITS';
        if (!preg_match('/^\d{5}$/', $code)) $errors[] = 'INVALID_PROVIDER_CODE';
        if ($reserve !== '0') $errors[] = 'INVALID_RESERVE_DIGIT';
        if (!preg_match('/^[A-Z0-9]{16}$/', $account)) $errors[] = 'INVALID_ACCOUNT_NUMBER';
        if (strlen($normalized) === 26 && preg_match('/^[A-Z0-9]+$/', $normalized) && !self::hasChecksum($normalized)) $errors[] = 'INVALID_CHECK_DIGITS';
        return ['input'=>$iban,'normalized'=>$normalized,'formatted'=>self::format($normalized),'countryCode'=>$country,'checkDigits'=>$check,'bankCode'=>$code,'reserveDigit'=>$reserve,'accountNumber'=>$account,'isValid'=>$errors === [],'errors'=>array_values(array_unique($errors))];
    }
    public static function validate(string $iban): bool { return self::parse($iban)['isValid']; }
    public static function providerCode(string $iban): ?string
    {
        $normalized = self::normalize($iban);
        if (!str_starts_with($normalized, 'TR') || strlen($normalized) < 9) return null;
        $code = substr($normalized, 4, 5); return preg_match('/^\d{5}$/', $code) ? $code : null;
    }
    private static function hasChecksum(string $iban): bool
    {
        $rearranged = substr($iban, 4) . substr($iban, 0, 4); $remainder = 0;
        foreach (str_split($rearranged) as $char) {
            $value = ctype_digit($char) ? $char : (string) (ord($char) - 55);
            foreach (str_split($value) as $digit) $remainder = ($remainder * 10 + (int) $digit) % 97;
        }
        return $remainder === 1;
    }
}
