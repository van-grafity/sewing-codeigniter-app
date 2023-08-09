<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        if((session()->get('logged_in'))){
            return redirect()->to(base_url('/home'));
        }
        return view('login/index');
    }

    public function process() {

        $users = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $dataUser = $users->where([
            'email' => $email,
        ])->first();

        if ($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                session()->set([
                    'email' => $dataUser->email,
                    'name' => $dataUser->name,
                    'logged_in' => TRUE
                ]);

                $current_url = session()->get('last_current_url');
                if($current_url) {
                    return redirect()->to($current_url);
                } else {
                    return redirect()->to(base_url('/home'));
                }
                
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Email Tidak Ditemukan');
            return redirect()->back();
        }

    }

    function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
}
