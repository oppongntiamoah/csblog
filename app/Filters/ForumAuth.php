<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ForumAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('user_logged_in')) {
            session()->setFlashdata('login_redirect', current_url());
            session()->setFlashdata('forum_error', 'You need to sign in with Google to do that.');
            return redirect()->to(base_url('auth/google'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
