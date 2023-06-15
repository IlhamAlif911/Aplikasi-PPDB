<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class KategoriKode extends Model
{
    protected $table = 'kategori_kode';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','nama_kategori', 'status'];
 
}