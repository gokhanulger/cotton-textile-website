# Cotton Textile WordPress Theme

Premium Turkish textile manufacturer theme - Peshtemals, Towels, Bathrobes & Hotel Collections

## Kurulum / Installation

### 1. WordPress Kurulumu

1. **Hosting Seçimi:**
   - Ücretsiz: InfinityFree, 000webhost
   - Ücretli: Hostinger ($2.99/ay), Turhost (₺49/ay), SiteGround

2. **WordPress Yükleme:**
   - Hosting panelinden "WordPress" seçeneğini kullan (one-click install)
   - Veya wordpress.org'dan indirip manuel yükle

### 2. Tema Kurulumu

1. `cotton-textile` klasörünü ZIP dosyası olarak sıkıştır
2. WordPress Admin > Görünüm > Temalar > Yeni Ekle > Tema Yükle
3. ZIP dosyasını yükle ve etkinleştir

### 3. Tema Ayarları

WordPress Admin > Görünüm > Özelleştir menüsünden:

**Contact Information:**
- WhatsApp Number: `+90 535 412 49 10`
- Email: `info@theturkishcotton.com`
- Address: `Denizli, Turkey`

**Social Media:**
- Instagram URL
- Facebook URL
- LinkedIn URL
- Pinterest URL

**Homepage Hero:**
- Hero Title
- Hero Subtitle
- Hero Background Image

### 4. Menü Oluşturma

WordPress Admin > Görünüm > Menüler

**Primary Menu:**
- Home
- Collections (Products archive)
- Peshtemals
- Towels
- Bathrobes
- Hotel Collection
- Contact

### 5. Sayfa Oluşturma

Aşağıdaki sayfaları oluşturun:

| Sayfa | Slug | Template |
|-------|------|----------|
| Home | home | Front Page (otomatik) |
| Contact | contact | Contact Page |
| About Us | about | Default |
| Privacy Policy | privacy-policy | Default |

### 6. Ürün Ekleme

WordPress Admin > Products > Add New

Her ürün için:
- **Title:** Ürün adı (örn: "Foca Peshtemal")
- **Content:** Ürün açıklaması
- **Featured Image:** Ana ürün görseli
- **Product Category:** Kategori seçimi
- **Product Details:**
  - SKU: Üretici kodu (örn: "stone")
  - Material: Malzeme (örn: "100% Turkish Cotton")
  - Size: Boyut (örn: "100 x 180 cm")
  - Weight: Ağırlık (örn: "300-350 GSM")
  - Minimum Order: Minimum sipariş (örn: "100 pieces per color")
- **Product Gallery:** Ek görseller

### 7. Mevcut Ürünlerin Aktarımı

Mevcut HTML sitedeki ürünler:

**Peshtemals:**
| SKU | Display Name |
|-----|--------------|
| stone | Foca |
| sultan | Bodrum |
| sultantrend | Cesme |
| vegas | Datca |
| zebra | Fethiye |
| multicolor | Kas |
| mandala | Akyaka |
| mikrokoton | Alacati |
| netherland | Asos |
| bugra | Yalikavak |

**Robes:**
- Kimono Robe
- Shawl Collar Robe
- Hooded Robe
- Waffle Robe
- ve diğerleri...

**Hotel Collection:**
- Hotel Bath Set
- Premium Bath Towels
- Oversized Bath Sheet
- ve diğerleri...

## Tema Özellikleri

### Custom Post Types
- **Products:** Ürün yönetimi
- **Product Categories:** Kategori taksonomisi

### Shortcodes

```
[contact_form title="Bize Ulaşın"]
[products category="peshtemals" count="8" columns="4"]
[whatsapp_button text="WhatsApp" message="Merhaba, ürünlerinizle ilgileniyorum."]
```

### Customizer Ayarları
- İletişim bilgileri
- Sosyal medya linkleri
- Hero bölümü
- Logo

### Sayfa Şablonları
- Default Page
- Contact Page
- Front Page

## Dosya Yapısı

```
cotton-textile/
├── style.css                 # Ana stil dosyası
├── functions.php             # Tema fonksiyonları
├── header.php                # Header şablonu
├── footer.php                # Footer şablonu
├── index.php                 # Ana index
├── front-page.php            # Anasayfa
├── page.php                  # Sayfa şablonu
├── page-contact.php          # İletişim sayfası
├── single-product.php        # Ürün detay
├── archive-product.php       # Ürün arşivi
├── taxonomy-product_category.php  # Kategori sayfası
├── 404.php                   # 404 sayfası
├── inc/
│   └── template-functions.php # Yardımcı fonksiyonlar
└── assets/
    ├── css/
    ├── js/
    │   └── main.js           # JavaScript
    └── images/               # Tema görselleri
```

## Gereksinimler

- WordPress 6.0+
- PHP 7.4+

## Lisans

GPL v2 or later

---

## Hızlı Başlangıç Kontrol Listesi

- [ ] WordPress kuruldu
- [ ] Tema yüklendi ve etkinleştirildi
- [ ] WhatsApp numarası ayarlandı
- [ ] Email ayarlandı
- [ ] Menüler oluşturuldu
- [ ] Contact sayfası oluşturuldu (Contact Page template)
- [ ] Kategoriler eklendi (Peshtemals, Towels, Bathrobes, Hotel Collection)
- [ ] Ürünler eklendi
- [ ] Logo yüklendi (opsiyonel)
- [ ] Hero görseli ayarlandı

## Destek

Sorularınız için: info@theturkishcotton.com
