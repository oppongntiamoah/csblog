<?php

namespace App\Models;

use CodeIgniter\Model;

class ForumPostModel extends Model
{
    protected $table      = 'forum_posts';
    protected $primaryKey = 'id';

    protected $allowedFields = ['thread_id', 'user_id', 'body'];

    protected $useTimestamps = true;

    public function getPostsForThread(int $threadId): array
    {
        return $this->db->table('forum_posts p')
            ->select('p.*, u.name AS author_name, u.avatar AS author_avatar, u.created_at AS user_joined')
            ->join('users u', 'u.id = p.user_id')
            ->where('p.thread_id', $threadId)
            ->orderBy('p.created_at', 'ASC')
            ->get()
            ->getResultArray();
    }
}
