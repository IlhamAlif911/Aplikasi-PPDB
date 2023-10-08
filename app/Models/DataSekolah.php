<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataSekolah extends Model
{
    protected $table = 'data_sekolah';
    protected $primaryKey = 'sekolah_id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['sekolah_id','nama_sekolah','status'];
 
}