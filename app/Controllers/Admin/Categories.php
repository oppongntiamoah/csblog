<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Categories extends BaseController
{
    protected CategoryModel $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function index(): string
    {
        return view('admin/categories/index', [
            'title'      => 'Categories',
            'categories' => $this->model->orderBy('theme', 'ASC')->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('admin/categories/form', [
            'title'    => 'New Category',
            'category' => null,
        ]);
    }

    public function store()
    {
        $data = [
            'name'        => $this->request->getPost('name'),
            'slug'        => $this->request->getPost('slug') ?: url_title($this->request->getPost('name'), '-', true),
            'theme'       => $this->request->getPost('theme'),
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon'),
            'sort_order'  => (int) $this->request->getPost('sort_order'),
        ];

        $this->model->insert($data);
        session()->setFlashdata('success', 'Category created successfully.');
        return redirect()->to(base_url('admin/categories'));
    }

    public function edit(int $id): string
    {
        $category = $this->model->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/categories/form', [
            'title'    => 'Edit Category',
            'category' => $category,
        ]);
    }

    public function update(int $id)
    {
        $category = $this->model->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'slug'        => $this->request->getPost('slug') ?: url_title($this->request->getPost('name'), '-', true),
            'theme'       => $this->request->getPost('theme'),
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon'),
            'sort_order'  => (int) $this->request->getPost('sort_order'),
        ];

        $this->model->update($id, $data);
        session()->setFlashdata('success', 'Category updated successfully.');
        return redirect()->to(base_url('admin/categories'));
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        session()->setFlashdata('success', 'Category deleted.');
        return redirect()->to(base_url('admin/categories'));
    }
}
