# turkiye-iban-php

[![CI](https://github.com/trugurpala/turkiye-iban-php/actions/workflows/ci.yml/badge.svg)](https://github.com/trugurpala/turkiye-iban-php/actions/workflows/ci.yml)
[![GitHub Release](https://img.shields.io/github/v/release/trugurpala/turkiye-iban-php)](https://github.com/trugurpala/turkiye-iban-php/releases/latest)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![Divan ile üretildi](https://img.shields.io/badge/Divan%20ile-%C3%BCretildi-087F8C)](https://github.com/trugurpala/divan)

PHP 8.2+ Composer istemcisi: Türkiye IBAN normalleştirme, doğrulama,
biçimlendirme, maskeleme ve kuruluş kodu eşleştirmesi.

[Ne yapar?](#ne-yapar) · [Kurulum](#kurulum) · [Hızlı kullanım](#hızlı-kullanım) · [Public API](#public-api) · [Test ve kalite](#geliştirme-ve-kalite) · [Topluluk](#ilgili-projeler)

> **Önemli sınır**
> Bu paket IBAN biçimini ve MOD 97-10 kontrolünü doğrular; hesabın varlığını,
> hesap sahibini, lisans durumunu veya transfer yapılabilirliğini doğrulamaz.
> `providerStatus: "unknown"`, checksum hatası değil, kodun sabitlenmiş veri
> kümesinde bulunmadığı anlamına gelir. Paket TCMB tarafından onaylanmış değildir.

## Ne yapar?

- Türkiye IBAN yapısını ve kontrol rakamlarını doğrular.
- Beş haneli kuruluş kodunu çıkarır ve sabitlenmiş veriyle eşleştirir.
- Bilinen ve bilinmeyen kuruluşları ayrı sonuçlarla bildirir.
- IBAN'ı dörder karakterlik gruplara ayırır veya maskeleyerek gösterir.
- Veriyi runtime sırasında ağdan indirmez; `turkiye-iban` v0.2.1 release verisini kullanır.

## Ne yapmaz?

- Hesabın varlığını, sahibini, bakiyesini veya transfer yapılabilirliğini doğrulamaz.
- TCMB, banka veya ödeme kuruluşu adına resmî onay ya da hesap doğrulama sunmaz.
- Gerçek IBAN, müşteri kaydı veya kişisel finansal veri toplamaz.
- `providerStatus: "unknown"` sonucunda otomatik kuruluş seçimi yapmaz.

## Türkiye IBAN yapısı

Türkiye IBAN'ı `TR` ülke kodu, iki kontrol rakamı, beş haneli kuruluş kodu,
bir rezerv rakamı ve 16 karakterlik hesap alanından oluşur. `MOD 97-10`,
IBAN'ın yazım bütünlüğünü matematiksel olarak kontrol eder; bir hesabın
bankada gerçekten var olduğunu kanıtlamaz.

## Kurulum

Packagist kaydı henüz doğrulanmadığı için bugün doğrulanmış GitHub release
arşivini kullanın:

```bash
curl -L https://github.com/trugurpala/turkiye-iban-php/releases/download/v0.1.5/turkiye-iban-php-v0.1.5.tar.gz -o turkiye-iban-php-v0.1.5.tar.gz
tar -xzf turkiye-iban-php-v0.1.5.tar.gz
cd turkiye-iban-php-v0.1.5
composer install --no-dev
```

Packagist kaydı doğrulandıktan sonra kısa kurulum yolu şu olacaktır:

```bash
composer require trugurpala/turkiye-iban
```

Güncel durum için ana projenin [Packagist/PyPI yayın belgesine](https://github.com/trugurpala/turkiye-iban/blob/main/docs/PACKAGE_INDEX_PUBLICATION.md) bakın.

## Hızlı kullanım

```php
<?php

require 'vendor/autoload.php';

use function identify_bank_from_iban;
use function mask_iban;

$iban = 'TR280000109999000000000001'; // yalnızca sentetik örnek
$result = identify_bank_from_iban($iban);

if ($result['parsed']['isValid'] && $result['providerStatus'] === 'known') {
    echo $result['provider']['nameOfficial'];
}

echo mask_iban($iban);
```

## Public API

| Fonksiyon | Görevi |
| --- | --- |
| `parse_iban` | IBAN bölümlerini ve hata kodlarını döndürür |
| `validate_turkish_iban` | Yapı ve MOD 97-10 sonucunu döndürür |
| `get_bank_code_from_iban` | Beş haneli kuruluş kodunu çıkarır |
| `find_bank_by_code` | Kodu veri kümesinde arar |
| `identify_bank_from_iban` | Doğrulama ve kuruluş eşleştirmesini birleştirir |
| `format_iban` | IBAN'ı dörderli gruplara ayırır |
| `mask_iban` | IBAN'ın büyük bölümünü gizler |

Detaylı davranış ve sentetik fixture sözleşmesi için ana repository'deki
[API belgesine](https://github.com/trugurpala/turkiye-iban/blob/main/docs/API.md)
ve [PHP test raporuna](TEST_REPORT.md) bakın.

## Sonuçları nasıl yorumlamalısınız?

| Sonuç | Anlamı | Uygulama davranışı |
| --- | --- | --- |
| `$result['parsed']['isValid'] === false` | IBAN yapısı veya kontrol rakamları hatalıdır | IBAN'ı kabul etmeyin |
| `$result['parsed']['isValid'] === true`, `$result['providerStatus'] === 'known'` | Kuruluş kodu veri kümesinde bulunur | Kuruluşu otomatik doldurabilirsiniz |
| `$result['parsed']['isValid'] === true`, `$result['providerStatus'] === 'unknown'` | IBAN biçimsel olarak geçerli, kod bu veri sürümünde yoktur | Kuruluşu otomatik seçmeyin; kendi iş kuralınızı uygulayın |

## İlgili projeler

- Ana veri ve TypeScript/NPM paket: [trugurpala/turkiye-iban](https://github.com/trugurpala/turkiye-iban)
- Aynı sözleşmenin Python istemcisi: [turkiye-iban-python](https://github.com/trugurpala/turkiye-iban-python)
- Ortak veri kaynakları: [DATA_SOURCES.md](https://github.com/trugurpala/turkiye-iban/blob/main/DATA_SOURCES.md)
- Güvenlik bildirimi: [SECURITY.md](SECURITY.md)
- Katkı rehberi: [CONTRIBUTING.md](CONTRIBUTING.md)
- Yayınlama: [PUBLISHING.md](PUBLISHING.md)
- Destek: [SUPPORT.md](SUPPORT.md)
- Davranış kuralları: [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)

## Geliştirme ve kalite

```bash
composer install
composer test
composer analyse
```

Her public API fonksiyonunun ayrı test edildiği [TEST_REPORT.md](TEST_REPORT.md)
belgesinde PHP 8.4 yerel kanıtı ve PHP 8.2/8.3/8.4 GitHub CI matrisi bulunur.
Gerçek IBAN, müşteri adı veya kişisel finansal veri issue, test veya PR içinde
kullanmayın.

## Release

Son doğrulanmış release [v0.1.5](https://github.com/trugurpala/turkiye-iban-php/releases/tag/v0.1.5)'tir.
Release asseti ve checksum sonucu [TEST_REPORT.md](TEST_REPORT.md) içinde
kayıtlıdır. Release geçmişi [CHANGELOG.md](CHANGELOG.md) dosyasındadır.
GitHub Release workflow'u kalite kontrollerini her push'ta çalıştırır; temiz
arşiv yalnızca `v*` version tag'inde oluşturulur.

## Divan ile üretildi

Bu proje [Divan](https://github.com/trugurpala/divan) ile tasarlandı ve üretildi.
Divan runtime bağımlılığı değildir; paket çalışırken Divan'a veya ağ servisine
ihtiyaç duymaz.

## Lisans

MIT. Ayrıntılar için [LICENSE](LICENSE) ve [NOTICE](NOTICE) dosyalarına bakın.
