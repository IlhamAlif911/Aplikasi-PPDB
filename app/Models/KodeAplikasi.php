<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class KodeAplikasi extends Model
{
    protected $table = 'kode_aplikasi';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_kategori', 'nama_opsi','status'];
 
}