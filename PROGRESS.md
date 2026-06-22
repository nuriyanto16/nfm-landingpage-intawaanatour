# PROGRESS & IMPLEMENTATION PLAN — Website Intawaanatour

> Status tracking pengerjaan website **Intawaanatour (Inta Waana Tour)** oleh NFM Tech.
> File ini agar progres bisa **ditrace & dilanjutkan**. Terakhir diperbarui: **22 Juni 2026**.

Project: CodeIgniter 4 + MariaDB + Docker. Folder app: `Intawaanatour/`.
Jalankan dari root: `docker compose up -d` → **http://localhost:8082**
Admin: **http://localhost:8082/admin/login** · `admin@intawaanatour.com` / `admin12345`

---

## ✅ SUDAH DIKERJAKAN

### 1. Infrastruktur & Backend
- [x] Setup CodeIgniter 4 + skema DB (migration) + seeder (admin, settings, 6 trip, 12 galeri, 4 artikel)
- [x] Docker Compose dipindah ke **root workspace**; data MariaDB dibind ke `mariadb/data` (di luar project, shareable)
- [x] Container: `intawaanatour_app` (port 8082) + `workspace_db` (MariaDB, port 3307)

### 2. Halaman Publik
- [x] Beranda, Paket Trip (+detail), Galeri, Artikel (+detail), Tentang, Kontak
- [x] Multi-bahasa ID/EN (`/lang/id`, `/lang/en`)
- [x] SEO: meta, Open Graph, Twitter, JSON-LD, `sitemap.xml`, `robots.txt`
- [x] Form pemesanan → tersimpan + tombol WhatsApp

### 3. Panel Admin (CRUD lengkap)
- [x] Auth (login/logout) + filter `adminauth`
- [x] Dashboard (statistik + pemesanan terbaru)
- [x] Modul: Paket Trip, Galeri, Artikel, Pemesanan, Pengaturan
- [x] `BookingController` & `SettingController` + semua view admin (layout, login, dashboard, dst.)

### 4. Async Loading + Skeleton
- [x] Bagian dinamis beranda (trip, galeri, artikel) dimuat async via `Home::section()`
- [x] Skeleton shimmer + fallback error/retry + sembunyikan section kosong
- [x] Endpoint di-guard `isAJAX()` (403 jika akses langsung)

### 5. Gambar & Konten Asli (dari `bahan/`)
- [x] Folder `public/assets/img/` dilengkapi (27 jpg + favicon) — sebelumnya kosong/broken
- [x] Foto asli IG (pelabuhan, speedboat, tamu) → about & galeri
- [x] Flyer Pink Beach & Taka Makasar (webp→jpg via dwebp) → trip/galeri/artikel
- [x] Stok bertema laut/pulau (LoremFlickr/Picsum) untuk slot tanpa materi asli
- [x] Konten diselaraskan dengan flyer: tagline, **harga asli** (Private Day Rp 11jt, 3D2N Rp 14jt), itinerary, included/excluded

### 6. Branding — Logo
- [x] Logo **Inta Waana Tour** dipasang di navbar & footer (`logo-mark.png`)
- [x] Favicon dari logo: `favicon.ico`, `favicon-32.png`, `apple-touch-icon.png`

### 7. Optimasi Performa ("lebih enteng")
- [x] GZIP/Deflate + cache browser 1 tahun (`Cache-Control: immutable`) via `.htaccess`
- [x] Modul Apache diaktifkan (deflate/expires/headers) di Dockerfile + container
- [x] Lazy-load gambar + dimensi eksplisit (kurangi layout shift) + hero `fetchpriority=high`
- [x] Video reel `preload=metadata` (hemat — hanya metadata sampai diklik)

### 8. Video / Reel (lanjutan)
- [x] 3 video MP4 IG → `public/assets/video/reel-1..3.mp4`
- [x] Section "Cuplikan Perjalanan" di beranda: klik-untuk-putar, poster dari frame (`#t=0.5`), jeda otomatis reel lain

### 9. Perbaikan UI
- [x] Menu desktop tidak wrap lagi ("Paket Trip" 1 baris) + tagline ellipsis
- [x] **Menu mobile**: hamburger kini tampil, drawer kanan; tombol "Pesan Sekarang" pindah ke dalam drawer

### 10. Dokumentasi & Penawaran
- [x] `Intawaanatour/DOKUMENTASI.md` — panduan lengkap + contoh login admin
- [x] Screenshot website (publik + admin + mobile) di `_captures/`
- [x] **Lampiran proposal** dibuat & digabung → `bahan/file penawaran/Proposal_Penawaran_NFM_Tech_Intawanatour_FINAL.pdf` (15 hal: proposal asli + Lampiran A menu/spesifikasi, Lampiran B screenshot). Bagian "Ringkasan & Roadmap Modul" dihapus atas permintaan. Original tidak diubah.

---

