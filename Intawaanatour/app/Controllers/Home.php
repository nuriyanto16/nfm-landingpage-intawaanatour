<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\GalleryModel;
use App\Models\ArticleModel;

class Home extends BaseController
{
    public function index(): string
    {
        // Entitas Organisasi/WebSite kini dirender global di partials/seo_head.
        // Halaman beranda cukup menambahkan WebPage agar terhubung jelas.
        $jsonld = json_encode([
            '@context'  => 'https://schema.org',
            '@type'     => 'WebPage',
            '@id'       => base_url('/#webpage'),
            'url'       => base_url('/'),
            'name'      => setting('site_name', 'Intawaanatour'),
            'isPartOf'  => ['@id' => base_url('/#website')],
            'about'     => ['@id' => base_url('/#organization')],
            'primaryImageOfPage' => img_url('assets/img/hero.jpg'),
            'description' => setting('meta_description'),
            'inLanguage'  => locale(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return view('public/home', [
            'meta' => [
                'title'       => setting('site_name', 'Intawaanatour') . ' — ' . t('Sewa Speedboat Labuan Bajo & Trip Komodo', 'Labuan Bajo Speedboat Rental & Komodo Trips'),
                'description' => setting('meta_description'),
                'image'       => 'assets/img/hero.jpg',
                'jsonld'      => $jsonld,
            ],
        ]);
    }

    /**
     * Fragmen HTML untuk bagian halaman utama yang dimuat secara
     * asinkron (skeleton di sisi klien). Dipanggil via fetch dari main.js.
     */
    public function section(string $name)
    {
        // Hanya layani permintaan async, bukan akses langsung di browser.
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setBody('');
        }

        // Simulasikan sedikit jeda hanya pada mode development agar
        // skeleton sempat terlihat saat data lokal sangat cepat.
        if (ENVIRONMENT === 'development') {
            usleep(400000); // 0,4 detik
        }

        switch ($name) {
            case 'trips':
                return view('public/sections/trips', [
                    'featured' => (new TripModel())->featured(3),
                ]);

            case 'gallery':
                return view('public/sections/gallery', [
                    'gallery' => array_slice((new GalleryModel())->ordered(), 0, 8),
                ]);

            case 'articles':
                return view('public/sections/articles', [
                    'articles' => (new ArticleModel())->latest(3),
                ]);
        }

        return $this->response->setStatusCode(404)->setBody('');
    }
}
