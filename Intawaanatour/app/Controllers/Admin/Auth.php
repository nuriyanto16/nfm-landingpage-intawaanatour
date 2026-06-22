<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin');
        }

        return view('admin/login');
    }

    public function attempt()
    {
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $user = (new UserModel())->where('email', $email)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            session()->set([
                'admin_logged_in' => true,
                'admin_id'        => $user['id'],
                'admin_name'      => $user['name'],
            ]);

            return redirect()->to('/admin');
        }

        return redirect()->back()->withInput()
            ->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        session()->remove(['admin_logged_in', 'admin_id', 'admin_name']);

        return redirect()->to('/admin/login')->with('success', 'Anda telah keluar.');
    }
}
