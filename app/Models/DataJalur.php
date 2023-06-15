<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataJalur extends Model
{
    protected $table = 'jalur';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_tahap','nama_jalur', 'kuota','syarat','status','opsi_jalur'];
 
}