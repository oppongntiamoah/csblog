<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateForumThreadsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'                 => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'forum_category_id'  => ['type' => 'INT', 'unsigned' => true],
            'user_id'            => ['type' => 'INT', 'unsigned' => true],
            'title'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'               => ['type' => 'VARCHAR', 'constraint' => 300, 'unique' => true],
            'views'              => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'is_pinned'          => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'is_locked'          => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('forum_category_id', 'forum_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('forum_threads');
    }

    public function down(): void
    {
        $this->forge->dropTable('forum_threads');
    }
}
