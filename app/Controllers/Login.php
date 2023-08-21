<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    public function process()
    {
        $session = session();
        $model = new LoginModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $user = $model->getUserByUsername($username);

        if ($user) {
            if (password_verify($password, $user->password)) {
                $session->set('isLoggedIn', true);
                $session->set('username', $user->username);
                return redirect()->to('/Admin'); // Ganti dengan halaman setelah berhasil login
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('isLoggedIn');
        $session->remove('username');
        return redirect()->to('/login'); // Ganti dengan halaman login
    }
}
