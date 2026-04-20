<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CsBlogSeeder extends Seeder
{
    public function run(): void
    {
        // ── Categories ───────────────────────────────────────────────────────
        $categories = [
            [
                'name'        => 'Computer Fundamentals',
                'slug'        => 'computer-fundamentals',
                'theme'       => 'A',
                'icon'        => 'cpu',
                'sort_order'  => 1,
                'description' => 'This category provides a foundation in the essential components and operation of computer systems. Topics include hardware architecture, the function of the CPU, GPU, machine instruction cycles, and memory types. Students will also examine system software, including operating systems. This knowledge underpins all higher-level computing concepts and supports critical analysis of how computers process and manage data.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Networking',
                'slug'        => 'networking',
                'theme'       => 'A',
                'icon'        => 'diagram-3',
                'sort_order'  => 2,
                'description' => 'Explore network architectures, protocols, and the infrastructure that connects computers and devices globally.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Databases',
                'slug'        => 'databases',
                'theme'       => 'A',
                'icon'        => 'database',
                'sort_order'  => 3,
                'description' => 'Study relational databases, SQL, data modelling, and the management of large datasets.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Machine Learning',
                'slug'        => 'machine-learning',
                'theme'       => 'A',
                'icon'        => 'robot',
                'sort_order'  => 4,
                'description' => 'An introduction to machine learning concepts, algorithms, and their applications in computing.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Approaches to Computational Thinking',
                'slug'        => 'computational-thinking',
                'theme'       => 'B',
                'icon'        => 'lightbulb',
                'sort_order'  => 5,
                'description' => 'Develop problem-solving skills using decomposition, pattern recognition, abstraction, and algorithm design.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Programming',
                'slug'        => 'programming',
                'theme'       => 'B',
                'icon'        => 'code-slash',
                'sort_order'  => 6,
                'description' => 'Learn programming constructs, logic, and the development of algorithms using pseudocode and real languages.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'OOP',
                'slug'        => 'oop',
                'theme'       => 'B',
                'icon'        => 'boxes',
                'sort_order'  => 7,
                'description' => 'Object-oriented programming: classes, objects, inheritance, encapsulation, and polymorphism.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Abstract Data Types',
                'slug'        => 'abstract-data-types',
                'theme'       => 'B',
                'icon'        => 'stack',
                'sort_order'  => 8,
                'description' => 'Study stacks, queues, linked lists, trees, graphs, and other fundamental data structures.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Case Study',
                'slug'        => 'case-study',
                'theme'       => 'other',
                'icon'        => 'folder',
                'sort_order'  => 9,
                'description' => 'Resources and discussion topics for the IB CS case study component.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Internal Assessment (IA)',
                'slug'        => 'internal-assessment',
                'theme'       => 'other',
                'icon'        => 'journal-bookmark',
                'sort_order'  => 10,
                'description' => 'Guides, exemplars, and criteria explanations for the IB Computer Science Internal Assessment 2027.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('categories')->insertBatch($categories);

        // ── Get category IDs ─────────────────────────────────────────────────
        $catMap = [];
        $rows   = $this->db->table('categories')->get()->getResultArray();
        foreach ($rows as $row) {
            $catMap[$row['slug']] = (int) $row['id'];
        }

        // ── Posts (objectives) ───────────────────────────────────────────────
        $cf = $catMap['computer-fundamentals'];

        $posts = [
            // A1.1 – CPU & GPU
            [$cf,'A1.1.1','Describe the functions and interactions of the main CPU components',0,1],
            [$cf,'A1.1.2','Describe the role of a GPU',0,2],
            [$cf,'A1.1.3','Explain the differences between the CPU and the GPU',1,3],
            [$cf,'A1.1.4','Explain the purposes of different types of primary memory',0,4],
            [$cf,'A1.1.5','Describe the fetch, decode and execute cycle',0,5],
            [$cf,'A1.1.6','Describe the process of pipelining in multi-core architectures',1,6],
            [$cf,'A1.1.7','Describe internal and external types of secondary memory storage',0,7],
            [$cf,'A1.1.8','Describe the concept of compression',0,8],
            [$cf,'A1.1.9','Describe the different types of services in cloud computing',0,9],
            // A1.2 – Data representation
            [$cf,'A1.2.1','Describe the principal methods of representing data',0,10],
            [$cf,'A1.2.2','Explain how binary is used to store data',0,11],
            [$cf,'A1.2.3','Describe the purpose and use of logic gates',0,12],
        ];

        $insertData = [];
        foreach ($posts as [$catId, $code, $title, $hl, $order]) {
            $insertData[] = [
                'category_id' => $catId,
                'code'        => $code,
                'title'       => $title,
                'slug'        => url_title($code . '-' . $title, '-', true),
                'content'     => '<p>Detailed content for <strong>' . esc($code) . ' ' . esc($title) . '</strong> is coming soon. Check back for full notes, diagrams, and worked examples.</p>',
                'hl'          => $hl,
                'sort_order'  => $order,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('posts')->insertBatch($insertData);
    }
}
