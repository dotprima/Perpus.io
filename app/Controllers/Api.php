<?php

namespace App\Controllers;
use App\Models\Users;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new Users();
        $data = $model->select('id, name, email ,address, phone , nik, created_at, updated_at')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $model = new Users();
        $data = $model->select('id, name, email ,address, phone , nik, created_at, updated_at')->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id => '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new Users();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
        ]; 
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($response, 201);
    }
 
    // update product
    public function update($id = null)
    {
        $model = new Users();
        $validation =  \Config\Services::validation();
        $data = $model->select('id, name, email ,address, phone , nik, created_at, updated_at')->getWhere(['id' => $id])->getResult();
        if($data){
            $input  = $this->request->getRawInput();
            $data = [
                'name' => $input['name'],
                'email' => $input['password'],
                'password' => password_hash($input['password'], PASSWORD_BCRYPT)
               
            ];   
            if($validation->run($data, 'users') == TRUE){
                $input  = $this->request->getRawInput();
                $data = [
                    'name' => $input['name'],
                    'email' => $input['password'],
                    'password' => password_hash($input['password'], PASSWORD_BCRYPT)
                   
                ]; 
                $simpan = $model->update($id, $data);
                if($simpan){
                    $msg = ['message' => 'Updated category successfully'];
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'data' => $msg,
                    ];
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
        $model = new Users();
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
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id => '.$id);
        }
    }
}