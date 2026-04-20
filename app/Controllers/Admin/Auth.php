<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;

class Auth extends BaseController
{
    public function login(): string
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        return view('admin/auth/login', ['title' => 'Admin Login']);
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new AdminUserModel();
        $user  = $model->verifyLogin($username, $password);

        if ($user) {
            session()->set([
                'admin_logged_in' => true,
                'admin_id'        => $user['id'],
                'admin_username'  => $user['username'],
            ]);
            return redirect()->to(base_url('admin/dashboard'));
        }

        session()->setFlashdata('error', 'Invalid username or password.');
        return redirect()->to(base_url('admin/login'));
    }

    public function logout()
    {
        session()->remove(['admin_logged_in', 'admin_id', 'admin_username']);
        return redirect()->to(base_url('admin/login'));
    }
}
