<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataAfirmasi extends Model
{
    protected $table = 'afirmasi';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_pendaftar', 'nomor_kks','nomor_kps_pkh','nomor_kip','nama_kip','alasan_layak_pip'];
 
}