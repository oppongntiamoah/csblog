<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;

class Posts extends BaseController
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
        $posts = $this->postModel->db->table('posts p')
            ->select('p.*, c.name as category_name')
            ->join('categories c', 'c.id = p.category_id', 'left')
            ->orderBy('p.category_id', 'ASC')
            ->orderBy('p.sort_order', 'ASC')
            ->get()->getResultArray();

        return view('admin/posts/index', [
            'title' => 'Posts',
            'posts' => $posts,
        ]);
    }

    public function create(): string
    {
        return view('admin/posts/form', [
            'title'      => 'New Post',
            'post'       => null,
            'categories' => $this->categoryModel->orderBy('name', 'ASC')->findAll(),
        ]);
    }

    public function store()
    {
        $data = [
            'category_id'     => $this->request->getPost('category_id'),
            'code'            => $this->request->getPost('code'),
            'title'           => $this->request->getPost('title'),
            'slug'            => $this->request->getPost('slug') ?: url_title($this->request->getPost('code') . '-' . $this->request->getPost('title'), '-', true),
            'content'         => $this->request->getPost('content'),
            'hl'              => $this->request->getPost('hl') ? 1 : 0,
            'sort_order'      => (int) $this->request->getPost('sort_order'),
            'seo_title'       => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
            'seo_keywords'    => $this->request->getPost('seo_keywords'),
        ];

        $this->postModel->insert($data);
        session()->setFlashdata('success', 'Post created successfully.');
        return redirect()->to(base_url('admin/posts'));
    }

    public function edit(int $id): string
    {
        $post = $this->postModel->find($id);

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/posts/form', [
            'title'      => 'Edit Post',
            'post'       => $post,
            'categories' => $this->categoryModel->orderBy('name', 'ASC')->findAll(),
        ]);
    }

    public function update(int $id)
    {
        $post = $this->postModel->find($id);

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'category_id'     => $this->request->getPost('category_id'),
            'code'            => $this->request->getPost('code'),
            'title'           => $this->request->getPost('title'),
            'slug'            => $this->request->getPost('slug') ?: url_title($this->request->getPost('code') . '-' . $this->request->getPost('title'), '-', true),
            'content'         => $this->request->getPost('content'),
            'hl'              => $this->request->getPost('hl') ? 1 : 0,
            'sort_order'      => (int) $this->request->getPost('sort_order'),
            'seo_title'       => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
            'seo_keywords'    => $this->request->getPost('seo_keywords'),
        ];

        $this->postModel->update($id, $data);
        session()->setFlashdata('success', 'Post updated successfully.');
        return redirect()->to(base_url('admin/posts'));
    }

    public function delete(int $id)
    {
        $this->postModel->delete($id);
        session()->setFlashdata('success', 'Post deleted.');
        return redirect()->to(base_url('admin/posts'));
    }
}
