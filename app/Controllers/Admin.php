<?php

namespace App\Controllers;
use App\Models\Users;
class Admin extends BaseController
{
	public function index()
	{	
		$model = new Users();
		$users = $model->select('id, name, email ,address, phone , nik, created_at, updated_at')->findAll();
		$data = [
			'users' => $users
		];
		return view('v_admin',$data);
	}
}