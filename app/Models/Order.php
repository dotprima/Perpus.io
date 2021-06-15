<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table      = 'order';
    protected $primaryKey = 'id_order';

    protected $allowedFields = ['id_buku', 'id_user' ,'harga_new', 'status' ,'pengembalian'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
}