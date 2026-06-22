# Dokumentasi Website Intawaanatour (Inta Waana Tour)

Website company profile & pemesanan trip untuk **Intawaanatour** — jasa sewa
speedboat privat Labuan Bajo / Taman Nasional Komodo.

> Tagline: *Your Private Journey, Your Unforgettable Moments*
> Instagram: [@intawaanatour](https://www.instagram.com/intawaanatour/)

---

## 1. Teknologi

| Komponen | Detail |
|----------|--------|
| Framework | CodeIgniter 4 (PHP 8.2) |
| Database | MariaDB 10.11 |
| Web server | Apache 2 (mod_rewrite, deflate, expires, headers) |
| Front-end | HTML5 + CSS kustom + JavaScript murni (tanpa framework) |
| Container | Docker / Docker Compose |
| Bahasa konten | Dwibahasa (Indonesia & English) |

---

## 2. Cara Menjalankan (Docker)

Seluruh stack dijalankan dari **root workspace** (`WEBSITE-COMPANY-PROFILE/`),
karena database MariaDB di-share untuk seluruh project di workspace ini.

```bash
# dari folder root: D:\AI\WEBSITE-COMPANY-PROFILE
docker compose up -d --build
```

Layanan yang berjalan:

| Container | Fungsi | Akses |
|-----------|--------|-------|
| `intawaanatour_app` | Aplikasi CI4 (Apache + PHP) | http://localhost:8082 |
| `workspace_db` | MariaDB bersama | localhost:3307 (host) / `db:3306` (internal) |

Data MariaDB dibind ke `../mariadb/data` (di luar folder project) agar persisten
dan bisa dipakai lintas project.

### Menghentikan / melihat status

```bash
docker compose ps
docker compose down          # stop (data tetap aman)
docker compose logs -f app   # melihat log aplikasi
```

---

## 3. Konfigurasi

File `.env` (folder `Intawaanatour/`):

```ini
CI_ENVIRONMENT = development        # ubah ke production saat live
app.baseURL = 'http://localhost:8082/'

database.default.hostname = db      # nama service di docker-compose
database.default.database = intawaanatour
database.default.username = intawaana
database.default.password = intawaana_pass
database.default.port     = 3306
```

### Migrasi & data awal (seeder)

```bash
docker exec intawaanatour_app php spark migrate
docker exec intawaanatour_app php spark db:seed DatabaseSeeder
```

Seeder mengisi: 1 akun admin, pengaturan situs, 6 paket trip, 12 foto galeri,
4 artikel, dan 1 contoh pemesanan.

---

## 4. Struktur Halaman Publik

| Halaman | URL | Keterangan |
|---------|-----|------------|
| Beranda | `/` | Hero, tentang, paket unggulan, galeri, artikel (sebagian dimuat **async + skeleton**) |
| Paket Trip | `/trips` | Daftar paket + filter (Private / Shared / Sunset) |
| Detail Trip | `/trips/{slug}` | Itinerary, harga, galeri, form pemesanan |
| Galeri | `/gallery` | Galeri foto + lightbox |
| Artikel | `/articles` | Daftar artikel SEO |
| Detail Artikel | `/articles/{slug}` | Isi artikel |
| Tentang | `/about` | Profil perusahaan |
| Kontak | `/contact` | Info kontak, peta, form |
| Ganti bahasa | `/lang/id` · `/lang/en` | Beralih ID / EN |
| SEO | `/sitemap.xml` · `/robots.txt` | Otomatis |

---

## 5. Panel Admin

### URL & Contoh Akun Login

> **URL Login:** http://localhost:8082/admin/login

| Field | Nilai contoh |
|-------|--------------|
| **Email** | `admin@intawaanatour.com` |
| **Password** | `admin12345` |

> ⚠️ **Penting:** ganti password default ini setelah serah terima
> (lihat bagian *Mengganti Password Admin* di bawah).

### Cara Login

1. Buka `http://localhost:8082/admin/login`.
2. Masukkan **Email** dan **Password** di atas.
3. Klik **Masuk** → diarahkan ke Dashboard.
4. Untuk keluar, klik **Logout** di kanan atas.

### Menu & Fungsi Panel

| Menu | Fungsi |
|------|--------|
| **Dashboard** | Ringkasan statistik (pemesanan baru, total trip, artikel, foto) + pemesanan terbaru |
| **Paket Trip** | Tambah / edit / hapus paket; unggah cover & galeri; atur harga, durasi, itinerary (ID/EN), status aktif & unggulan |
| **Galeri** | Unggah banyak foto sekaligus, beri kategori, hapus |
| **Artikel** | Tulis / edit artikel dwibahasa, cover, meta description, status terbit |
| **Pemesanan** | Lihat pemesanan masuk, ubah status (new → confirmed → done / cancelled), hubungi via WhatsApp, hapus |
| **Pengaturan** | Identitas situs, kontak, WhatsApp, alamat, jam operasional, sosial media, embed Google Maps |

---

## 6. Mengelola Konten (Tanpa Coding)

### Menambah Paket Trip
Admin → **Paket Trip** → **+ Tambah Trip** → isi judul, harga, durasi,
itinerary (ID & EN), unggah cover + foto galeri → **Simpan**.

### Menambah Foto Galeri
Admin → **Galeri** → pilih beberapa foto sekaligus → beri judul/kategori → **Unggah**.

### Menulis Artikel
Admin → **Artikel** → **+ Tulis Artikel** → isi konten ID/EN, cover,
meta description → centang **Terbitkan** → **Simpan**.

### Mengubah Kontak / WhatsApp / Tagline
Admin → **Pengaturan** → ubah field → **Simpan**. Nomor WhatsApp memakai
format internasional tanpa `+`, mis. `6281234567890`.

---

## 7. Mengganti Gambar & Logo

- Aset gambar ada di `public/assets/img/`.
- Untuk mengganti foto bawaan, **timpa file dengan nama yang sama** (mis.
  `hero.jpg`, `gal-padar.jpg`). Referensi di kode memakai nama tetap.
- Logo: `logo.jpg` (sumber), `logo-mark.png` (navbar/footer), `favicon.ico`,
  `favicon-32.png`, `apple-touch-icon.png`.
- Helper `img_url()` otomatis fallback ke `placeholder.jpg` bila kosong.

---

## 8. Mengganti Password Admin

Gunakan akun yang sudah login → (jika fitur ubah password belum ada di UI),
jalankan perintah berikut untuk men-set password baru:

```bash
docker exec intawaanatour_app php spark db:seed   # contoh; atau update manual via SQL
```

Atau update langsung via database (hash bcrypt):

```sql
UPDATE users
SET password_hash = '<hasil password_hash(...)>'
WHERE email = 'admin@intawaanatour.com';
```

---

## 9. Optimasi Performa yang Diterapkan

- **Kompresi GZIP** (mod_deflate) untuk HTML/CSS/JS/SVG.
- **Cache browser** 1 tahun untuk gambar/CSS/JS (mod_expires + `Cache-Control: immutable`).
- **Lazy loading** gambar (`loading="lazy"`) + dimensi eksplisit (mengurangi *layout shift*).
- **Hero** memakai `fetchpriority="high"`.
- **Pemuatan asinkron + skeleton** untuk bagian dinamis beranda (trip, galeri, artikel),
  sehingga halaman tampil cepat lalu konten menyusul.
- **JavaScript `defer`** & CSS tunggal yang ringan.

---

## 10. SEO & Multi-bahasa

- Meta title/description, Open Graph, Twitter Card, dan JSON-LD `TravelAgency`.
- `sitemap.xml` & `robots.txt` otomatis.
- Konten dwibahasa: kolom `_id` & `_en` pada trip/artikel; helper `t()`, `tr()`
  memilih bahasa sesuai `locale`.

---

## 11. Checklist Go-Live (Produksi)

- [ ] `CI_ENVIRONMENT = production` di `.env`.
- [ ] `app.baseURL` = domain final (mis. `https://intawaanatour.id/`).
- [ ] Ganti password admin default.
- [ ] Hapus jeda `usleep()` mode dev pada `Home::section()` (opsional).
- [ ] Pasang sertifikat SSL (HTTPS).
- [ ] Backup rutin folder `mariadb/data` & `public/assets/uploads`.

---

## 12. Kontak Pengembang

Dikembangkan oleh **NFM Tech** — Web Development & Digital Solutions.
CP: Nuriyanto · 087823339007 · https://nfmtech.my.id
