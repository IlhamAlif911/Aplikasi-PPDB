<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataPrestasi extends Model
{
    protected $table = 'prestasi_siswa';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_siswa', 'nama_prestasi','jenis_prestasi','tingkat_prestasi','tahun','penyelenggara','peringkat','nilai_bobot'];
 
}