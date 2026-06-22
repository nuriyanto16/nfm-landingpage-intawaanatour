<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Account extends BaseController
{
    protected UserModel $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        return view('admin/account/password', [
            'title' => 'Ubah Password',
        ]);
    }

    public function changePassword()
    {
        $rules = [
            'current_password'      => 'required',
            'new_password'          => 'required|min_length[8]',
            'new_password_confirm'  => 'required|matches[new_password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userId = session('admin_id');
        $user   = $this->model->find($userId);

        if (! $user) {
            return redirect()->to('/admin/login')
                ->with('error', 'Sesi tidak valid, silakan login kembali.');
        }

        $current = (string) $this->request->getPost('current_password');
        if (! password_verify($current, $user['password_hash'])) {
            return redirect()->back()
                ->with('error', 'Password saat ini salah.');
        }

        $new = (string) $this->request->getPost('new_password');
        if (password_verify($new, $user['password_hash'])) {
            return redirect()->back()
                ->with('error', 'Password baru tidak boleh sama dengan password lama.');
        }

        $this->model->update($userId, [
            'password_hash' => password_hash($new, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/admin/account')
            ->with('success', 'Password berhasil diubah.');
    }
}
