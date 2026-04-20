<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdModel;

class Ads extends BaseController
{
    protected AdModel $model;

    public function __construct()
    {
        $this->model = new AdModel();
    }

    public function index(): string
    {
        return view('admin/ads/index', [
            'title' => 'Ads',
            'ads'   => $this->model->orderBy('placement', 'ASC')->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('admin/ads/form', [
            'title' => 'New Ad',
            'ad'    => null,
        ]);
    }

    public function store()
    {
        $data = [
            'title'      => $this->request->getPost('title'),
            'placement'  => $this->request->getPost('placement'),
            'code'       => $this->request->getPost('code'),
            'active'     => $this->request->getPost('active') ? 1 : 0,
            'sort_order' => (int) $this->request->getPost('sort_order'),
        ];

        $this->model->insert($data);
        session()->setFlashdata('success', 'Ad created successfully.');
        return redirect()->to(base_url('admin/ads'));
    }

    public function edit(int $id): string
    {
        $ad = $this->model->find($id);

        if (!$ad) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/ads/form', [
            'title' => 'Edit Ad',
            'ad'    => $ad,
        ]);
    }

    public function update(int $id)
    {
        $ad = $this->model->find($id);

        if (!$ad) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'      => $this->request->getPost('title'),
            'placement'  => $this->request->getPost('placement'),
            'code'       => $this->request->getPost('code'),
            'active'     => $this->request->getPost('active') ? 1 : 0,
            'sort_order' => (int) $this->request->getPost('sort_order'),
        ];

        $this->model->update($id, $data);
        session()->setFlashdata('success', 'Ad updated successfully.');
        return redirect()->to(base_url('admin/ads'));
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        session()->setFlashdata('success', 'Ad deleted.');
        return redirect()->to(base_url('admin/ads'));
    }
}
