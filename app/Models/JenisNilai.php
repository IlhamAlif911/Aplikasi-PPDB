<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class JenisNilai extends Model
{
    protected $table = 'jenis_nilai';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_rapot','id_pendaftar','matematika','ipa','bahasa_inggris','bahasa_indonesia','file'];
 
}