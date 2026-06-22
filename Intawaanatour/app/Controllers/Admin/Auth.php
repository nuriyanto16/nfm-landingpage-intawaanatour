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
        // 1) Throttle: maksimal 5 percobaan / menit / IP (anti brute-force)
        $throttler = service('throttler');
        if ($throttler->check(md5('login-' . $this->request->getIPAddress()), 5, MINUTE) === false) {
            return redirect()->back()->withInput()
                ->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam 1 menit.');
        }

        // 2) Validasi input dasar (termasuk kolom captcha)
        if (! $this->validate([
            'email'    => 'required|valid_email|max_length[120]',
            'password' => 'required|max_length[200]',
            'captcha'  => 'required|alpha_numeric|exact_length[5]',
        ])) {
            return redirect()->back()->withInput()
                ->with('error', 'Lengkapi email, password, dan kode captcha dengan benar.');
        }

        // 3) Verifikasi captcha (sekali pakai, kedaluwarsa 5 menit)
        $answer = (string) session('captcha_answer');
        $time   = (int) session('captcha_time');
        session()->remove(['captcha_answer', 'captcha_time']);
        $input = strtoupper(trim((string) $this->request->getPost('captcha')));

        if ($answer === '' || $input === '' || ! hash_equals($answer, $input) || (time() - $time) > 300) {
            return redirect()->back()->withInput()
                ->with('error', 'Kode captcha salah atau kedaluwarsa. Silakan coba lagi.');
        }

        // 4) Verifikasi kredensial
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $user     = (new UserModel())->where('email', $email)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Cegah session fixation: ganti ID sesi saat hak akses meningkat
            session()->regenerate(true);
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
