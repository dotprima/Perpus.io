<?php

namespace App\Controllers;
use App\Models\Users;
class AdminController extends BaseController
{
	public function index()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$model = new Users();
		$users = $model->select('id, name, email ,address, phone , nik, created_at, updated_at')->orderBy('id', 'DESC')->findAll();
		$data = [
			'users' => $users,
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
		$data = [
			'title' => 'About'
		];
		return view('v_about',$data);
	}
}