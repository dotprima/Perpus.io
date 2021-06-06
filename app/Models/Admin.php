<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email' ,'address' ,'phone' ,'nik','password'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}