# PHP Test Report

Bu rapor, `turkiye-iban-php` istemcisinin public API'sini ve `v0.1.4`
release assetini tek tek kontrol eder. Testlerde yalniz sentetik IBAN kullanildi.

## Release Kaniti

- Release: [v0.1.4](https://github.com/trugurpala/turkiye-iban-php/releases/tag/v0.1.4)
- Asset: `turkiye-iban-php-v0.1.4.tar.gz`
- SHA-256: `2d3ec8624e88a12d729bafd5c3ec884088bbf622e64cf311ba17f942257dc253`
- Paket yapisi: `src/`, `tests/`, `resources/`, `scripts/`, Composer ve GitHub Actions dosyalari mevcut

## Ortam ve Sonuc

| Kontrol | Sonuc |
| --- | --- |
| PHP | 8.4.22, proje gereksinimi `>=8.2` |
| Composer metadata | Gecerli |
| PHPUnit | Basarili |
| PHPStan level 8 | Hata yok |
| Gercek veri taramasi | Gercek IBAN kullanilmadi |

### Public API testleri

| Fonksiyon | Kontrol |
| --- | --- |
| `parse_iban` | Ulke, kurulus kodu, hesap alani ve `isValid` |
| `validate_turkish_iban` | Gecerli ve bozuk checksum |
| `get_bank_code_from_iban` | Bes haneli kurulus kodu cikarma |
| `find_bank_by_code` | Bilinen kod ve bilinmeyen kod |
| `identify_bank_from_iban` | `known` ve checksum'i gecerli `unknown` sonucu |
| `format_iban` | Dordlu gruplara ayirma |
| `mask_iban` | Ekran/log icin maskeleme |

Yerel calisma sonucu: **10 PHPUnit testi, 26 assertion, basarili**. PHPStan
seviye 8 sonucu: **No errors**. GitHub Actions ayrica PHP 8.2, 8.3 ve 8.4
matrisini calistirmistir.

## Sinir

Bu testler IBAN'in bicimini, MOD 97-10 checksum'ini ve kurulus kodu eslesmesini
kontrol eder. Bir hesabın varligini, hesap sahibini veya transfer yapilabilirligini
kanıtlamaz. `providerStatus: "unknown"`, checksum hatasi degil; kodun sabitlenmis
veri kumesinde bulunmadigi anlamina gelir.

