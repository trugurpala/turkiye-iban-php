# Katkı Verme

Bu repository yalnızca PHP istemcisini ve ana Türkiye IBAN veri sözleşmesinin
PHP uygulamasını kapsar. Kanonik kuruluş verisi ana repository'de tutulur.

## Başlamadan önce

- Gerçek IBAN, hesap sahibi, müşteri kaydı veya üretim logu kullanmayın.
- Örnek ve fixture'larda yalnız sentetik değerler kullanın.
- Değişiklik ana repository'deki API ve veri sözleşmesiyle uyumlu olmalıdır.
- Kapsam dışı Türkiye veri setleri eklemeyin.

## Pull request öncesi

```bash
composer install
composer test
composer analyse
```

`tests/fixtures/conformance.manifest.json` içindeki checksum'ların ana
repository'nin conformance release'iyle eşleştiğini kontrol edin.
Kurulu PHP sürümünü, yapılan değişikliği ve release etkisini PR açıklamasında
belirtin. Sabitlenmiş veri sürümü değişiyorsa checksum ve kaynak geçmişini de
ekleyin. README, CHANGELOG, TEST_REPORT ve etkilenebilecek public belgeleri
kontrol edin.

## Güvenlik ve inceleme

Kişisel finans verisi içeren katkılar kabul edilmez. Yeni bir public iddia,
veri eşleştirmesi veya yayın adımı ekliyorsanız ana repository'deki risk ve
veri kaynakları belgelerini de inceleyin. Güvenlik bildirimi için
[SECURITY.md](SECURITY.md) yolunu kullanın.
