<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTripPromoFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('trips', [
            // Harga penawaran spesial (lebih murah dari `price` yang jadi harga coret)
            'promo_price'    => ['type' => 'DECIMAL', 'constraint' => '12,2', 'null' => true, 'after' => 'price'],
            'promo_label_id' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'promo_price'],
            'promo_label_en' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'promo_label_id'],
            // Catatan harga (mis. tier "6–9 pax") yang tampil di bawah harga utama
            'price_note_id'  => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true, 'after' => 'promo_label_en'],
            'price_note_en'  => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true, 'after' => 'price_note_id'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('trips', [
            'promo_price', 'promo_label_id', 'promo_label_en', 'price_note_id', 'price_note_en',
        ]);
    }
}
