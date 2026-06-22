<?php

use App\Models\SettingModel;

if (! function_exists('setting')) {
    /**
     * Ambil nilai pengaturan situs (di-cache per-request).
     */
    function setting(string $key, string $default = ''): string
    {
        static $cache = null;

        if ($cache === null) {
            try {
                $cache = (new SettingModel())->asMap();
            } catch (\Throwable $e) {
                $cache = [];
            }
        }

        return $cache[$key] ?? $default;
    }
}

if (! function_exists('locale')) {
    function locale(): string
    {
        return service('request')->getLocale() ?: 'id';
    }
}

if (! function_exists('tr')) {
    /**
     * Pilih kolom multi-bahasa dari sebuah baris data, mis. tr($trip, 'title').
     */
    function tr($row, string $field, string $fallback = ''): string
    {
        $loc  = locale();
        $row  = (array) $row;
        $val  = $row[$field . '_' . $loc] ?? '';
        if ($val === '' || $val === null) {
            $val = $row[$field . '_id'] ?? ($row[$field . '_en'] ?? $fallback);
        }

        return (string) $val;
    }
}

if (! function_exists('t')) {
    /**
     * Teks inline dua bahasa: t('Halo', 'Hello').
     */
    function t(string $id, string $en): string
    {
        return locale() === 'en' ? $en : $id;
    }
}

if (! function_exists('rupiah')) {
    function rupiah($number): string
    {
        if ($number === null || $number === '' || (float) $number == 0.0) {
            return t('Hubungi kami', 'Contact us');
        }

        return 'Rp ' . number_format((float) $number, 0, ',', '.');
    }
}

if (! function_exists('wa_link')) {
    function wa_link(string $message = ''): string
    {
        $number = preg_replace('/[^0-9]/', '', setting('whatsapp', '6281234567890'));

        return 'https://wa.me/' . $number . ($message !== '' ? '?text=' . rawurlencode($message) : '');
    }
}

if (! function_exists('img_url')) {
    /**
     * URL aman untuk aset gambar; fallback ke placeholder bila kosong.
     */
    function img_url(?string $path, string $fallback = 'assets/img/placeholder.jpg'): string
    {
        $path = trim((string) $path);
        if ($path === '') {
            return base_url($fallback);
        }
        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return base_url($path);
    }
}

if (! function_exists('partial')) {
    /**
     * Render partial view dengan data sendiri (instance renderer terpisah
     * agar tidak mengganggu state layout/section yang sedang dirender).
     */
    function partial(string $view, array $data = []): string
    {
        $renderer = service('renderer', null, null, false);

        return $renderer->setData($data, 'raw')->render($view, null, false);
    }
}

if (! function_exists('save_upload')) {
    /**
     * Simpan file gambar yang diupload ke public/assets/uploads dan
     * kembalikan path relatif (mis. assets/uploads/abc.jpg) atau null.
     */
    function save_upload($file, string $subdir = ''): ?string
    {
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        // Batas ukuran 5 MB
        if ($file->getSize() > 5 * 1024 * 1024) {
            return null;
        }

        // Whitelist MIME (deteksi isi) DAN ekstensi — tolak selain gambar
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $allowedExt  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (! in_array($file->getMimeType(), $allowedMime, true)
            || ! in_array(strtolower((string) $file->getExtension()), $allowedExt, true)) {
            return null;
        }

        $rel    = trim('assets/uploads/' . trim($subdir, '/'), '/');
        $target = rtrim(FCPATH, '/\\') . '/' . $rel;
        if (! is_dir($target)) {
            @mkdir($target, 0775, true);
        }

        $newName = $file->getRandomName();
        $file->move($target, $newName);

        // Kompres / resize ringan bila ekstensi GD tersedia
        try {
            service('image')
                ->withFile($target . '/' . $newName)
                ->fit(1600, 1067, 'center')
                ->save($target . '/' . $newName, 82);
        } catch (\Throwable $e) {
            // abaikan, file asli tetap tersimpan
        }

        return $rel . '/' . $newName;
    }
}

if (! function_exists('active_menu')) {
    function active_menu(string $segment, string $class = 'active'): string
    {
        $current = service('uri')->getSegment(1);
        if ($segment === '/' && $current === '') {
            return $class;
        }

        return $current === trim($segment, '/') ? $class : '';
    }
}
