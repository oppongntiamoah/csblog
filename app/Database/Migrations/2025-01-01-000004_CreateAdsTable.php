<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'placement'  => ['type' => 'ENUM', 'constraint' => ['header', 'sidebar', 'footer', 'inline'], 'default' => 'sidebar'],
            'code'       => ['type' => 'TEXT', 'null' => true],
            'active'     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('ads');
    }

    public function down(): void
    {
        $this->forge->dropTable('ads');
    }
}
