<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'google_id'  => ['type' => 'VARCHAR', 'constraint' => 64, 'unique' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 160],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'avatar'     => ['type' => 'VARCHAR', 'constraint' => 512, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down(): void
    {
        $this->forge->dropTable('users');
    }
}
