<?php

namespace App\Controllers;

use App\Models\TripModel;

class Pages extends BaseController
{
    public function about(): string
    {
        return view('public/about', [
            'meta' => [
                'title'       => t('Tentang Intawaanatour', 'About Intawaanatour') . ' — Speedboat Labuan Bajo',
                'description' => t('Kenali Intawaanatour, penyedia jasa speedboat terpercaya di Labuan Bajo dengan kru profesional dan armada modern.', 'Get to know Intawaanatour, a trusted speedboat provider in Labuan Bajo with a professional crew and modern fleet.'),
                'image'       => 'assets/img/about.jpg',
                'breadcrumb'  => [
                    ['name' => t('Beranda', 'Home'), 'url' => base_url('/')],
                    ['name' => t('Tentang', 'About'), 'url' => base_url('about')],
                ],
            ],
        ]);
    }

    public function contact(): string
    {
        return view('public/contact', [
            'meta' => [
                'title'       => t('Kontak Intawaanatour', 'Contact Intawaanatour') . ' — Labuan Bajo',
                'description' => t('Hubungi Intawaanatour untuk reservasi trip speedboat Labuan Bajo. Tersedia WhatsApp, telepon, dan email.', 'Contact Intawaanatour to book your Labuan Bajo speedboat trip via WhatsApp, phone or email.'),
                'image'       => 'assets/img/contact.jpg',
                'breadcrumb'  => [
                    ['name' => t('Beranda', 'Home'), 'url' => base_url('/')],
                    ['name' => t('Kontak', 'Contact'), 'url' => base_url('contact')],
                ],
            ],
            'allTrips' => (new TripModel())->active()->findAll(),
        ]);
    }
}
