<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataPendaftar extends Model
{
    protected $table = 'data_pendaftar';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','nama_lengkap','nisn', 'nik','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','berkebutuhan_khusus','alamat','kelurahan','kecamatan','kabupaten','provinsi','kode_pos','rt','rw','nomor_hp','email','asal_sekolah','type_asal_sekolah','status_penerimaan','foto','jurusan','jurusan2','type_registration'];
 
}