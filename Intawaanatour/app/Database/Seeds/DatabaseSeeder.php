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
            'address'          => 'Jln. Raya Golo Koe, RT 021/RW 004, Kel. Wae Kelambu, Kec. Komodo, Kab. Manggarai Barat, Nusa Tenggara Timur',
            'maps_embed'       => 'https://www.google.com/maps?q=Golo+Koe+Wae+Kelambu+Komodo+Manggarai+Barat&output=embed',
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
        // Galeri trip = foto destinasi asli (bahan GUEST INFORMATION).
        $incImgsFullDay = ['assets/img/gal-padar.jpg', 'assets/img/gal-pinkbeach.jpg', 'assets/img/gal-komodo.jpg', 'assets/img/gal-manta.jpg', 'assets/img/gal-snorkel.jpg'];
        $incImgsSunset  = ['assets/img/dest-kelor.jpg', 'assets/img/dest-kelor-2.jpg', 'assets/img/dest-menjerite.jpg', 'assets/img/dest-rinca.jpg', 'assets/img/dest-kalong.jpg', 'assets/img/dest-kalong-2.jpg'];

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
            // Foto asli tambahan (GALERY INTA WAANA SPEEDBOAT)
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
