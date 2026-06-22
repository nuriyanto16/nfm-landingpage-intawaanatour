<?php

namespace App\Controllers;

use App\Models\GalleryModel;

class Gallery extends BaseController
{
    public function index(): string
    {
        $model = new GalleryModel();

        return view('public/gallery', [
            'meta' => [
                'title'       => t('Galeri Foto Labuan Bajo & Komodo', 'Labuan Bajo & Komodo Photo Gallery') . ' — Intawaanatour',
                'description' => t('Kumpulan foto speedboat, destinasi, dan momen perjalanan bersama Intawaanatour di Labuan Bajo.', 'A collection of speedboat, destination, and journey photos with Intawaanatour in Labuan Bajo.'),
                'image'       => 'assets/img/gal-padar.jpg',
                'breadcrumb'  => [
                    ['name' => t('Beranda', 'Home'), 'url' => base_url('/')],
                    ['name' => t('Galeri', 'Gallery'), 'url' => base_url('gallery')],
                ],
            ],
            'items' => $model->ordered(),
        ]);
    }
}
