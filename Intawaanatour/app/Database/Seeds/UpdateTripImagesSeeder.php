<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder non-destruktif: memperbarui galeri foto trip (tabel `trip_images`)
 * agar memakai foto destinasi ASLI (bahan GUEST INFORMATION) — bukan foto stok.
 * Hanya menyentuh `trip_images` (data turunan), tidak menyentuh booking.
 * Jalankan: php spark db:seed UpdateTripImagesSeeder
 */
class UpdateTripImagesSeeder extends Seeder
{
    public function run()
    {
        $fullDay = ['assets/img/gal-padar.jpg', 'assets/img/gal-pinkbeach.jpg', 'assets/img/gal-komodo.jpg', 'assets/img/gal-manta.jpg', 'assets/img/gal-snorkel.jpg'];

        // Per-trip: kecualikan kembaran cover agar 6 slot galeri = 6 destinasi unik.
        // Cover private-sunset = Kalong(1) → jangan ulang dest-kalong-2.
        // Cover open-sunset   = Kelor(1)  → jangan ulang dest-kelor-2.
        $sunsetPrivate = ['assets/img/dest-kelor.jpg', 'assets/img/dest-kelor-2.jpg', 'assets/img/dest-menjerite.jpg', 'assets/img/dest-rinca.jpg', 'assets/img/dest-kalong.jpg'];
        $sunsetOpen    = ['assets/img/dest-kelor.jpg', 'assets/img/dest-menjerite.jpg', 'assets/img/dest-rinca.jpg', 'assets/img/dest-kalong.jpg', 'assets/img/dest-kalong-2.jpg'];

        $map = [
            'private-full-day-sailing'    => $fullDay,
            'open-trip-full-day-sailing'  => $fullDay,
            'private-sunset-trip'         => $sunsetPrivate,
            'open-trip-sunset'            => $sunsetOpen,
        ];

        foreach ($map as $slug => $imgs) {
            $trip = $this->db->table('trips')->where('slug', $slug)->get()->getRowArray();
            if (! $trip) {
                continue;
            }
            $tripId = (int) $trip['id'];

            // Susun: cover dulu, lalu foto destinasi (unik).
            $all = array_values(array_unique(array_merge([$trip['cover_image']], $imgs)));

            // Ganti total trip_images trip ini (data turunan, aman).
            $this->db->table('trip_images')->where('trip_id', $tripId)->delete();
            foreach ($all as $i => $path) {
                $this->db->table('trip_images')->insert([
                    'trip_id' => $tripId, 'image_path' => $path, 'sort_order' => $i,
                ]);
            }
        }
    }
}
