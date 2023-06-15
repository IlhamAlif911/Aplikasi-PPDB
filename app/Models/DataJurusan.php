<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataJurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','nama_jurusan','status', 'deskripsi','file_foto'];
 
}