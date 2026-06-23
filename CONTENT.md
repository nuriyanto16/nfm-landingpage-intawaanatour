# CONTENT.md — Log History Update Konten Website Inta Waana Tour

> Catatan riwayat pembaruan **konten & materi** website Inta Waana Tour (bukan log teknis infrastruktur — itu ada di `PROGRESS.md`).
> Sumber materi: folder `bahan/GUEST INFORMATION/` (Price List PDF, flyer trip, foto galeri, legalitas speedboat, logo).

---

## 2026-06-24 — Pembaruan Konten Besar dari materi GUEST INFORMATION

Sumber resmi yang dipakai:
- `bahan/GUEST INFORMATION/CLIENTS OFFER - INTA WAANA PRICE LIST.pdf` (price list + destinasi + included/excluded + kontak)
- `bahan/GUEST INFORMATION/Private Full Day.png`, `Private Sunset.png`, `Open Trip FullDay.png`, `Open Trip Sunset.png` (flyer berisi **harga publish + harga penawaran spesial**)
- `bahan/GUEST INFORMATION/LEGALITS INFO SPEEDBOAT/*.jpeg` (spesifikasi & legalitas kapal — dokumen KSOP)
- `bahan/GUEST INFORMATION/GALERY INTA WAANA SPEEDBOAT/*` (foto asli speedboat & destinasi)
- `bahan/GUEST INFORMATION/logo.jpeg` (logo resmi hi-res 1254×1254)

### 1. Daftar Trip & Harga (Open Trip + Private) + Penawaran Spesial
Struktur trip dirombak dari 6 paket dummy → **4 produk resmi** sesuai price list:

| Trip | Tipe | Harga Publish (coret) | Penawaran Spesial | Satuan |
|------|------|----------------------|-------------------|--------|
| Private Full Day Sailing Komodo | private | Rp 12.500.000 (1–5 pax) · Rp 13.500.000 (6–9 pax) | **Rp 11.000.000** · Rp 12.000.000 | /trip |
| Private Sunset Trip Labuan Bajo | sunset | Rp 10.500.000 (1–5 pax) · Rp 11.500.000 (6–9 pax) | **Rp 9.000.000** · Rp 10.000.000 | /trip |
| Open Trip Full Day Sailing Komodo | shared | Rp 1.450.000 | **Rp 1.350.000** | /orang |
| Open Trip Sunset Komodo | shared | Rp 1.250.000 | **Rp 1.100.000** | /orang |

- Harga **bukan rekaan** — diambil langsung dari flyer resmi (harga publish dicoret, harga penawaran spesial ditonjolkan).
- Itinerary, destinasi, included/excluded disalin dari flyer/PDF (lihat poin 3 & 4).

### 2. Fitur "Penawaran Spesial" (price special offer di web)
- **Schema baru** (`migration AddTripPromoFields`): kolom `promo_price`, `promo_label_id/en`, `price_note_id/en` di tabel `trips`.
- **Kartu trip & halaman detail**: menampilkan harga publish **dicoret** + harga penawaran spesial + badge "Penawaran Spesial / Special Offer" + catatan tier harga (mis. "6–9 pax").
- **Banner promo sitewide** (di atas navbar) — teks bisa diubah dari panel admin (`promo_active`, `promo_text_id/en`, `promo_url`).
- **Editable dari admin**: form Trip kini punya bagian "Harga & Penawaran Spesial"; menu Pengaturan punya kontrol banner promo. Kosongkan `promo_price` = promo tidak tampil.

### 3. Itinerary & Destinasi (sesuai flyer)
- **Full Day**: Padar → Pink Beach → Komodo → Taka Makasar → Manta Point → Siaba/Mawang.
- **Sunset**: Pulau Kelor → Pantai Menjerite → Pulau Rinca → Pulau Kalong (sunset & kelelawar).
- Slug baru: `private-full-day-sailing`, `private-sunset-trip`, `open-trip-full-day-sailing`, `open-trip-sunset` (link footer & "Paket Populer" diperbarui).

