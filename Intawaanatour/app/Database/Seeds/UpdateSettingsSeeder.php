<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder non-destruktif untuk MEMPERBARUI nilai pengaturan tertentu
 * (mis. alamat resmi) tanpa menyentuh data lain. Aman dijalankan ulang.
 * Jalankan: php spark db:seed UpdateSettingsSeeder
 */
class UpdateSettingsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $updates = [
            'address'    => 'Jln. Raya Golo Koe, RT 021/RW 004, Kel. Wae Kelambu, Kec. Komodo, Kab. Manggarai Barat, Nusa Tenggara Timur',
            'maps_embed' => 'https://www.google.com/maps?q=Golo+Koe+Wae+Kelambu+Komodo+Manggarai+Barat&output=embed',
        ];

        foreach ($updates as $key => $value) {
            $exists = $this->db->table('settings')->where('key', $key)->countAllResults();
            if ($exists) {
                $this->db->table('settings')->where('key', $key)->update(['value' => $value, 'updated_at' => $now]);
            } else {
                $this->db->table('settings')->insert(['key' => $key, 'value' => $value, 'updated_at' => $now]);
            }
        }
    }
}
