<?php

namespace App\Controllers;
use App\Models\Buku;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Notifikasi;

class ApiBukuController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new Buku();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $model = new Buku();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id => '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $users = new Buku();
        $validation =  \Config\Services::validation();
        $data = [
            'judul' => $this->request->getPost('judul'),
            'tahun' => $this->request->getPost('tahun'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'stock' => $this->request->getPost('stock'),
            'url' => $this->request->getPost('url'),
            'harga' => $this->request->getPost('harga'),
        ]; 
        if($validation->run($data, 'buku') == TRUE){
           if($users->insert($data)){
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Saved'
                ]
            ]; 
            $notifiaksi = new Notifikasi();
            $noti = [
                'status' => 'create',
                'email'  => $data['judul']
            ];
            $notifiaksi->insert($noti);
            return $this->respondCreated($response, 201);
           }else{
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors(),
            ];
            return $this->respond($response, 500);
           }
            
        }else{
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors(),
            ];
            return $this->respond($response, 500);
        }
    }
 
    // update product
    public function update($id = null)
    {
        $model = new Buku();
        $validation =  \Config\Services::validation();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            $input  = $this->request->getRawInput();
            $data = [
                'judul' => $input['judul'],
                'tahun' => $input['tahun'],
                'penulis' => $input['penulis'],
                'penerbit' => $input['penerbit'],
                'stock' => $input['stock'],
                'url' => $input['url'],
                'harga' => $input['harga']
            ];   
            if($validation->run($data, 'buku') == TRUE){
                $simpan = $model->update($id, $data);
                if($simpan){
                    $msg = ['message' => 'Updated category successfully'];
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'data' => $msg,
                    ];
                    $notifiaksi = new Notifikasi();
                    $noti = [
                        'status' => 'update',
                        'email'  => $data['judul']
                    ];
                    $notifiaksi->insert($noti);
                    return $this->respond($response, 200);
                }else{
                    $response = [
                        'status' => 500,
                        'error' => true,
                    ];
                    return $this->respond($response, 500);
                }
            }else{
                $response = [
                    'status' => 500,
                    'error' => true,
                    'data' => $validation->getErrors(),
                ];
                return $this->respond($response, 500);
            }
        }else{
            return $this->failNotFound('No Data Found with id => '.$id);
        }
    }
 
    // delete product
    public function delete($id = null)
    {
        $model = new Buku();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            $notifiaksi = new Notifikasi();
            $noti = [
                'status' => 'delete',
                'email'  => $data['judul']
            ];
            $notifiaksi->insert($noti);
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id => '.$id);
        }
    }
}