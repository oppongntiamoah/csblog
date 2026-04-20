<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;
use App\Models\AdModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $postModel     = new PostModel();
        $categoryModel = new CategoryModel();
        $adModel       = new AdModel();

        $data = [
            'title'       => 'Dashboard',
            'total_posts' => $postModel->countAll(),
            'total_cats'  => $categoryModel->countAll(),
            'total_ads'   => $adModel->countAll(),
            'recent_posts'=> $postModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
        ];

        return view('admin/dashboard/index', $data);
    }
}
