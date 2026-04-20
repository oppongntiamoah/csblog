<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table      = 'posts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'category_id', 'code', 'title', 'slug',
        'content', 'hl', 'sort_order',
        'seo_title', 'seo_description', 'seo_keywords',
    ];

    protected $useTimestamps = true;

    /**
     * Return objectives for a given category slug, joining category table.
     */
    public function getObjectivesByCategory(string $categorySlug): array
    {
        return $this->db->table('posts p')
            ->select('p.id, p.code, p.title, p.slug, p.hl, p.sort_order')
            ->join('categories c', 'c.id = p.category_id')
            ->where('c.slug', $categorySlug)
            ->orderBy('p.sort_order', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Return a single post with its category name and slug.
     */
    public function getPostWithCategory(string $slug): ?array
    {
        return $this->db->table('posts p')
            ->select('p.*, c.name as category, c.slug as category_slug')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.slug', $slug)
            ->get()
            ->getRowArray();
    }
}
