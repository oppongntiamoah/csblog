<?php

namespace App\Models;

use CodeIgniter\Model;

class ForumCategoryModel extends Model
{
    protected $table      = 'forum_categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'slug', 'description', 'sort_order'];

    protected $useTimestamps = true;

    public function getCategoriesWithStats(): array
    {
        return $this->db->table('forum_categories fc')
            ->select('fc.*,
                      COUNT(DISTINCT t.id)    AS thread_count,
                      COUNT(DISTINCT p.id)    AS post_count,
                      MAX(p.created_at)       AS last_activity_at,
                      last_u.name             AS last_author_name')
            ->join('forum_threads t',  't.forum_category_id = fc.id',          'left')
            ->join('forum_posts p',    'p.thread_id = t.id',                   'left')
            ->join('users last_u',     'last_u.id = p.user_id',                'left')
            ->groupBy('fc.id, last_u.name')
            ->orderBy('fc.sort_order', 'ASC')
            ->get()
            ->getResultArray();
    }
}
