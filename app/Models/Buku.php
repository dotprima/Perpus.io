<?php

namespace App\Models;

use CodeIgniter\Model;

class Buku extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id','judul','tahun','penulis','penerbit','stock','url','harga'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}