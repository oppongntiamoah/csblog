<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CategoryModel;

class Blog extends BaseController
{
    protected PostModel $postModel;
    protected CategoryModel $categoryModel;

    public function __construct()
    {
        $this->postModel     = new PostModel();
        $this->categoryModel = new CategoryModel();
    }

    /**
     * All posts listing
     */
    public function index(): string
    {
        $data = [
            'title'      => 'All Topics — CS Knowledge Base',
            'categories' => $this->categoryModel->findAll(),
            'posts'      => $this->postModel->orderBy('category_id', 'ASC')->orderBy('sort_order', 'ASC')->findAll(),
        ];

        return view('blog/index', $data);
    }

    /**
     * Posts by category slug
     */
    public function category(string $slug): string
    {
        $category = $this->categoryModel->where('slug', $slug)->first();

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'                => $category['name'] . ' — CS Knowledge Base',
            'active_category'      => $category['name'],
            'category_description' => $category['description'],
            'objectives'           => $this->postModel->getObjectivesByCategory($slug),
        ];

        return view('home/index', $data);
    }

    /**
     * Single post
     */
    public function post(string $slug): string
    {
        $post = $this->postModel->getPostWithCategory($slug);

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Related posts in same category
        $related = $this->postModel
            ->where('category_id', $post['category_id'])
            ->where('id !=', $post['id'])
            ->orderBy('sort_order', 'ASC')
            ->limit(10)
            ->findAll();

        // Prev / Next within same category
        $prev = $this->postModel
            ->where('category_id', $post['category_id'])
            ->where('sort_order <', $post['sort_order'])
            ->orderBy('sort_order', 'DESC')
            ->first();

        $next = $this->postModel
            ->where('category_id', $post['category_id'])
            ->where('sort_order >', $post['sort_order'])
            ->orderBy('sort_order', 'ASC')
            ->first();

        $data = [
            'title'           => $post['code'] . ' ' . $post['title'] . ' — CS KB',
            'seo_title'       => $post['seo_title'] ?: $post['code'] . ' ' . $post['title'] . ' — CS KB',
            'seo_description' => $post['seo_description'] ?? null,
            'seo_keywords'    => $post['seo_keywords'] ?? null,
            'post'            => $post,
            'related'         => $related,
            'prev_post'       => $prev,
            'next_post'       => $next,
        ];

        return view('blog/post', $data);
    }
}
