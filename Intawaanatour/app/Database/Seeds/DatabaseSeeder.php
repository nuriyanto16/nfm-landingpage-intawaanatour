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
        // Settings
        // ---------------------------------------------------------------
        $settings = [
            'site_name'        => 'Intawaanatour',
            'site_tagline_id'  => 'Speedboat Premium Labuan Bajo',
            'site_tagline_en'  => 'Premium Speedboat Labuan Bajo',
            'phone'            => '+62 812-3456-7890',
            'whatsapp'         => '6281234567890',
            'email'            => 'hello@intawaanatour.com',
            'instagram'        => 'https://instagram.com/intawaanatour',
            'facebook'         => 'https://facebook.com/intawaanatour',
            'tiktok'           => '',
            'address'          => 'Jl. Soekarno Hatta, Labuan Bajo, Manggarai Barat, Nusa Tenggara Timur 86554',
            'maps_embed'       => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.0!2d119.8807!3d-8.4894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zTGFidWFuIEJham8!5e0!3m2!1sen!2sid!4v1700000000000',
            'operating_hours'  => '06:00 - 22:00 WITA',
            'meta_description' => 'Intawaanatour menyediakan sewa speedboat private & shared trip Labuan Bajo untuk menjelajahi Taman Nasional Komodo: Pulau Padar, Pink Beach, Manta Point, dan sunset terbaik.',
        ];
        foreach ($settings as $k => $v) {
            $this->db->table('settings')->insert(['key' => $k, 'value' => $v, 'updated_at' => $now]);
        }

        // ---------------------------------------------------------------
        // Trips
        // ---------------------------------------------------------------
        $trips = [
            [
                'slug' => 'private-day-trip-komodo', 'type' => 'private', 'is_featured' => 1, 'sort_order' => 1,
                'price' => 3500000,
                'title_id' => 'Private Day Trip Komodo', 'title_en' => 'Private Day Trip Komodo',
                'duration_id' => '1 Hari (±10 jam)', 'duration_en' => '1 Day (±10 hours)',
                'capacity' => 'Maks 12 tamu',
                'cover_image' => 'assets/img/trip-padar.jpg',
                'summary_id' => 'Jelajahi ikon Taman Nasional Komodo dalam sehari penuh dengan speedboat pribadi yang cepat dan nyaman.',
                'summary_en' => 'Explore the icons of Komodo National Park in a full day aboard a fast, comfortable private speedboat.',
                'description_id' => 'Nikmati kebebasan trip pribadi: jadwal fleksibel, kru profesional, dan rute terbaik menuju Pulau Padar, Pink Beach, hingga Manta Point. Cocok untuk keluarga maupun rombongan kecil yang ingin pengalaman eksklusif tanpa terburu-buru.',
                'description_en' => 'Enjoy the freedom of a private trip: flexible schedule, professional crew, and the best route to Padar Island, Pink Beach and Manta Point. Perfect for families or small groups seeking an exclusive, unhurried experience.',
                'itinerary_id' => "06.00 Penjemputan di Pelabuhan Labuan Bajo\n07.30 Trekking Pulau Padar\n09.30 Pink Beach (snorkeling)\n11.30 Pulau Komodo / Rinca (komodo)\n13.30 Manta Point\n15.00 Taka Makassar & Pulau Kanawa\n17.00 Kembali ke pelabuhan",
                'itinerary_en' => "06:00 Pickup at Labuan Bajo Harbor\n07:30 Padar Island trekking\n09:30 Pink Beach (snorkeling)\n11:30 Komodo / Rinca Island (dragons)\n13:30 Manta Point\n15:00 Taka Makassar & Kanawa Island\n17:00 Back to harbor",
            ],
            [
                'slug' => 'shared-trip-komodo', 'type' => 'shared', 'is_featured' => 1, 'sort_order' => 2,
                'price' => 750000,
                'title_id' => 'Shared Trip Komodo', 'title_en' => 'Shared Trip Komodo',
                'duration_id' => '1 Hari (±10 jam)', 'duration_en' => '1 Day (±10 hours)',
                'capacity' => 'Gabung grup (per orang)',
                'cover_image' => 'assets/img/trip-pinkbeach.jpg',
                'summary_id' => 'Pilihan hemat untuk solo traveler & pasangan. Berbagi keseruan dengan traveler lain ke spot terbaik Komodo.',
                'summary_en' => 'A budget-friendly option for solo travelers & couples. Share the adventure with fellow travelers to Komodo\'s best spots.',
                'description_id' => 'Berangkat bersama traveler dari berbagai penjuru dunia. Harga terjangkau, fasilitas lengkap, dan tetap mengunjungi destinasi unggulan. Pilihan tepat untuk pengalaman seru dengan bujet ramah.',
                'description_en' => 'Set sail with travelers from around the world. Affordable pricing, complete facilities, and still visiting the highlight destinations. The right choice for a fun experience on a friendly budget.',
                'itinerary_id' => "05.45 Berkumpul di pelabuhan\n07.30 Pulau Padar\n09.30 Pink Beach\n11.30 Pulau Komodo\n13.30 Manta Point\n15.00 Kanawa\n17.00 Selesai",
                'itinerary_en' => "05:45 Meet at the harbor\n07:30 Padar Island\n09:30 Pink Beach\n11:30 Komodo Island\n13:30 Manta Point\n15:00 Kanawa\n17:00 Finish",
            ],
            [
                'slug' => 'sunset-trip-labuan-bajo', 'type' => 'sunset', 'is_featured' => 1, 'sort_order' => 3,
                'price' => 1500000,
                'title_id' => 'Sunset Trip Labuan Bajo', 'title_en' => 'Labuan Bajo Sunset Trip',
                'duration_id' => '½ Hari (±4 jam)', 'duration_en' => 'Half Day (±4 hours)',
                'capacity' => 'Maks 10 tamu',
                'cover_image' => 'assets/img/trip-sunset.jpg',
                'summary_id' => 'Saksikan matahari terbenam paling memukau di perairan Labuan Bajo dari atas speedboat eksklusif.',
                'summary_en' => 'Witness the most stunning sunset over Labuan Bajo waters from an exclusive speedboat.',
                'description_id' => 'Trip sore yang romantis menuju Pulau Kelor dan Kalong. Nikmati siluet ribuan kelelawar terbang serta langit jingga keemasan. Sempurna untuk pasangan dan momen spesial.',
                'description_en' => 'A romantic afternoon trip to Kelor and Kalong Islands. Enjoy the silhouette of thousands of flying foxes and a golden-orange sky. Perfect for couples and special moments.',
                'itinerary_id' => "15.00 Berangkat dari pelabuhan\n15.45 Pulau Kelor\n17.00 Pulau Kalong (sunset & kelelawar)\n18.30 Kembali ke pelabuhan",
                'itinerary_en' => "15:00 Depart from harbor\n15:45 Kelor Island\n17:00 Kalong Island (sunset & bats)\n18:30 Back to harbor",
            ],
            [
                'slug' => 'private-overnight-2d1n', 'type' => 'private', 'is_featured' => 0, 'sort_order' => 4,
                'price' => 7500000,
                'title_id' => 'Private Overnight 2H1M', 'title_en' => 'Private Overnight 2D1N',
                'duration_id' => '2 Hari 1 Malam', 'duration_en' => '2 Days 1 Night',
                'capacity' => 'Maks 12 tamu',
                'cover_image' => 'assets/img/trip-kanawa.jpg',
                'summary_id' => 'Eksplor lebih jauh dengan menginap. Lebih banyak pulau, lebih santai, pengalaman tak terlupakan.',
                'summary_en' => 'Explore further with an overnight stay. More islands, more relaxed, an unforgettable experience.',
                'description_id' => 'Dua hari penuh menjelajahi destinasi tersembunyi Komodo dengan ritme santai. Termasuk spot snorkeling premium dan sunrise di tengah laut.',
                'description_en' => 'Two full days exploring Komodo\'s hidden gems at a relaxed pace. Includes premium snorkeling spots and sunrise in the middle of the sea.',
                'itinerary_id' => "Hari 1: Padar, Pink Beach, Komodo, menginap di kapal\nHari 2: Manta Point, Taka Makassar, Kanawa, kembali",
                'itinerary_en' => "Day 1: Padar, Pink Beach, Komodo, overnight on boat\nDay 2: Manta Point, Taka Makassar, Kanawa, return",
            ],
            [
                'slug' => 'shared-trip-3d2n', 'type' => 'shared', 'is_featured' => 0, 'sort_order' => 5,
                'price' => 2750000,
                'title_id' => 'Shared Trip 3H2M Sailing', 'title_en' => 'Shared Sailing 3D2N',
                'duration_id' => '3 Hari 2 Malam', 'duration_en' => '3 Days 2 Nights',
                'capacity' => 'Gabung grup (per orang)',
                'cover_image' => 'assets/img/trip-taka.jpg',
                'summary_id' => 'Petualangan sailing lengkap menjelajahi Komodo selama tiga hari bersama traveler seru lainnya.',
                'summary_en' => 'A complete three-day sailing adventure across Komodo with other fun travelers.',
                'description_id' => 'Paket terlengkap untuk yang ingin menyelami keindahan Komodo secara menyeluruh. Semua spot ikonik plus destinasi tersembunyi.',
                'description_en' => 'The most complete package for those wanting to fully immerse in Komodo\'s beauty. All iconic spots plus hidden destinations.',
                'itinerary_id' => "Hari 1: Kelor, Kalong, Rinca\nHari 2: Padar, Pink Beach, Komodo\nHari 3: Manta Point, Kanawa, kembali",
                'itinerary_en' => "Day 1: Kelor, Kalong, Rinca\nDay 2: Padar, Pink Beach, Komodo\nDay 3: Manta Point, Kanawa, return",
            ],
            [
                'slug' => 'private-fishing-charter', 'type' => 'private', 'is_featured' => 0, 'sort_order' => 6,
                'price' => 4500000,
                'title_id' => 'Private Fishing Charter', 'title_en' => 'Private Fishing Charter',
                'duration_id' => '1 Hari (±8 jam)', 'duration_en' => '1 Day (±8 hours)',
                'capacity' => 'Maks 8 tamu',
                'cover_image' => 'assets/img/trip-boat.jpg',
                'summary_id' => 'Mancing di perairan kaya ikan Labuan Bajo dengan speedboat dan peralatan lengkap.',
                'summary_en' => 'Fishing in the fish-rich waters of Labuan Bajo with a speedboat and complete gear.',
                'description_id' => 'Untuk pecinta mancing, kami siapkan spot terbaik, peralatan, dan kru berpengalaman. Hasil tangkapan bisa dibakar di atas kapal.',
                'description_en' => 'For fishing lovers, we prepare the best spots, gear, and experienced crew. Your catch can be grilled on board.',
                'itinerary_id' => "06.00 Berangkat\n07.00 Spot mancing utama\n12.00 BBQ di kapal\n14.00 Snorkeling\n16.00 Kembali",
                'itinerary_en' => "06:00 Depart\n07:00 Main fishing spot\n12:00 BBQ on board\n14:00 Snorkeling\n16:00 Return",
            ],
        ];
        foreach ($trips as $tr) {
            $tr['is_active']  = 1;
            $tr['created_at'] = $now;
            $tr['updated_at'] = $now;
            $this->db->table('trips')->insert($tr);
            $tripId = $this->db->insertID();

            $imgs = [$tr['cover_image'], 'assets/img/gal-manta.jpg', 'assets/img/gal-komodo.jpg'];
            foreach ($imgs as $i => $img) {
                $this->db->table('trip_images')->insert([
                    'trip_id' => $tripId, 'image_path' => $img, 'sort_order' => $i,
                ]);
            }
        }

        // ---------------------------------------------------------------
        // Galleries
        // ---------------------------------------------------------------
        $gallery = [
            ['Pulau Padar', 'assets/img/gal-padar.jpg', 'Destinasi'],
            ['Pink Beach', 'assets/img/gal-pinkbeach.jpg', 'Destinasi'],
            ['Komodo', 'assets/img/gal-komodo.jpg', 'Satwa'],
            ['Manta Point', 'assets/img/gal-manta.jpg', 'Satwa'],
            ['Sunset Labuan Bajo', 'assets/img/gal-sunset.jpg', 'Destinasi'],
            ['Pulau Kelor', 'assets/img/gal-kelor.jpg', 'Destinasi'],
            ['Pulau Kanawa', 'assets/img/gal-kanawa.jpg', 'Destinasi'],
            ['Taka Makassar', 'assets/img/gal-taka.jpg', 'Destinasi'],
            ['Armada Speedboat', 'assets/img/gal-boat.jpg', 'Armada'],
            ['Kabin Nyaman', 'assets/img/gal-boat2.jpg', 'Armada'],
            ['Snorkeling', 'assets/img/gal-snorkel.jpg', 'Aktivitas'],
            ['Pelabuhan Labuan Bajo', 'assets/img/gal-harbor.jpg', 'Destinasi'],
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
                'slug' => 'itinerary-terbaik-1-hari-komodo',
                'title_id' => 'Itinerary Terbaik 1 Hari di Taman Nasional Komodo',
                'title_en' => 'The Best 1-Day Itinerary in Komodo National Park',
                'cover_image' => 'assets/img/art-itinerary.jpg',
                'excerpt_id' => 'Punya waktu sehari di Labuan Bajo? Inilah rute paling efisien untuk menikmati semua ikon Komodo.',
                'excerpt_en' => 'Only one day in Labuan Bajo? Here is the most efficient route to enjoy all of Komodo\'s icons.',
                'content_id' => "<p>Labuan Bajo adalah gerbang menuju Taman Nasional Komodo. Dengan speedboat cepat, satu hari sudah cukup untuk menikmati spot-spot terbaik.</p><h3>Pagi: Pulau Padar</h3><p>Mulailah pagi dengan trekking ringan ke puncak Pulau Padar untuk pemandangan tiga teluk yang ikonik.</p><h3>Siang: Pink Beach & Komodo</h3><p>Lanjutkan ke Pink Beach untuk snorkeling, lalu temui komodo di habitat aslinya.</p><h3>Sore: Manta Point & Kanawa</h3><p>Tutup hari dengan berenang bersama manta dan bersantai di Pulau Kanawa.</p>",
                'content_en' => "<p>Labuan Bajo is the gateway to Komodo National Park. With a fast speedboat, one day is enough to enjoy the best spots.</p><h3>Morning: Padar Island</h3><p>Start the morning with a light trek to the top of Padar Island for the iconic three-bay view.</p><h3>Midday: Pink Beach & Komodo</h3><p>Continue to Pink Beach for snorkeling, then meet the dragons in their natural habitat.</p><h3>Afternoon: Manta Point & Kanawa</h3><p>End the day swimming with mantas and relaxing on Kanawa Island.</p>",
                'meta_description' => 'Rute itinerary 1 hari terbaik di Taman Nasional Komodo dari Labuan Bajo: Padar, Pink Beach, Komodo, Manta Point.',
            ],
            [
                'slug' => 'waktu-terbaik-mengunjungi-pink-beach',
                'title_id' => 'Waktu Terbaik Mengunjungi Pink Beach',
                'title_en' => 'The Best Time to Visit Pink Beach',
                'cover_image' => 'assets/img/art-pinkbeach.jpg',
                'excerpt_id' => 'Agar warna pink pasirnya maksimal dan air jernih untuk snorkeling, perhatikan waktu kunjungan ini.',
                'excerpt_en' => 'For the most vivid pink sand and clear snorkeling water, mind these visiting times.',
                'content_id' => "<p>Pink Beach mendapatkan warnanya dari serpihan koral merah. Datanglah saat matahari cukup tinggi (09.00–11.00) agar warnanya terlihat maksimal.</p><p>Musim kemarau (April–November) menawarkan visibilitas air terbaik untuk snorkeling.</p>",
                'content_en' => "<p>Pink Beach gets its color from red coral fragments. Come when the sun is high enough (09:00–11:00) for the most vivid color.</p><p>The dry season (April–November) offers the best water visibility for snorkeling.</p>",
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
                'slug' => 'menikmati-sunset-labuan-bajo',
                'title_id' => 'Cara Menikmati Sunset Terbaik di Labuan Bajo',
                'title_en' => 'How to Enjoy the Best Sunset in Labuan Bajo',
                'cover_image' => 'assets/img/art-sunset.jpg',
                'excerpt_id' => 'Labuan Bajo terkenal dengan sunset-nya yang memukau. Inilah spot dan cara terbaik menikmatinya.',
                'excerpt_en' => 'Labuan Bajo is famous for its stunning sunsets. Here are the best spots and ways to enjoy them.',
                'content_id' => "<p>Pulau Kalong dan Pulau Kelor adalah lokasi favorit untuk sunset. Dari atas speedboat, Anda bisa menyaksikan ribuan kelelawar terbang berlatar langit jingga.</p>",
                'content_en' => "<p>Kalong Island and Kelor Island are favorite sunset spots. From a speedboat, you can watch thousands of bats fly against an orange sky.</p>",
                'meta_description' => 'Spot dan tips menikmati sunset terbaik di Labuan Bajo dari atas speedboat.',
            ],
        ];
        foreach ($articles as $i => $a) {
            $a['author']       = 'Tim Intawaanatour';
            $a['is_published'] = 1;
            $a['published_at'] = date('Y-m-d H:i:s', strtotime("-{$i} days"));
            $a['created_at']   = $now;
            $a['updated_at']   = $now;
            $this->db->table('articles')->insert($a);
        }

        // ---------------------------------------------------------------
        // Sample bookings
        // ---------------------------------------------------------------
        $this->db->table('bookings')->insert([
            'name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081200000001',
            'trip_id' => 1, 'trip_date' => date('Y-m-d', strtotime('+7 days')), 'pax' => 4,
            'message' => 'Mohon info paket private day trip untuk keluarga.', 'status' => 'new',
            'created_at' => $now,
        ]);
    }
}
