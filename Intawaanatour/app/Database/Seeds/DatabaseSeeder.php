<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // ---------------------------------------------------------------
        // Admin user (login: admin@intawaanatour.com / admin12345)
        // ---------------------------------------------------------------
        $this->db->table('users')->ignore(true)->insert([
            'name'          => 'Administrator',
            'email'         => 'admin@intawaanatour.com',
            'password_hash' => password_hash('admin12345', PASSWORD_DEFAULT),
            'role'          => 'admin',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        // ---------------------------------------------------------------
        // Settings (data resmi dari materi GUEST INFORMATION 2026)
        // ---------------------------------------------------------------
        $settings = [
            'site_name'        => 'Inta Waana Tour',
            'site_tagline_id'  => 'Sewa Speedboat Private & Open Trip Labuan Bajo',
            'site_tagline_en'  => 'Private & Open Trip Speedboat Charter, Labuan Bajo',
            'phone'            => '+62 813-2320-8786',
            'whatsapp'         => '6281323208786',
            'email'            => 'intawaana2026@gmail.com',
            'instagram'        => 'https://instagram.com/intawaanatour',
            'facebook'         => '',
            'tiktok'           => '',
            'address'          => 'Labuan Bajo, Kabupaten Manggarai Barat, Nusa Tenggara Timur, Flores',
            'maps_embed'       => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.0!2d119.8807!3d-8.4894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zTGFidWFuIEJham8!5e0!3m2!1sen!2sid!4v1700000000000',
            'operating_hours'  => '06.00 - 21.00 WITA',
            'meta_description' => 'Inta Waana Tour — sewa speedboat private charter & open trip (shared) Labuan Bajo menjelajahi Taman Nasional Komodo: Pulau Padar, Pink Beach, Manta Point, Taka Makasar, Komodo, dan sunset Pulau Kalong. Penawaran spesial harga terbaik.',
            // ---- Banner penawaran spesial (nonaktif default; aktifkan dari panel admin) ----
            'promo_active'     => '0',
            'promo_text_id'    => 'PENAWARAN SPESIAL — Harga terbaik untuk semua trip! Open Trip mulai Rp 1.100.000/orang, Private Charter mulai Rp 9.000.000. Kuota terbatas, pesan lebih awal.',
            'promo_text_en'    => 'SPECIAL OFFER — Best prices on every trip! Open Trip from Rp 1,100,000/person, Private Charter from Rp 9,000,000. Limited seats, book early.',
            'promo_url'        => 'trips',
        ];
        foreach ($settings as $k => $v) {
            $this->db->table('settings')->insert(['key' => $k, 'value' => $v, 'updated_at' => $now]);
        }

        // ---------------------------------------------------------------
        // Trips — 4 produk resmi (Private & Open Trip × Full Day & Sunset)
        // Harga `price` = harga publish (coret), `promo_price` = penawaran spesial.
        // ---------------------------------------------------------------
        $incImgsFullDay = ['assets/img/boat-bow.jpg', 'assets/img/gal-padar.jpg', 'assets/img/boat-cabin.jpg', 'assets/img/gal-manta.jpg'];
        $incImgsSunset  = ['assets/img/boat-aerial.jpg', 'assets/img/gal-sunset.jpg', 'assets/img/boat-deck.jpg', 'assets/img/gal-komodo.jpg'];

        $itinFullDayId = "Penjemputan dari hotel ke Marina Labuan Bajo\nTransfer menuju Pulau Padar\nPulau Padar (trekking & foto)\nPink Beach (berenang & snorkeling)\nPulau Komodo (trekking & lihat komodo)\nMakan siang di Taka Makasar (berenang & foto)\nManta Point (snorkeling bersama pari manta)\nPulau Siaba / Mawang (snorkeling)\nKembali ke Labuan Bajo";
        $itinFullDayEn = "Pick up from your hotel to Labuan Bajo Marina\nTransfer to Padar Island\nPadar Island (trekking & photo)\nPink Beach (swimming & snorkeling)\nKomodo Island (trekking & see the Komodo)\nLunch at Taka Makasar (swimming & photo)\nManta Point (snorkeling with manta rays)\nSiaba / Mawang Island (snorkeling)\nReturn to Labuan Bajo";

        $itinSunsetId  = "Penjemputan dari hotel ke Marina Waterfront\nPulau Kelor (trekking ringan, berenang & foto)\nPantai Menjerite (snorkeling)\nPulau Rinca (lihat komodo & foto)\nSunset di Pulau Kalong (ribuan kelelawar)\nKembali ke Labuan Bajo";
        $itinSunsetEn  = "Pick up from your hotel to Marina Waterfront\nKelor Island (light trekking, swimming & photo)\nMenjerite Beach (snorkeling)\nRinca Island (see Komodo & photo)\nSunset at Kalong Island (thousands of flying foxes)\nReturn to Labuan Bajo";

        $trips = [
            [
                'slug' => 'private-full-day-sailing', 'type' => 'private', 'is_featured' => 1, 'sort_order' => 1,
                'price' => 12500000, 'promo_price' => 11000000,
                'promo_label_id' => 'Penawaran Spesial', 'promo_label_en' => 'Special Offer',
                'price_note_id' => 'Harga 1–5 pax. Untuk 6–9 pax: Rp 13.500.000 → Rp 12.000.000.',
                'price_note_en' => 'Price for 1–5 pax. For 6–9 pax: Rp 13,500,000 → Rp 12,000,000.',
                'title_id' => 'Private Full Day Sailing Komodo', 'title_en' => 'Private Full Day Sailing Komodo',
                'duration_id' => '1 Hari (±9 jam)', 'duration_en' => '1 Day (±9 hours)',
                'capacity' => '1–9 tamu · private charter',
                'cover_image' => 'assets/img/trip-private-fullday.jpg',
                'summary_id' => 'Charter speedboat pribadi seharian penuh menjelajahi ikon Taman Nasional Komodo: Padar, Pink Beach, Komodo, Taka Makasar, hingga Manta Point.',
                'summary_en' => 'A full-day private speedboat charter to the icons of Komodo National Park: Padar, Pink Beach, Komodo, Taka Makasar, and Manta Point.',
                'description_id' => 'Nikmati kebebasan penuh trip pribadi bersama keluarga atau rombongan Anda. Speedboat ber-AC yang cepat dan nyaman, kru profesional, jadwal fleksibel, dan rute terbaik ke seluruh destinasi unggulan Komodo dalam satu hari. Your private journey, your unforgettable moments.',
                'description_en' => 'Enjoy the complete freedom of a private trip with your family or group. A fast, comfortable air-conditioned speedboat, professional crew, flexible schedule, and the best route to all of Komodo\'s highlight destinations in one day. Your private journey, your unforgettable moments.',
                'itinerary_id' => $itinFullDayId, 'itinerary_en' => $itinFullDayEn,
                'images' => $incImgsFullDay,
            ],
            [
                'slug' => 'private-sunset-trip', 'type' => 'sunset', 'is_featured' => 1, 'sort_order' => 2,
                'price' => 10500000, 'promo_price' => 9000000,
                'promo_label_id' => 'Penawaran Spesial', 'promo_label_en' => 'Special Offer',
                'price_note_id' => 'Harga 1–5 pax. Untuk 6–9 pax: Rp 11.500.000 → Rp 10.000.000.',
                'price_note_en' => 'Price for 1–5 pax. For 6–9 pax: Rp 11,500,000 → Rp 10,000,000.',
                'title_id' => 'Private Sunset Trip Labuan Bajo', 'title_en' => 'Private Sunset Trip Labuan Bajo',
                'duration_id' => '½ Hari Sore (±5 jam)', 'duration_en' => 'Half Day Afternoon (±5 hours)',
                'capacity' => '1–9 tamu · private charter',
                'cover_image' => 'assets/img/trip-private-sunset.jpg',
                'summary_id' => 'Trip sore pribadi menikmati golden hour di Pulau Kelor, Menjerite, Rinca, dan siluet ribuan kelelawar di Pulau Kalong.',
                'summary_en' => 'A private afternoon trip enjoying the golden hour at Kelor, Menjerite, Rinca, and the silhouette of thousands of bats at Kalong Island.',
                'description_id' => 'Enjoy the magic hour in paradise. Berlayar santai di sore hari menuju Pulau Kelor dan Pantai Menjerite, bertemu komodo di Pulau Rinca, lalu tutup hari dengan sunset memukau berlatar ribuan kelelawar yang terbang dari Pulau Kalong. Sempurna untuk pasangan dan momen spesial.',
                'description_en' => 'Enjoy the magic hour in paradise. A relaxed afternoon cruise to Kelor Island and Menjerite Beach, meeting the dragons at Rinca Island, then closing the day with a stunning sunset framed by thousands of bats flying out of Kalong Island. Perfect for couples and special moments.',
                'itinerary_id' => $itinSunsetId, 'itinerary_en' => $itinSunsetEn,
                'images' => $incImgsSunset,
            ],
            [
                'slug' => 'open-trip-full-day-sailing', 'type' => 'shared', 'is_featured' => 1, 'sort_order' => 3,
                'price' => 1450000, 'promo_price' => 1350000,
                'promo_label_id' => 'Penawaran Spesial', 'promo_label_en' => 'Special Offer',
                'price_note_id' => 'Harga per orang · open trip (gabung grup).',
                'price_note_en' => 'Price per person · open trip (shared group).',
                'title_id' => 'Open Trip Full Day Sailing Komodo', 'title_en' => 'Open Trip Full Day Sailing Komodo',
                'duration_id' => '1 Hari (±9 jam)', 'duration_en' => '1 Day (±9 hours)',
                'capacity' => 'Open trip (gabung grup) · per orang',
                'cover_image' => 'assets/img/trip-shared-fullday.jpg',
                'summary_id' => 'Pilihan hemat untuk solo traveler & pasangan. Gabung grup seru menjelajahi semua spot ikonik Komodo dalam sehari penuh.',
                'summary_en' => 'A budget-friendly option for solo travelers & couples. Join a fun group exploring all of Komodo\'s iconic spots in a full day.',
                'description_id' => 'Explore the wonders of Komodo in one unforgettable day. Berangkat bersama traveler dari berbagai penjuru dunia dengan harga terjangkau namun fasilitas tetap lengkap: speedboat ber-AC, makan siang, snorkeling, dan dokumentasi. Meet new people, create memories.',
                'description_en' => 'Explore the wonders of Komodo in one unforgettable day. Set sail with travelers from around the world at an affordable price yet with complete facilities: an air-conditioned speedboat, lunch, snorkeling, and documentation. Meet new people, create memories.',
                'itinerary_id' => $itinFullDayId, 'itinerary_en' => $itinFullDayEn,
                'images' => $incImgsFullDay,
            ],
            [
                'slug' => 'open-trip-sunset', 'type' => 'shared', 'is_featured' => 0, 'sort_order' => 4,
                'price' => 1250000, 'promo_price' => 1100000,
                'promo_label_id' => 'Penawaran Spesial', 'promo_label_en' => 'Special Offer',
                'price_note_id' => 'Harga per orang · open trip (gabung grup).',
                'price_note_en' => 'Price per person · open trip (shared group).',
                'title_id' => 'Open Trip Sunset Komodo', 'title_en' => 'Open Trip Sunset Komodo',
                'duration_id' => '½ Hari Sore (±5 jam)', 'duration_en' => 'Half Day Afternoon (±5 hours)',
                'capacity' => 'Open trip (gabung grup) · per orang',
                'cover_image' => 'assets/img/trip-shared-sunset.jpg',
                'summary_id' => 'Golden hour, unforgettable moments. Open trip sore hemat ke Pulau Kelor, Rinca, dan sunset Pulau Kalong.',
                'summary_en' => 'Golden hour, unforgettable moments. A budget afternoon open trip to Kelor, Rinca, and the Kalong Island sunset.',
                'description_id' => 'Rasakan keajaiban sore hari di Labuan Bajo bersama traveler baru. Berlayar ke Pulau Kelor dan Pantai Menjerite, bertemu komodo di Rinca, lalu menikmati sunset terbaik berlatar ribuan kelelawar di Pulau Kalong — semua dengan harga open trip yang ramah di kantong.',
                'description_en' => 'Feel the magic of the afternoon in Labuan Bajo with new travelers. Cruise to Kelor Island and Menjerite Beach, meet the dragons at Rinca, then enjoy the best sunset framed by thousands of bats at Kalong Island — all at a wallet-friendly open trip price.',
                'itinerary_id' => $itinSunsetId, 'itinerary_en' => $itinSunsetEn,
                'images' => $incImgsSunset,
            ],
        ];
        foreach ($trips as $tr) {
            $imgs = $tr['images'];
            unset($tr['images']);
            $tr['is_active']  = 1;
            $tr['created_at'] = $now;
            $tr['updated_at'] = $now;
            $this->db->table('trips')->insert($tr);
            $tripId = $this->db->insertID();

            array_unshift($imgs, $tr['cover_image']);
            foreach (array_values(array_unique($imgs)) as $i => $img) {
                $this->db->table('trip_images')->insert([
                    'trip_id' => $tripId, 'image_path' => $img, 'sort_order' => $i,
                ]);
            }
        }

        // ---------------------------------------------------------------
        // Galleries — foto asli Speedboat Inta Waana + destinasi Komodo
        // ---------------------------------------------------------------
        $gallery = [
            ['Speedboat Inta Waana di Perairan Komodo', 'assets/img/boat-turquoise.jpg', 'Armada'],
            ['Profil Speedboat Inta Waana', 'assets/img/boat-profile.jpg', 'Armada'],
            ['Tampak Udara Speedboat', 'assets/img/boat-aerial.jpg', 'Armada'],
            ['Geladak Haluan', 'assets/img/boat-bow.jpg', 'Armada'],
            ['Kabin Ber-AC yang Nyaman', 'assets/img/boat-cabin.jpg', 'Armada'],
            ['Geladak Buritan & Area Bersantai', 'assets/img/boat-deck.jpg', 'Armada'],
            ['Anjungan Kemudi', 'assets/img/boat-helm.jpg', 'Armada'],
            ['Bersandar di Pink Beach', 'assets/img/boat-pinkbeach.jpg', 'Destinasi'],
            ['Berlabuh di Pulau Komodo', 'assets/img/boat-island.jpg', 'Destinasi'],
            ['Pulau Padar', 'assets/img/gal-padar.jpg', 'Destinasi'],
            ['Sunset Labuan Bajo', 'assets/img/gal-sunset.jpg', 'Destinasi'],
            ['Manta Point', 'assets/img/gal-manta.jpg', 'Satwa'],
            ['Komodo', 'assets/img/gal-komodo.jpg', 'Satwa'],
            ['Snorkeling', 'assets/img/gal-snorkel.jpg', 'Aktivitas'],
        ];
        foreach ($gallery as $i => $g) {
            $this->db->table('galleries')->insert([
                'title' => $g[0], 'image_path' => $g[1], 'category' => $g[2],
                'sort_order' => $i, 'created_at' => $now,
            ]);
        }

        // ---------------------------------------------------------------
        // Articles
        // ---------------------------------------------------------------
        $articles = [
            [
                'slug' => 'itinerary-full-day-sailing-komodo',
                'title_id' => 'Itinerary Full Day Sailing Komodo dari Labuan Bajo',
                'title_en' => 'Full Day Sailing Komodo Itinerary from Labuan Bajo',
                'cover_image' => 'assets/img/trip-private-fullday.jpg',
                'excerpt_id' => 'Punya satu hari di Labuan Bajo? Inilah rute Full Day Sailing kami: Padar, Pink Beach, Komodo, Taka Makasar, hingga Manta Point.',
                'excerpt_en' => 'Only one day in Labuan Bajo? Here is our Full Day Sailing route: Padar, Pink Beach, Komodo, Taka Makasar, and Manta Point.',
                'content_id' => "<p>Labuan Bajo adalah gerbang menuju Taman Nasional Komodo. Dengan Speedboat Inta Waana yang cepat dan ber-AC, satu hari sudah cukup untuk menikmati spot-spot terbaiknya.</p><h3>Pagi: Pulau Padar</h3><p>Penjemputan dari hotel menuju Marina Labuan Bajo, lalu meluncur ke Pulau Padar untuk trekking ringan menyaksikan panorama tiga teluk yang ikonik.</p><h3>Siang: Pink Beach, Komodo & Taka Makasar</h3><p>Snorkeling di Pink Beach, bertemu komodo di habitat aslinya, lalu makan siang sambil berenang di gosong pasir Taka Makasar.</p><h3>Sore: Manta Point & Siaba</h3><p>Tutup hari dengan berenang bersama pari manta di Manta Point dan snorkeling di Pulau Siaba sebelum kembali ke Labuan Bajo.</p>",
                'content_en' => "<p>Labuan Bajo is the gateway to Komodo National Park. With the fast, air-conditioned Inta Waana Speedboat, one day is enough to enjoy its best spots.</p><h3>Morning: Padar Island</h3><p>Pick up from your hotel to Labuan Bajo Marina, then cruise to Padar Island for a light trek to the iconic three-bay panorama.</p><h3>Midday: Pink Beach, Komodo & Taka Makasar</h3><p>Snorkel at Pink Beach, meet the dragons in their natural habitat, then have lunch while swimming at the Taka Makasar sandbar.</p><h3>Afternoon: Manta Point & Siaba</h3><p>End the day swimming with manta rays at Manta Point and snorkeling at Siaba Island before returning to Labuan Bajo.</p>",
                'meta_description' => 'Rute itinerary Full Day Sailing Komodo dari Labuan Bajo: Padar, Pink Beach, Komodo, Taka Makasar, Manta Point, Siaba.',
            ],
            [
                'slug' => 'spesifikasi-legalitas-speedboat-inta-waana',
                'title_id' => 'Spesifikasi & Legalitas Speedboat Inta Waana',
                'title_en' => 'Inta Waana Speedboat Specifications & Legality',
                'cover_image' => 'assets/img/boat-profile.jpg',
                'excerpt_id' => 'Kenali armada kami: speedboat fiberglass 8,31 m bermesin ganda Suzuki 2×100 HP, ber-AC, lengkap dengan dokumen resmi KSOP Labuan Bajo.',
                'excerpt_en' => 'Meet our fleet: an 8.31 m fiberglass speedboat with twin Suzuki 2×100 HP engines, air-conditioned, with official KSOP Labuan Bajo documents.',
                'content_id' => "<p>Speedboat <strong>Inta Waana</strong> dirancang untuk perjalanan yang cepat, aman, dan nyaman di perairan Taman Nasional Komodo.</p><h3>Spesifikasi Kapal</h3><ul><li>Nama kapal: INTA WAANA (Tanda Pas Kecil NTT 10 No. 2191)</li><li>Jenis: Kapal Penumpang Wisata · Bahan: Fiberglass</li><li>Dimensi (P×L×D): 8,31 × 2,55 × 1,10 meter</li><li>Tonase: GT 6 / NT 2</li><li>Mesin: Suzuki 2 × 100 HP</li><li>Fasilitas: kabin ber-AC, toilet, area bersantai terbuka</li><li>Dibangun di Labuan Bajo, 2025–2026</li></ul><h3>Legalitas & Keselamatan</h3><p>Kapal telah terdaftar resmi pada Kantor Kesyahbandaran dan Otoritas Pelabuhan (KSOP) Kelas III Labuan Bajo dan berhak mengibarkan bendera Indonesia. Setiap perjalanan dilengkapi life jacket untuk seluruh tamu, alat snorkeling, dan kru profesional.</p>",
                'content_en' => "<p>The <strong>Inta Waana</strong> speedboat is built for fast, safe, and comfortable journeys across the waters of Komodo National Park.</p><h3>Vessel Specifications</h3><ul><li>Ship name: INTA WAANA (Registration NTT 10 No. 2191)</li><li>Type: Recreational passenger boat · Material: Fiberglass</li><li>Dimensions (L×W×D): 8.31 × 2.55 × 1.10 meters</li><li>Tonnage: GT 6 / NT 2</li><li>Engine: Suzuki 2 × 100 HP</li><li>Facilities: air-conditioned cabin, toilet, open lounge deck</li><li>Built in Labuan Bajo, 2025–2026</li></ul><h3>Legality & Safety</h3><p>The vessel is officially registered with the Harbormaster and Port Authority Office (KSOP) Class III Labuan Bajo and is entitled to fly the Indonesian flag. Every trip is equipped with life jackets for all guests, snorkeling gear, and a professional crew.</p>",
                'meta_description' => 'Spesifikasi Speedboat Inta Waana: fiberglass 8,31 m, mesin Suzuki 2×100 HP, ber-AC, legalitas resmi KSOP Labuan Bajo.',
            ],
            [
                'slug' => 'waktu-terbaik-mengunjungi-pink-beach',
                'title_id' => 'Waktu Terbaik Mengunjungi Pink Beach',
                'title_en' => 'The Best Time to Visit Pink Beach',
                'cover_image' => 'assets/img/gal-pinkbeach.jpg',
                'excerpt_id' => 'Agar warna pink pasirnya maksimal dan air jernih untuk snorkeling, perhatikan waktu kunjungan ini.',
                'excerpt_en' => 'For the most vivid pink sand and clear snorkeling water, mind these visiting times.',
                'content_id' => "<p>Pink Beach mendapatkan warnanya dari serpihan koral merah. Datanglah saat matahari cukup tinggi (09.00–11.00) agar warnanya terlihat maksimal.</p><p>Musim kemarau (April–November) menawarkan visibilitas air terbaik untuk snorkeling. Spot ini termasuk dalam rute Full Day Sailing kami.</p>",
                'content_en' => "<p>Pink Beach gets its color from red coral fragments. Come when the sun is high enough (09:00–11:00) for the most vivid color.</p><p>The dry season (April–November) offers the best water visibility for snorkeling. This spot is part of our Full Day Sailing route.</p>",
                'meta_description' => 'Tips waktu terbaik mengunjungi Pink Beach Komodo agar warna pasir dan snorkeling maksimal.',
            ],
            [
                'slug' => 'tips-snorkeling-manta-point',
                'title_id' => 'Tips Aman Snorkeling Bersama Manta di Manta Point',
                'title_en' => 'Safe Snorkeling Tips with Mantas at Manta Point',
                'cover_image' => 'assets/img/art-manta.jpg',
                'excerpt_id' => 'Berenang bersama manta raksasa adalah pengalaman seumur hidup. Ikuti tips ini agar aman dan berkesan.',
                'excerpt_en' => 'Swimming with giant mantas is a once-in-a-lifetime experience. Follow these tips to stay safe.',
                'content_id' => "<p>Jaga jarak minimal 3 meter dari manta dan jangan menyentuhnya. Gunakan fin dan jangan mengejar. Kru kami akan menunjukkan posisi terbaik untuk mengamati.</p>",
                'content_en' => "<p>Keep at least 3 meters away from the manta and never touch it. Use fins and don't chase. Our crew will show you the best position to observe.</p>",
                'meta_description' => 'Tips aman dan etika snorkeling bersama manta di Manta Point Komodo.',
            ],
            [
                'slug' => 'menikmati-sunset-pulau-kalong',
                'title_id' => 'Menikmati Sunset Terbaik di Pulau Kalong',
                'title_en' => 'Enjoying the Best Sunset at Kalong Island',
                'cover_image' => 'assets/img/art-sunset.jpg',
                'excerpt_id' => 'Pulau Kalong menyuguhkan sunset paling memukau di Labuan Bajo, lengkap dengan ribuan kelelawar yang terbang.',
                'excerpt_en' => 'Kalong Island serves the most stunning sunset in Labuan Bajo, complete with thousands of flying foxes.',
                'content_id' => "<p>Pulau Kalong adalah penutup sempurna untuk Sunset Trip kami. Saat senja, ribuan kelelawar (kalong) terbang keluar dari hutan bakau berlatar langit jingga keemasan — momen yang wajib diabadikan dari atas Speedboat Inta Waana.</p>",
                'content_en' => "<p>Kalong Island is the perfect finale to our Sunset Trip. At dusk, thousands of flying foxes emerge from the mangroves against a golden-orange sky — a moment worth capturing from aboard the Inta Waana Speedboat.</p>",
                'meta_description' => 'Spot dan tips menikmati sunset terbaik di Pulau Kalong, Labuan Bajo, dari atas speedboat.',
            ],
        ];
        foreach ($articles as $i => $a) {
            $a['author']       = 'Tim Inta Waana Tour';
            $a['is_published'] = 1;
            $a['published_at'] = date('Y-m-d H:i:s', strtotime("-{$i} days"));
            $a['created_at']   = $now;
            $a['updated_at']   = $now;
            $this->db->table('articles')->insert($a);
        }
    }
}
