<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'General Discussion',
                'slug'        => 'general',
                'description' => 'General conversation about IB Computer Science, study tips, and resources.',
                'sort_order'  => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Help & Questions',
                'slug'        => 'help',
                'description' => 'Stuck on a concept? Post your questions here and get help from the community.',
                'sort_order'  => 2,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Internal Assessment (IA)',
                'slug'        => 'ia-discussion',
                'description' => 'Discuss IA ideas, get feedback on your product design, and share resources.',
                'sort_order'  => 3,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Exam Preparation',
                'slug'        => 'exam-prep',
                'description' => 'Past paper discussions, exam technique tips, and revision resources.',
                'sort_order'  => 4,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('forum_categories')->ignore(true)->insertBatch($categories);
    }
}
