<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder non-destruktif: hanya menambahkan 3 artikel infografis baru
 * (INTA WAANA) bila slug-nya belum ada. Aman dijalankan ulang.
 * Jalankan: php spark db:seed NewArticlesSeeder
 */
class NewArticlesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $articles = [
            [
                'slug' => 'hal-yang-perlu-diketahui-sebelum-sailing-komodo',
                'title_id' => 'Hal yang Perlu Anda Ketahui Sebelum Sailing Komodo',
                'title_en' => 'Things You Should Know Before Sailing Komodo',
                'cover_image' => 'assets/img/art-knowbefore.jpg',
                'excerpt_id' => 'Keselamatan Anda adalah prioritas utama kami. Berikut protokol penting sebelum berlayar menjelajahi Komodo.',
                'excerpt_en' => 'Your safety is our top priority. Here are the essential protocols before sailing Komodo.',
                'content_id' => "<p>Keselamatan Anda adalah prioritas utama kami. Berikut protokol penting yang perlu diperhatikan sebelum dan selama sailing di Taman Nasional Komodo.</p><ul><li><strong>Cek cuaca</strong> — Selalu pantau prakiraan cuaca dan ikuti arahan kru.</li><li><strong>Kenakan life jacket</strong> — Wajib dipakai saat navigasi dan aktivitas air.</li><li><strong>Tetap terhidrasi</strong> — Minum air yang cukup sepanjang perjalanan.</li><li><strong>Lindungi diri dari matahari</strong> — Gunakan tabir surya, kacamata hitam, dan topi.</li><li><strong>Hormati alam &amp; satwa</strong> — Jangan membuang sampah dan jaga jarak aman dari satwa. Leave no trace.</li></ul><p>Sail safe, enjoy more — mari jaga Komodo tetap indah.</p>",
                'content_en' => "<p>Your safety is our top priority. Here are the essential protocols to mind before and during sailing in Komodo National Park.</p><ul><li><strong>Check the weather</strong> — Always monitor the forecast and follow crew instructions.</li><li><strong>Wear a life jacket</strong> — Must be worn during navigation and water activities.</li><li><strong>Stay hydrated</strong> — Drink plenty of water throughout your trip.</li><li><strong>Protect yourself from the sun</strong> — Use sunscreen, sunglasses, and a hat.</li><li><strong>Respect nature &amp; wildlife</strong> — Do not litter and keep a safe distance from animals. Leave no trace.</li></ul><p>Sail safe, enjoy more — let's keep Komodo beautiful.</p>",
                'meta_description' => 'Protokol keselamatan penting sebelum sailing Komodo: cek cuaca, life jacket, hidrasi, lindungi dari matahari, hormati satwa.',
            ],
            [
                'slug' => 'waktu-terbaik-untuk-sailing-komodo',
                'title_id' => 'Waktu Terbaik untuk Sailing Komodo',
                'title_en' => 'The Best Time to Sailing Komodo',
                'cover_image' => 'assets/img/art-besttime.jpg',
                'excerpt_id' => 'Komodo indah sepanjang tahun, namun beberapa musim menawarkan pengalaman berlayar terbaik. Ini panduannya.',
                'excerpt_en' => 'Komodo is beautiful all year round, but some seasons offer the best sailing experience. Here is the guide.',
                'content_id' => "<p>Komodo indah sepanjang tahun, namun beberapa musim menawarkan pengalaman terbaik untuk berlayar dan menjelajah.</p><ul><li><strong>April – Juni (musim terbaik)</strong> — Laut tenang, hari cerah, dan visibilitas air sangat baik untuk diving &amp; snorkeling.</li><li><strong>Juli – Agustus (puncak musim)</strong> — Cuaca sempurna dengan langit cerah. Pesan lebih awal karena paling ramai.</li><li><strong>September – Oktober (hangat &amp; nyaman)</strong> — Air hangat, lebih sepi, dan kondisi bagus untuk aktivitas laut.</li><li><strong>November (musim transisi)</strong> — Sesekali hujan, namun lanskap hijau yang indah.</li><li><strong>Desember – Maret (musim hujan)</strong> — Kemungkinan hujan dan ombak lebih besar; beberapa trip beroperasi terbatas.</li></ul><p>Sail at the right time — better weather, better experience.</p>",
                'content_en' => "<p>Komodo is beautiful all year round, but some seasons offer the best experience for sailing and exploring.</p><ul><li><strong>April – June (best overall season)</strong> — Calm seas, sunny days, and excellent visibility for diving &amp; snorkeling.</li><li><strong>July – August (peak season)</strong> — Perfect weather with clear skies. Book early as it's the most popular time.</li><li><strong>September – October (warm &amp; pleasant)</strong> — Warm waters, fewer crowds, and great conditions for marine activities.</li><li><strong>November (transition season)</strong> — Occasional rain, but beautiful green landscapes.</li><li><strong>December – March (rainy season)</strong> — Higher chance of rain and rough seas; some trips operate on a limited schedule.</li></ul><p>Sail at the right time — better weather, better experience.</p>",
                'meta_description' => 'Panduan waktu terbaik sailing Komodo per musim: April–Juni terbaik, Juli–Agustus puncak, hingga musim hujan Desember–Maret.',
            ],
            [
                'slug' => 'apa-yang-perlu-dibawa-sebelum-sailing-komodo',
                'title_id' => 'Apa yang Perlu Anda Bawa Sebelum Sailing Komodo',
                'title_en' => 'What Should You Bring Before Sailing Komodo',
                'cover_image' => 'assets/img/art-whatbring.jpg',
                'excerpt_id' => 'Kenyamanan Anda juga prioritas kami. Berikut barang penting yang wajib dibawa untuk petualangan sailing Komodo.',
                'excerpt_en' => 'Your comfort is our priority too. Here are the essential items to bring for your Komodo sailing adventure.',
                'content_id' => "<p>Kenyamanan Anda juga prioritas kami. Berikut barang penting yang wajib Anda bawa untuk petualangan sailing di Komodo.</p><ul><li><strong>Tas ransel</strong> — Ringan untuk membawa barang harian Anda.</li><li><strong>Pakaian ganti</strong> — Untuk kenyamanan setelah aktivitas air.</li><li><strong>Kacamata hitam &amp; SPF</strong> — Lindungi mata dan kulit dari terik matahari.</li><li><strong>Sepatu trekking atau sandal</strong> — Alas kaki nyaman untuk menjelajah pulau.</li><li><strong>Uang tunai</strong> — Bawa secukupnya untuk keperluan lokal karena tidak ada ATM di pulau.</li></ul><p>Your comfort is our priority — siapkan perbekalan Anda dengan baik.</p>",
                'content_en' => "<p>Your comfort is our priority too. Here are the essential items you must bring for your sailing adventure in Komodo.</p><ul><li><strong>Backpack</strong> — A lightweight bag to carry your daily essentials.</li><li><strong>Extra clothes</strong> — For comfort after water activities.</li><li><strong>Sunglasses &amp; SPF</strong> — Protect your eyes and skin from the strong sun.</li><li><strong>Trekking shoes or sandals</strong> — Comfortable footwear for exploring the islands.</li><li><strong>Cash money</strong> — Bring enough for local needs as there are no ATMs on the islands.</li></ul><p>Your comfort is our priority — pack well for the journey.</p>",
                'meta_description' => 'Daftar barang yang perlu dibawa sebelum sailing Komodo: tas ransel, pakaian ganti, kacamata & SPF, sepatu, dan uang tunai.',
            ],
        ];

        $i = 0;
        foreach ($articles as $a) {
            $exists = $this->db->table('articles')->where('slug', $a['slug'])->countAllResults();
            if ($exists) {
                continue;
            }
            $a['author']       = 'Tim Inta Waana Tour';
            $a['is_published']  = 1;
            $a['published_at']  = date('Y-m-d H:i:s', strtotime("-{$i} days"));
            $a['created_at']    = $now;
            $a['updated_at']    = $now;
            $this->db->table('articles')->insert($a);
            $i++;
        }
    }
}
