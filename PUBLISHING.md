# Yayınlama

## Packagist submission status

Verification on 2026-08-02 returned HTTP 404 for
`https://repo.packagist.org/p2/trugurpala/turkiye-iban.json`. An unauthenticated
submission was rejected with `Missing or invalid username/apiToken`; no
Packagist package was created.

The maintainer must submit
`https://github.com/trugurpala/turkiye-iban-php` at
[Packagist submit](https://packagist.org/packages/submit), enable the GitHub
webhook, and then verify a clean `composer require trugurpala/turkiye-iban`
installation before changing the README claim.

PHP istemcisinin doğrulanmış GitHub release'i vardır; Packagist kayıt durumu
henüz doğrulanmamıştır. Temiz Composer kurulumu kontrol edilmeden
`composer require trugurpala/turkiye-iban` komutunu kullanılabilir bir Packagist
yayını gibi göstermeyin.

Release workflow'u her push'ta paket kalite kontrollerini çalıştırır. Temiz
kaynak arşivi yalnızca `v*` sürüm etiketi gönderildiğinde oluşturulur ve
yüklenir; yazma yetkisi yalnızca yayın job'ına verilir.

## Release kontrol listesi

1. Desteklenen PHP matrisi üzerinde `composer test` çalıştırın.
2. PHPStan seviye 8 için `composer analyse` çalıştırın.
3. `composer run prepare-assets` çalıştırıp sabitlenmiş veri checksum'larını
   doğrulayın.
4. Semantic Versioning'e uygun bir `v*` etiketi oluşturun.
5. GitHub release asset'ini ve checksum sonucunu kontrol edin.
6. Repository'yi Packagist'e gönderip GitHub webhook'unu etkinleştirin.
7. Temiz bir `composer require trugurpala/turkiye-iban` kurulumunu doğrulayın.

Paket runtime sırasında ağa çıkmaz. Güncel durum için [ana yayın belgesine](https://github.com/trugurpala/turkiye-iban/blob/main/docs/PACKAGE_INDEX_PUBLICATION.md)
ve [CHANGELOG.md](CHANGELOG.md) dosyasına bakın.
