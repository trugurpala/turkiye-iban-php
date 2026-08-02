# Değişiklik Günlüğü

## Yayınlanmamış

## 0.1.6 - 2026-08-02

- Windows `CRLF` checkout'larında conformance fixture hash doğrulamasının
  kanonik `LF` içeriğe göre çalışması sağlandı; fixture verisi ve manifest
  değişmedi.
- README, genel sorular için ana repository'nin Discussions alanını gösterir.

- Packagist indeks kontrolü ve yetkili submit adımı `PUBLISHING.md` içinde
  gerçek HTTP sonucu ile belgelendi.

- GitHub release workflow'u kalite kontrollerini her push'ta görünür bir job
  olarak çalıştırır.
- Arşiv oluşturma ve GitHub Release yükleme yalnızca sürüm etiketleriyle yapılır;
  yazma yetkisi yayın job'ı ile sınırlandırılır.
- PHP istemci topluluk belgeleri, veri düzeltme formu ve public yüzey kontrolü
  Türkçe kullanım rehberiyle eşitlendi.
- Ana repository ile fixture byte parity'sini doğrulayan conformance fixture
  seti ve testleri eklendi.

## 0.1.5 - 2026-08-02

- Yedi public API fonksiyonunun her biri için ayrı test eklendi.
- Kullanıcıya dönük release ve doğrulama raporu eklendi.
- GitHub issue formları ve pull request kontrol listesi eklendi.
- Yerel bağımlılık ve önbellek içermeyen temiz kaynak arşivi yayımlandı.

## 0.1.4 - 2026-08-01

- Sabitlenmiş `turkiye-iban` v0.2.1 verisini kullanan PHP istemci GitHub release'i
  yayımlandı.
- PHP 8.2, 8.3, 8.4 CI ve PHPStan seviye 8 doğrulandı.
