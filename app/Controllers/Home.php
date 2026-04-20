<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    protected PostModel $postModel;
    protected CategoryModel $categoryModel;

    public function __construct()
    {
        $this->postModel     = new PostModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index(): string
    {
        $slug     = 'computer-fundamentals';
        $category = $this->categoryModel->where('slug', $slug)->first();

        $data = [
            'title'          => 'CS Knowledge Base — IB Computer Science 2027',
            'sidebar_active' => $slug,
            'category'       => $category,
            'cat_code'       => $category ? $this->categoryModel->computeCode($category) : '',
            'objectives'     => $this->postModel->getObjectivesByCategory($slug),
        ];

        return view('home/index', $data);
    }

    public function about(): string
    {
        return view('home/about', [
            'title' => 'About — CS Knowledge Base',
        ]);
    }
}
