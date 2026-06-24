<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder non-destruktif: menambah foto galeri asli (bahan GALERY INTA WAANA
 * SPEEDBOAT) ke tabel `galleries` bila image_path-nya belum ada.
 * Aman dijalankan ulang. Jalankan: php spark db:seed UpdateGallerySeeder
 */
class UpdateGallerySeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $items = [
            ['Pemandangan Haluan Speedboat', 'assets/img/gallery-01.jpg', 'Aktivitas'],
            ['Menyusuri Perairan Komodo', 'assets/img/gallery-02.jpg', 'Aktivitas'],
            ['Petualangan Laut Komodo', 'assets/img/gallery-03.jpg', 'Aktivitas'],
            ['Air Jernih Taman Nasional Komodo', 'assets/img/gallery-04.jpg', 'Aktivitas'],
            ['Inta Waana di Pink Beach', 'assets/img/gallery-05.jpg', 'Armada'],
            ['Speedboat Inta Waana', 'assets/img/gallery-06.jpg', 'Armada'],
            ['Geladak Buritan Speedboat', 'assets/img/gallery-07.jpg', 'Armada'],
            ['Armada Inta Waana', 'assets/img/gallery-08.jpg', 'Armada'],
            ['Speedboat Bersandar di Pulau', 'assets/img/gallery-09.jpg', 'Destinasi'],
            ['Momen Trip Inta Waana', 'assets/img/gallery-10.jpg', 'Aktivitas'],
            ['Berlayar Bersama Inta Waana', 'assets/img/gallery-11.jpg', 'Aktivitas'],
            ['Eksplorasi Pulau Komodo', 'assets/img/gallery-12.jpg', 'Destinasi'],
            ['Speedboat Inta Waana di Air Toska', 'assets/img/gallery-13.jpg', 'Armada'],
            ['Profil Speedboat Inta Waana', 'assets/img/gallery-14.jpg', 'Armada'],
            ['Inta Waana Tour Labuan Bajo', 'assets/img/gallery-15.jpg', 'Armada'],
            ['Petualangan Bersama Inta Waana', 'assets/img/gallery-16.jpg', 'Armada'],
        ];

        $i = 20;
        foreach ($items as $it) {
            $exists = $this->db->table('galleries')->where('image_path', $it[1])->countAllResults();
            if ($exists) {
                continue;
            }
            $this->db->table('galleries')->insert([
                'title' => $it[0], 'image_path' => $it[1], 'category' => $it[2],
                'sort_order' => $i, 'created_at' => $now,
            ]);
            $i++;
        }
    }
}
