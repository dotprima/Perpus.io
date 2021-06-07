<?php

namespace App\Controllers;

class HomeController extends BaseController
{
	public function index()
	{
		if(!is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/admin'));
        }
		return view('login');
	}
}