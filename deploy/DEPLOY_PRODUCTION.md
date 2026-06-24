# Deploy ke Production — Hostinger (intawaanatour.id)

> Production = **shared hosting Hostinger, tanpa Docker**. Saat ini **kosong** (DB 0 tabel, belum ada aplikasi). Ini deploy **pertama kali**, bukan sekadar update konten.
> Domain: **intawaanatour.id** · Web root: `domains/intawaanatour.id/public_html`

Aplikasi sudah self-contained untuk shared hosting: `vendor/` ikut di-commit, CI4 berbasis composer (tak perlu `composer install` di server).

---

## A. Database (paling cepat & aman — DB masih kosong)

File siap impor: **`deploy/prod_database.sql`** (skema + konten resmi; tabel `bookings` sengaja kosong).

**Cara 1 — phpMyAdmin (hPanel):**
1. hPanel → Databases → phpMyAdmin → pilih DB `u815543712_intawaanatour`.
2. Tab **Import** → pilih `deploy/prod_database.sql` → Go.

**Cara 2 — MySQL remote dari mesin lokal** (remote MySQL sudah aktif & teruji konek):
```bash
mysql -h srv1760.hstgr.io -u u815543712_intawaanatour -p u815543712_intawaanatour < deploy/prod_database.sql
# password: 1wCEH5lZfpc*
```
> Login admin setelah impor: `admin@intawaanatour.com` / `admin12345` (ganti via menu Akun setelah live).

---

## B. Upload file aplikasi (FTP → public_html)

Upload **seluruh isi folder `Intawaanatour/`** ke web root. Karena banyak file (termasuk `vendor/`), pakai cara massal:

**Rekomendasi (cepat): ZIP + ekstrak**
1. Buat `app.zip` dari isi `Intawaanatour/` (sertakan: `app/ public/ vendor/ writable/ spark composer.json composer.lock preload.php env`).
2. Upload `app.zip` ke web root via FTP / File Manager hPanel.
3. Ekstrak via **File Manager hPanel** (klik kanan → Extract). (Hindari menaruh `.git/`, `tests/`, `Dockerfile`, `mariadb/`.)

**Layout & document root (penting untuk keamanan):**
- **Disarankan**: set Document Root domain `intawaanatour.id` → `.../public_html/public` (hPanel → Websites → domain → Advanced → Document root). Lalu upload project sehingga `public_html/app`, `public_html/vendor`, `public_html/public`, dst.
- **Alternatif "copy langsung"** (tanpa ubah panel): taruh isi project di `public_html/`, lalu tambahkan `public_html/.htaccess` untuk mengarahkan ke `public/` DAN memblok folder sensitif:
  ```apache
  RewriteEngine On
  RewriteRule ^(app|vendor|writable|tests|env|spark|composer\.(json|lock)) - [F,L]
  RewriteCond %{REQUEST_URI} !^/public/
  RewriteRule ^(.*)$ public/$1 [L]
  ```
  ⚠️ Opsi panel (Document Root = `public/`) lebih aman daripada andalkan `.htaccess`.

---

## C. Konfigurasi `.env`

Salin **`deploy/.env.production`** menjadi `.env` di root aplikasi server (mis. `public_html/.env`).
- `CI_ENVIRONMENT = production`
- `app.baseURL = 'https://intawaanatour.id/'`
- DB host = **localhost** (bukan IP remote), kredensial `u815543712_intawaanatour`.

## D. Perizinan folder
- `writable/` harus dapat ditulis (chmod 755/775; biasanya default Hostinger sudah cukup).

## E. Verifikasi pasca-deploy
- Buka `https://intawaanatour.id/` → beranda tampil (hero boat, 4 paket, harga penawaran spesial).
- `https://intawaanatour.id/trips`, `/gallery`, `/about`, `/contact`.
- Admin: `https://intawaanatour.id/admin/login`.
- HTTPS/SSL aktif (hPanel → SSL).

## F. Setelah live (disarankan)
- Ganti password admin via menu **Akun**.
- Pastikan tabel `bookings` kosong (sudah, dari SQL).
- Banner promo: default **nonaktif**; aktifkan via Admin → Pengaturan bila perlu.
