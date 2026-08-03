# Katkı Rehberi

Bu depo yalnızca PHP istemcisini ve ana Türkiye IBAN veri sözleşmesinin PHP
uygulamasını kapsar. Kanonik kuruluş verisi
[ana depoda](https://github.com/trugurpala/turkiye-iban) tutulur.

## Katkı yolları

- Tekrarlanabilir PHP hatası için [bug formunu](https://github.com/trugurpala/turkiye-iban-php/issues/new/choose)
  kullanın.
- Yeni API veya belge fikrini feature formunda açıklayın.
- Ortak veri veya diller arası davranış konusunu
  [ana Discussions](https://github.com/trugurpala/turkiye-iban/discussions)
  bölümünde konuşun.

Güvenlik açığı için issue açmayın; [SECURITY.md](SECURITY.md) içindeki özel
bildirim yolunu kullanın.

## Gizlilik ve kapsam

- Gerçek IBAN, hesap sahibi, müşteri kaydı, üretim logu veya ekran görüntüsü
  paylaşmayın.
- Örnek ve fixture'larda yalnız sentetik değerler kullanın.
- Değişikliği ortak API ve veri sözleşmesiyle uyumlu tutun.
- İlgisiz Türkiye veri kümelerini bu istemciye eklemeyin.

## Geliştirme ortamı

PHP 8.2+ ve Composer gereklidir:

```bash
composer install
composer test
composer analyse
```

`composer test` PHPUnit testlerini, `composer analyse` ise PHPStan level 8
analizini çalıştırır.

## Pull request kontrolü

- `tests/fixtures/conformance.manifest.json` checksumlarını ana conformance
  sürümüyle karşılaştırın.
- Kurulu PHP sürümünü ve çalıştırdığınız komutları yazın.
- README, CHANGELOG, TEST_REPORT ve etkilenen public belgeleri gözden geçirin.
- Sabitlenmiş veri sürümü değişiyorsa kaynak release'i ve checksumı belirtin.
- Güvenlik, geriye uyumluluk ve release etkisini açıklayın.

Odaklı bir dal açın, her committe tek bir konuyu ele alın ve pull request'i
`main` dalına yöneltin.
