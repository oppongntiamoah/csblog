<?php

namespace App\Models;

use CodeIgniter\Model;

class AdModel extends Model
{
    protected $table      = 'ads';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'placement', 'code', 'active', 'sort_order'];

    protected $useTimestamps = true;

    public function getActive(string $placement): array
    {
        return $this->where('placement', $placement)->where('active', 1)->orderBy('sort_order', 'ASC')->findAll();
    }
}
