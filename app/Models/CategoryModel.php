<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'slug', 'theme', 'description', 'icon', 'sort_order',
    ];

    protected $useTimestamps = true;

    /**
     * Returns the theme-based code for a category (A1, A2, B1, B3…).
     * Categories in 'other' theme return an empty string.
     */
    public function computeCode(array $category): string
    {
        if (!in_array($category['theme'], ['A', 'B'], true)) {
            return '';
        }

        $peers = $this
            ->where('theme', $category['theme'])
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        $n = 0;
        foreach ($peers as $peer) {
            $n++;
            if ((int) $peer['id'] === (int) $category['id']) {
                return $category['theme'] . $n;
            }
        }

        return '';
    }
}
