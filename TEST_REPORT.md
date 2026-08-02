# PHP Test Report

Bu rapor, `turkiye-iban-php` istemcisinin public API'sini ve indirilebilir
release assetlerini tek tek kontrol eder. Testlerde yalniz sentetik IBAN
kullanildi.

## Güncel Release Kanıtı

- Release: [v0.1.7](https://github.com/trugurpala/turkiye-iban-php/releases/tag/v0.1.7)
- Asset: `turkiye-iban-php-v0.1.7.tar.gz`
- SHA-256: `6fba994e11b016e5238fa8fa350ec4652682ca5ac08e9cb7114751902ffe00c9`
- GitHub Actions: [tag run 30763570929](https://github.com/trugurpala/turkiye-iban-php/actions/runs/30763570929), Composer testleri ve PHPStan tamamlandıktan sonra arşivi yükledi.

Arşiv GitHub Release'den yeniden indirildi; SHA-256 özeti asset kaydıyla
eşleşti. `v0.1.6` asset içermeden oluştuğu için withdrawn prerelease olarak
işaretlendi; kurulum için `v0.1.7` kullanılmalıdır.

## Indirilen Release Kaniti

- Release: [v0.1.5](https://github.com/trugurpala/turkiye-iban-php/releases/tag/v0.1.5)
- Asset: `turkiye-iban-php-v0.1.5.tar.gz`
- SHA-256: `6b19e849aede462fd05ecf19a1e78e753dfa5c23d1d955cd4de825b48fb6afc4`
- Paket yapisi: `src/`, `tests/`, `resources/`, `scripts/` ve GitHub Actions dosyalari mevcut

`v0.1.5` arşivi GitHub release'ından temiz bir klasöre yeniden indirildi;
SHA-256 değeri eşleşti, paket içinde `vendor/`, cache veya yerel
`composer.lock` bulunmadığı kontrol edildi. Composer metadata doğrulandı,
bağımlılıklar temiz kuruldu, PHPUnit ve PHPStan çalıştı. Release arşivinin
kendisi **10 test, 26 assertion** geçti. Yedi public API testi
[`tests/PublicApiTest.php`](https://github.com/trugurpala/turkiye-iban-php/blob/main/tests/PublicApiTest.php)
dosyasında ayrıca tek tek çalıştırıldı.

## Ortam ve Sonuc

| Kontrol | Sonuc |
| --- | --- |
| PHP | 8.4.22, proje gereksinimi `>=8.2` |
| Composer metadata | Gecerli |
| PHPUnit | Basarili |
| PHPStan level 8 | Hata yok |
| Gercek veri taramasi | Gercek IBAN kullanilmadi |

GitHub Actions release workflow kaniti: [main run 30745790470](https://github.com/trugurpala/turkiye-iban-php/actions/runs/30745790470)
basarili oldu. `package` job'i Composer testleri ve PHPStan level 8'i
calistirdi; etiketsiz push oldugu icin `release` job'i beklenen sekilde skip
edildi. Arsiv yukleme yalnizca `v*` tag push'unda calisir.

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

Release çalışma sonucu: **10 PHPUnit testi, 26 assertion, başarılı**.
Yedi public API fonksiyonu ayrıca ayrı ayrı **1 test** olarak çalıştırıldı.
PHPStan seviye 8 sonucu: **No errors**. GitHub Actions ayrıca PHP 8.2, 8.3 ve
8.4 matrisini çalıştırmıştır.

## Sinir

Bu testler IBAN'in bicimini, MOD 97-10 checksum'ini ve kurulus kodu eslesmesini
kontrol eder. Bir hesabın varligini, hesap sahibini veya transfer yapilabilirligini
kanıtlamaz. `providerStatus: "unknown"`, checksum hatasi degil; kodun sabitlenmis
veri kumesinde bulunmadigi anlamina gelir.