### 4. Included / Excluded (real)
- **Termasuk**: Speedboat ber-AC + BBM, antar-jemput hotel–pelabuhan–hotel, pemandu profesional & dokumentasi foto, air mineral/soft drink/snack, lunch box & buah, life jacket, alat snorkeling & handuk.
- **Tidak termasuk**: tiket masuk taman nasional (Sunset: khusus Rinca), hotel & tiket pesawat, tips/gratitude kru.

### 5. Spesifikasi & Legalitas Speedboat (Boat Specification)
Dari dokumen KSOP Kelas III Labuan Bajo:
- Nama kapal **INTA WAANA** · Tanda Pas Kecil **NTT 10 No. 2191**
- Jenis: Kapal Penumpang Wisata · Bahan: **Fiberglass**
- Dimensi (P×L×D): **8,31 × 2,55 × 1,10 m** · Tonase **GT 6 / NT 2**
- Mesin: **Suzuki 2 × 100 HP** · Kapasitas: hingga 9 tamu · Fasilitas: kabin ber-AC, toilet, geladak bersantai
- Dibangun di Labuan Bajo (2025–2026)
- Ditampilkan sebagai: **partial `partials/boat_spec.php`** (tabel spesifikasi) di halaman **Tentang** & **detail Trip**, plus artikel khusus "Spesifikasi & Legalitas Speedboat Inta Waana".

### 6. Galeri Foto (ambil yang bagus)
14 foto kurasi, mayoritas **foto asli Speedboat Inta Waana** dari folder GALERY:
- Speedboat di perairan turquoise, profil kapal, tampak udara, geladak haluan, kabin ber-AC, geladak buritan, anjungan kemudi, sandar di Pink Beach, berlabuh di pulau.
- Dilengkapi destinasi (Padar, Sunset) & satwa (Manta, Komodo) + aktivitas snorkeling.
- Foto juga dipakai untuk **hero beranda**, **About**, **Contact**, dan **cover 4 trip** (menggantikan stok lama).

### 7. Logo
- Logo resmi hi-res (`logo.jpeg`) diproses ulang menjadi: `logo.jpg` (logo penuh), `logo-mark.png` (emblem untuk navbar/footer), `favicon.ico`, `favicon-32.png`, `apple-touch-icon.png`, dan `og-default.jpg`.

### 8. Kontak & Identitas (data resmi 2026)
- Nama brand: **Inta Waana Tour** (sebelumnya "Intawaanatour" — semua teks publik & WA disesuaikan).
- Telepon/WA: **+62 813-2320-8786** (`6281323208786`)
- Email: **intawaana2026@gmail.com** · Instagram: **@intawaanatour**
- Alamat: **Labuan Bajo, Kabupaten Manggarai Barat, Nusa Tenggara Timur, Flores**
- Jam operasional: 06.00–21.00 WITA.

### 9. Konten lebih informatif + SEO
- Tagline: "Sewa Speedboat Private & Open Trip Labuan Bajo".
- Meta description & keywords diperbarui menyebut produk + penawaran spesial.
- JSON-LD `TravelAgency` ditambah `priceRange` (Rp 1.100.000 – Rp 13.500.000); `sameAs`, `telephone`, `email` otomatis dari settings.
- **Stat & badge yang menyesatkan dihapus** (usaha baru rilis 2026): "1.200+ tamu / 6+ tahun / rating 5★" → diganti fakta nyata (kapasitas 9 tamu, 10+ destinasi, speedboat 8,31 m, mesin 2×100 HP, "100% Private").
- Artikel diperbarui/ditambah: itinerary Full Day, spesifikasi speedboat, Pink Beach, Manta Point, sunset Pulau Kalong.

### Teknis penerapan
- Migration `2026-06-24-000001_AddTripPromoFields` + `migrate:refresh` + `db:seed` pada container `intawaanatour_app`.
- Semua halaman publik & detail trip diverifikasi **HTTP 200**; promo/harga/spesifikasi/kontak tampil benar (cek via curl + screenshot).
- File diubah: `DatabaseSeeder.php`, `TripModel.php`, `TripController.php`, `SettingController.php`, view `trip_card/trip_detail/about/home/layouts/footer/nav/trips_index/seo_head`, admin `trips/form` & `settings/index`, partial baru `boat_spec.php`, `style.css` (komponen promo/spec).
