<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('/pages/login');
    }

    public function process()
    {
        $users = new LoginModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'username' => $username,
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                session()->set([
                    'username' => $dataUser->username,
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('Berkas/'));
            } else {
                session()->setFlashdata('error', 'Password yang anda masukkan salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username yang anda masukkan salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('Login/');
    }
}
