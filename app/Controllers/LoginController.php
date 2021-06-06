<?php

namespace App\Controllers;
use App\Models\Admin;
use CodeIgniter\HTTP\IncomingRequest;
class LoginController extends BaseController
{
	public function index()
	{	$admin = new Admin();
		$post = $this->request->getPost();
		
        // cari admin berdasarkan email dan username
        $admin->where('email', $post["email"]);
        $admin = $admin->findAll();
		
        if($admin){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $admin[0]['password']);
            
            // jika password benar dan dia admin
            if($isPasswordTrue){ 
                session()->set([
                    'name' => $admin[0]['name'],
                    'email' => $admin[0]['email'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('/admin'));
            }else{
				return redirect()->to('/')->withInput()->with('foo', 'Kata sandi yang dimasukan Salah');
			}
        }
        
        // login gagal
		return redirect()->to('/')->withInput()->with('foo', 'Email tidak terdaftar');
	}

	function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}