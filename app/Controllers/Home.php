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
        $data = [
            'title'                => 'CS Knowledge Base — IB Computer Science',
            'active_category'      => 'Computer Fundamentals',
            'category_description' => 'This category provides a foundation in the essential components and operation of computer systems. Topics include hardware architecture, the function of the CPU, GPU, machine instruction cycles, and memory types. Students will also examine system software, including operating systems. This knowledge underpins all higher-level computing concepts and supports critical analysis of how computers process and manage data.',
            'objectives'           => $this->postModel->getObjectivesByCategory('computer-fundamentals'),
        ];

        return view('home/index', $data);
    }

    public function about(): string
    {
        return view('home/about', ['title' => 'About — CS Knowledge Base']);
    }
}
