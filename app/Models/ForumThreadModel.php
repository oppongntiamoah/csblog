<?php

namespace App\Models;

use CodeIgniter\Model;

class ForumThreadModel extends Model
{
    protected $table      = 'forum_threads';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'forum_category_id', 'user_id', 'title', 'slug',
        'views', 'is_pinned', 'is_locked',
    ];

    protected $useTimestamps = true;

    public function getThreadsForCategory(int $catId): array
    {
        return $this->db->table('forum_threads t')
            ->select('t.*,
                      u.name             AS author_name,
                      u.avatar           AS author_avatar,
                      COUNT(p.id)        AS reply_count,
                      MAX(p.created_at)  AS last_reply_at,
                      last_u.name        AS last_reply_author')
            ->join('users u',         'u.id = t.user_id')
            ->join('forum_posts p',   'p.thread_id = t.id', 'left')
            ->join('users last_u',    'last_u.id = p.user_id', 'left')
            ->where('t.forum_category_id', $catId)
            ->groupBy('t.id, u.name, u.avatar, last_u.name')
            ->orderBy('t.is_pinned', 'DESC')
            ->orderBy('last_reply_at',  'DESC')
            ->orderBy('t.created_at',   'DESC')
            ->get()
            ->getResultArray();
    }

    public function getThreadWithMeta(int $id): ?array
    {
        return $this->db->table('forum_threads t')
            ->select('t.*,
                      u.name               AS author_name,
                      u.avatar             AS author_avatar,
                      fc.name              AS category_name,
                      fc.slug              AS category_slug')
            ->join('users u',             'u.id = t.user_id')
            ->join('forum_categories fc', 'fc.id = t.forum_category_id')
            ->where('t.id', $id)
            ->get()
            ->getRowArray();
    }

    public function makeUniqueSlug(string $title): string
    {
        $base = url_title($title, '-', true);
        $slug = $base;
        $n    = 1;
        while ($this->where('slug', $slug)->first()) {
            $slug = $base . '-' . $n++;
        }
        return $slug;
    }
}
