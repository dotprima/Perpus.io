<?php

namespace App\Controllers;
use App\Models\Users;
use App\Models\Buku;
use App\Models\Notifikasi;
use App\Models\Order;
class AdminController extends BaseController
{
	public function count()
	{	
		$earning = 0;
		$users= new Users();
		$buku = new Buku();
		$order = new Order();
		$earn = $order->where('status','Belum Bayar')->findAll();
		foreach($earn as $key){
			$earning = $earning + $key['harga_new'];
		}
		$data = [
			'earning' => $earning,
			'users' => $users->countAllResults(),
			'buku' => $buku->countAllResults(),
			'order' => $order->countAllResults()
		];
		return $data;
	}

	public function wrapper()
	{	
		$users= new Users();
		$buku = new Buku();
		$data = [
			'users' => $users->findAll(),
			'buku' => $buku->findAll()
		];
		return $data;
	}
	public function index()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$notifiaksi = new Notifikasi();
		$count = $this->count();
		$notifiaksi = $notifiaksi->limit(5)->orderBy('id', 'DESC')->get();
		$data = [
			'title' => 'Dashboard',
			'notifikasi' => $notifiaksi,
			'count' => $count
		];
		return view('v_admin',$data);
	}
	
	public function add_users()
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
			'title' => 'Tambah User'
		];
		return view('v_add_users',$data);
	}


	public function history()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$model = new Order();
		$notifiaksi = new Notifikasi();
		$notifiaksi = $notifiaksi->limit(5)->orderBy('id', 'DESC')->get();
		$order = $model->where('status', 'Sudah Bayar');
		$order->join('users', 'users.id = order.id_user' );
		$order->join('buku', 'buku.id = order.id_buku' ,'buku.id as buku_id' );
		$order = $model->orderBy('id_order', 'DESC')->findAll();
		$data = [
			'orders' => $order,
			'notifikasi' => $notifiaksi,
			'title' => 'Tambah User'
		];
		return view('v_history',$data);
	}

	public function add_book()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$model = new Buku();
		$notifiaksi = new Notifikasi();
		$notifiaksi = $notifiaksi->limit(5)->orderBy('id', 'DESC')->get();
		$book = $model->orderBy('id', 'DESC')->findAll();
		$data = [
			'books' => $book,
			'notifikasi' => $notifiaksi,
			'title' => 'Tambah Buku'
		];
		return view('v_add_book',$data);
	}

	public function add_order()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$notifiaksi = new Notifikasi();
		$content = $this->wrapper();
		$notifiaksi = $notifiaksi->limit(5)->orderBy('id', 'DESC')->get();
		$data = [
			'title' => 'Add Order',
			'notifikasi' => $notifiaksi,
			'content' => $content
		];
		return view('v_add_order',$data);
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

	public function checkout()
	{	
		if(is_null(session()->get('logged_in')))
        {
            return redirect()->to(base_url('/'));
        }
		$notifiaksi = new Notifikasi();
		$order= new Order();
		$notifiaksi = $notifiaksi->limit(5)->orderBy('id', 'DESC')->get();
		$order = $order->where('status', 'Belum Bayar');
		$order->join('users', 'users.id = order.id_user' );
		$order->join('buku', 'buku.id = order.id_buku' ,'buku.id as buku_id' );
	
		$data = [
			'title' => 'Checkout',
			'notifikasi' => $notifiaksi,
			'order' => $order->Findall()
		];
		return view('v_checkout',$data);

	}
}