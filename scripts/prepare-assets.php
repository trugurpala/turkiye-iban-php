<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$version = getenv('TURKIYE_IBAN_DATA_VERSION') ?: 'v0.2.1';
$base = "https://github.com/trugurpala/turkiye-iban/releases/download/{$version}/";
$files = ['tr-banks.json', 'SHA256SUMS'];
if (!is_dir($root . '/resources')) mkdir($root . '/resources', 0777, true);
foreach ($files as $file) {
    $body = file_get_contents($base . $file);
    if ($body === false) throw new RuntimeException("Unable to download {$file}");
    file_put_contents($root . '/resources/' . $file, $body);
}
$checksums = [];
foreach (explode("\n", file_get_contents($root . '/resources/SHA256SUMS')) as $line) {
    if (preg_match('/^([a-f0-9]{64})\s+(.+)$/', trim($line), $match)) $checksums[$match[2]] = $match[1];
}
if (($checksums['tr-banks.json'] ?? '') !== hash_file('sha256', $root . '/resources/tr-banks.json')) throw new RuntimeException('Checksum mismatch');
echo "Prepared {$version}\n";
