<?php

namespace App\Controllers;
use App\Models\Users;
use App\Models\Buku;
use App\Models\Notifikasi;
use App\Models\Order;

class RequestController extends BaseController
{
	public function count()
	{	
		
	}

	public function wrapper()
	{	

	}

	public function add_order()
	{	
        $order = new Order();
        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'harga_new' => $this->request->getPost('harga_new'),
            'id_buku' => $this->request->getPost('id_buku'),
            'pengembalian' => date("Y-m-d H:i:s", strtotime($this->request->getPost('pengembalian')))
        ]; 
        if($order->insert($data)){
            return redirect()->to('/admin/addorder')->withInput()->with('success', 'Order berhasil di input');
        }else{
            return redirect()->to('/admin/addorder')->withInput()->with('error', 'Order tidak berhasil di input');
        }
	}

    public function add_checkout()
	{	
		$order = new Order();
        $check = $order->where('id_order', $this->request->getPost('id'));
        $check = $check->get()->getResult();
        if(isset($check[0]->id_order)){
            $data = [
                'id_order' => $check[0]->id_order,
                'id_buku' => $check[0]->id_buku,
                'id_user' => $check[0]->id_buku,
                'harga_new' => $check[0]->harga_new,
                'status' => "Sudah Bayar",
                'pengembalian' => $check[0]->pengembalian,
            ];
            $simpan = $order->update($this->request->getPost('id'), $data);
            if($simpan){
                return redirect()->to('/admin/checkout')->withInput()->with('success', 'Pembayaran Berhasil');
            }else{
                return redirect()->to('/admin/checkout')->withInput()->with('error', 'Pembayaran tidak berhasil');
            }
        }
	}
	
	
}