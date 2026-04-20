<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSeoFieldsToPosts extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('posts', [
            'seo_title'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'content'],
            'seo_description' => ['type' => 'VARCHAR', 'constraint' => 320, 'null' => true, 'after' => 'seo_title'],
            'seo_keywords'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'seo_description'],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('posts', ['seo_title', 'seo_description', 'seo_keywords']);
    }
}
