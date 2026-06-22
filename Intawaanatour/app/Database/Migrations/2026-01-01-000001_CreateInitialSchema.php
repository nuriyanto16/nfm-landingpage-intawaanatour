<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialSchema extends Migration
{
    public function up()
    {
        // ---- users (admin) ----
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 150],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'          => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'admin'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users', true);

        // ---- settings (key-value) ----
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'key'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'value'      => ['type' => 'TEXT', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('key');
        $this->forge->createTable('settings', true);

        // ---- trips ----
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 180],
            'type'           => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'private'],
            'title_id'       => ['type' => 'VARCHAR', 'constraint' => 200],
            'title_en'       => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'price'          => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'duration_id'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'duration_en'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'capacity'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'summary_id'     => ['type' => 'TEXT', 'null' => true],
            'summary_en'     => ['type' => 'TEXT', 'null' => true],
            'description_id' => ['type' => 'TEXT', 'null' => true],
            'description_en' => ['type' => 'TEXT', 'null' => true],
            'itinerary_id'   => ['type' => 'TEXT', 'null' => true],
            'itinerary_en'   => ['type' => 'TEXT', 'null' => true],
            'cover_image'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_featured'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'is_active'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order'     => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('trips', true);

        // ---- trip_images ----
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'trip_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'sort_order' => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('trip_id');
        $this->forge->createTable('trip_images', true);

        // ---- galleries ----
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'category'   => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('galleries', true);

        // ---- articles ----
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 200],
            'title_id'         => ['type' => 'VARCHAR', 'constraint' => 220],
            'title_en'         => ['type' => 'VARCHAR', 'constraint' => 220, 'null' => true],
            'excerpt_id'       => ['type' => 'TEXT', 'null' => true],
            'excerpt_en'       => ['type' => 'TEXT', 'null' => true],
            'content_id'       => ['type' => 'LONGTEXT', 'null' => true],
            'content_en'       => ['type' => 'LONGTEXT', 'null' => true],
            'cover_image'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'author'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'meta_description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_published'     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'published_at'     => ['type' => 'DATETIME', 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('articles', true);

        // ---- bookings ----
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 120],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'phone'      => ['type' => 'VARCHAR', 'constraint' => 40],
            'trip_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'trip_date'  => ['type' => 'DATE', 'null' => true],
            'pax'        => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            'message'    => ['type' => 'TEXT', 'null' => true],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'new'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bookings', true);
    }

    public function down()
    {
        $this->forge->dropTable('bookings', true);
        $this->forge->dropTable('articles', true);
        $this->forge->dropTable('galleries', true);
        $this->forge->dropTable('trip_images', true);
        $this->forge->dropTable('trips', true);
        $this->forge->dropTable('settings', true);
        $this->forge->dropTable('users', true);
    }
}
