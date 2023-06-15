<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataOrangTua extends Model
{
    protected $table = 'data_orang_tua';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_siswa', 'jenis_orang_tua','nama','nik','tahun_lahir','pendidikan','pekerjaan','penghasilan_bulanan','berkebutuhan_khusus','nomor_hp','email','alamat'];
 
}