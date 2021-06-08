<?php

namespace App\Controllers;
use App\Models\Users;
use App\Models\Notifikasi;
class AdminController extends BaseController
{
	public function index()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$model = new Users();
		$notifiaksi = new Notifikasi();
		$notifiaksi = $notifiaksi->limit(5)->orderBy('id', 'DESC')->get();
		$users = $model->select('id, name, email ,address, phone , nik, created_at, updated_at')->orderBy('id', 'DESC')->findAll();
		$data = [
			'users' => $users,
			'notifikasi' => $notifiaksi,
			'title' => 'Dashboard'
		];
		return view('v_admin',$data);
	}

	public function about()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$notifiaksi = new Notifikasi();
		$notifiaksi = $notifiaksi->limit(5)->orderBy('id', 'DESC')->get();
		$data = [
			'title' => 'About',
			'notifikasi' => $notifiaksi
		];
		return view('v_about',$data);
	}
}