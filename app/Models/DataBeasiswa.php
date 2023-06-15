<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataBeasiswa extends Model
{
    protected $table = 'beasiswa';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_siswa', 'keterangan','jenis_beasiswa','tanggal_mulai','tanggal_selesai'];
 
}