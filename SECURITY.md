# Güvenlik Politikası

## Desteklenen sürümler

Yalnızca en güncel GitHub sürümü güvenlik güncellemesi alır. Kullandığınız
sürümü [son GitHub sürümünden](https://github.com/trugurpala/turkiye-iban-php/releases/latest)
kontrol edin. Eski sürümlere düzeltme geri taşınması garanti edilmez.

## Güvenlik açığını özel olarak bildirin

Güvenlik açığı veya gerçek finansal veri sızıntısı için public issue,
Discussion ya da pull request açmayın.
[Özel GitHub Security Advisory](https://github.com/trugurpala/turkiye-iban-php/security/advisories/new)
oluşturun.

Raporda yalnız sentetik örneklerle şunları belirtin:

- Etkilenen paket ve PHP sürümü.
- Beklenen ve gerçekleşen davranış.
- Tekrarlama adımları.
- IBAN doğrulaması, kuruluş eşlemesi veya veri ifşası üzerindeki olası etki.

Proje yöneticisi ilk alındı bildirimini makul olarak 72 saat içinde vermeyi,
durum güncellemelerini özel kanalda paylaşmayı ve düzeltme yayımlanana kadar
ayrıntıları gizli tutmayı hedefler. Bu süre bir hizmet seviyesi taahhüdü
değildir.

## Gizlilik ve kapsam

Issue, PR, test, fixture, log veya ekran görüntüsünde gerçek IBAN, ad-soyad,
hesap bilgisi, müşteri kaydı ya da üretim verisi paylaşmayın. Bir gizlilik
olayı fark ederseniz veriyi yeniden paylaşmadan özel advisory üzerinden
konumunu bildirin.

Bu kütüphane yalnızca Türkiye IBAN biçimini ve kontrol basamaklarını doğrular;
hesabın varlığını, hesap sahibini veya transfer yapılabilirliğini doğrulamaz.
`providerStatus: "known"` yalnızca sabitlenmiş veri kümesinde kuruluş kodu
eşleşmesi bulunduğunu ifade eder.
