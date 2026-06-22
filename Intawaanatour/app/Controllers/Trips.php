<?php

namespace App\Controllers;

use App\Models\TripModel;

class Trips extends BaseController
{
    public function index(): string
    {
        $model = new TripModel();

        return view('public/trips_index', [
            'meta' => [
                'title'       => t('Paket Trip Speedboat Labuan Bajo', 'Labuan Bajo Speedboat Trip Packages') . ' — Intawaanatour',
                'description' => t('Pilihan paket private trip, shared trip, dan sunset trip Labuan Bajo menuju Taman Nasional Komodo dengan harga terbaik.', 'Choose from private, shared and sunset trip packages in Labuan Bajo to Komodo National Park at the best price.'),
                'image'       => 'assets/img/trip-padar.jpg',
                'breadcrumb'  => [
                    ['name' => t('Beranda', 'Home'), 'url' => base_url('/')],
                    ['name' => t('Paket Trip', 'Trip Packages'), 'url' => base_url('trips')],
                ],
            ],
            'trips' => $model->active()->findAll(),
        ]);
    }

    public function detail(string $slug)
    {
        $model = new TripModel();
        $trip  = $model->bySlug($slug);

        if (! $trip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $images = $model->images((int) $trip['id']);
        if (empty($images)) {
            $images = [['image_path' => $trip['cover_image']]];
        }

        $jsonld = json_encode([
            '@context'    => 'https://schema.org',
            '@type'       => 'Product',
            'name'        => tr($trip, 'title'),
            'image'       => img_url($trip['cover_image']),
            'description' => tr($trip, 'summary'),
            'brand'       => ['@type' => 'Brand', 'name' => 'Intawaanatour'],
            'offers'      => [
                '@type'         => 'Offer',
                'price'         => (string) (int) $trip['price'],
                'priceCurrency' => 'IDR',
                'availability'  => 'https://schema.org/InStock',
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return view('public/trip_detail', [
            'meta' => [
                'title'       => tr($trip, 'title') . ' — Intawaanatour',
                'description' => tr($trip, 'summary'),
                'image'       => $trip['cover_image'],
                'og_type'     => 'product',
                'jsonld'      => $jsonld,
                'breadcrumb'  => [
                    ['name' => t('Beranda', 'Home'), 'url' => base_url('/')],
                    ['name' => t('Paket Trip', 'Trip Packages'), 'url' => base_url('trips')],
                    ['name' => tr($trip, 'title'), 'url' => base_url('trips/' . $trip['slug'])],
                ],
            ],
            'trip'      => $trip,
            'images'    => $images,
            'allTrips'  => $model->active()->findAll(),
        ]);
    }
}
