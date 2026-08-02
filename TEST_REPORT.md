# PHP Test Report

Bu rapor, `turkiye-iban-php` istemcisinin public API'sini ve indirilebilir
release assetlerini tek tek kontrol eder. Testlerde yalniz sentetik IBAN
kullanildi.

## Indirilen Release Kaniti

- Release: [v0.1.4](https://github.com/trugurpala/turkiye-iban-php/releases/tag/v0.1.4)
- Asset: `turkiye-iban-php-v0.1.4.tar.gz`
- SHA-256: `2d3ec8624e88a12d729bafd5c3ec884088bbf622e64cf311ba17f942257dc253`
- Paket yapisi: `src/`, `tests/`, `resources/`, `scripts/`, Composer ve GitHub Actions dosyalari mevcut

`v0.1.4` arşivi temiz bir klasöre yeniden indirildi; SHA-256 değeri eşleşti,
Composer metadata doğrulandı, bağımlılıklar temiz kuruldu, PHPUnit ve PHPStan
çalıştı. Bu arşiv yayınlandığı tarihteki test setiyle **3 test, 10 assertion**
geçti. Güncel yedi public API testi `main` dalındaki
[`tests/PublicApiTest.php`](https://github.com/trugurpala/turkiye-iban-php/blob/main/tests/PublicApiTest.php)
dosyasında ayrıca çalıştırıldı.

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

Güncel `main` çalışma sonucu: **10 PHPUnit testi, 26 assertion, başarılı**.
Yedi public API fonksiyonu ayrıca ayrı ayrı **1 test** olarak çalıştırıldı.
PHPStan seviye 8 sonucu: **No errors**. GitHub Actions ayrıca PHP 8.2, 8.3 ve
8.4 matrisini çalıştırmıştır.

## Sinir

Bu testler IBAN'in bicimini, MOD 97-10 checksum'ini ve kurulus kodu eslesmesini
kontrol eder. Bir hesabın varligini, hesap sahibini veya transfer yapilabilirligini
kanıtlamaz. `providerStatus: "unknown"`, checksum hatasi degil; kodun sabitlenmis
veri kumesinde bulunmadigi anlamina gelir.