## ⏳ BELUM / ROADMAP LANJUTAN
- [x] **DARK THEME penuh (selaras flyer)** — situs diubah dari tema terang → **navy gelap pekat + emas + teks putih** persis mood flyer. Implementasi: blok override "DARK THEME" di akhir `style.css` (token `--bg #081626`, `--panel #0f2740`, bingkai emas `--border`, teks putih). Meng-override body, kartu, feature, form, pills, booking-box, navbar-scrolled (tetap gelap), footer, mobile drawer, article-body, skeleton. Palet inti sebelumnya: `--navy #0a1d33`, `--gold #d8a73f`.
- [~] **4 paket trip lainnya** — pakai **harga & foto DUMMY** dulu (atas permintaan user). Harga seeder: shared Rp 750rb, sunset Rp 1,5jt, shared 3D2N Rp 2,75jt, fishing Rp 4,5jt. Tinggal ganti harga/itinerary asli bila user kirim.
- [x] **AUDIT & GANTI semua gambar stok nyasar** — banyak slot LoremFlickr nyasar total (pesawat, gamer, mobil mainan, bus, lokomotif, jalan tol, orang pidato). Diganti pemandangan Labuan Bajo/Komodo asli dari Wikimedia Commons (crop GD): cover trip `trip-padar/sunset/kanawa`; **hero beranda** (tadinya jalan tol California), `contact` (marina), `og-default`, `placeholder`, artikel `art-manta`(manta)/`art-sunset`(sunset) + **`art-hero.jpg` baru untuk header Artikel** (Rinca), galeri `gal-kanawa/kelor/manta/padar/sunset/komodo`(Komodo dragon). Atribusi lisensi → lihat memory [[website-images]] (wajib saat go-live). Cek visual via montase GD.
- [ ] Galeri video / reel tambahan
- [x] **Panel admin diperbagus + skeleton saat load data** — `admin/layout.php` dirombak: sidebar gradient dgn ikon SVG + grouping (Utama/Konten/Aktivitas/Sistem), topbar sticky (avatar + breadcrumb + tombol logout), kartu stat dgn ikon chip, tabel responsif (`.table-wrap`), state kosong berikon, fokus form beraksen brand, login page disegarkan (logo mark + gradient radial). **Skeleton**: CSS shimmer (`.sk`/`sk-shimmer`) + `public/assets/js/admin.js` — saat klik link navigasi admin, area konten diganti kerangka shimmer (varian dashboard/list) selama request berjalan; plus toggle sidebar mobile + scrim (sebelumnya sidebar hilang tanpa cara buka). Diuji E2E (login → semua modul HTTP 200).
- [x] **SEO halaman utama dimaksimalkan** — `partials/seo_head.php`: JSON-LD global **Organization (TravelAgency, @id #organization)** + **WebSite** di semua halaman, **BreadcrumbList** per halaman (via `meta['breadcrumb']` di tiap controller), `og:image:alt/width/height/secure_url`, `og:locale:alternate`, `twitter:image:alt`, robots `max-image-preview:large,max-snippet:-1`, keywords/author/geo meta, canonical bersih (tanpa query). Detail trip → `og:type=product`; detail artikel → `og:type=article` + Article JSON-LD diperkaya (mainEntityOfPage, dateModified, inLanguage, publisher @id). Home jsonld jadi **WebPage** (hindari TravelAgency dobel). **sitemap.xml** + `lastmod`, `changefreq`, dan `<image:image>` cover trip/artikel. Diverifikasi via curl.
- [x] **Fitur ubah password admin di UI** — menu sidebar "Ubah Password" (`/admin/account`): controller `Admin\Account`, view `admin/account/password.php`, route GET `account` + POST `account/password`. Validasi: password lama wajib cocok, baru min 8 karakter, konfirmasi cocok, & tidak boleh sama dgn lama. Diuji E2E (ganti → login pw baru → kembalikan ke `admin12345`); tak perlu SQL lagi

---

## 🚀 CHECKLIST GO-LIVE (Produksi)  -> ini nanti belum ada domainnya
- [ ] `.env`: `CI_ENVIRONMENT=production` + `app.baseURL` = domain final (`https://intawaanatour.id/`)
- [ ] Ganti password admin default
- [ ] Hapus `usleep()` dev di `Home::section()` (jeda skeleton)
- [ ] Pasang SSL/HTTPS
- [ ] Backup rutin `mariadb/data` & `public/assets/uploads`

---

## 📌 CATATAN UNTUK MELANJUTKAN
- **Ganti gambar:** timpa file nama sama di `public/assets/img/`. Materi mentah ada di `bahan/`.
- **Konversi webp:** GD container tanpa webp → pakai `dwebp` (paket `webp` sudah terpasang di container).
- **Screenshot ulang:** `cd _captures && node capture.js` (butuh Chrome + puppeteer-core, sudah terpasang).
- **Rebuild lampiran PDF:** `cd _captures && python build_lampiran.py`.
- **Instagram:** scrape otomatis TIDAK bisa (login wall) — pakai materi di `bahan/`.
- Detail teknis lengkap ada di `Intawaanatour/DOKUMENTASI.md`.
