<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataAgenda extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','periode_id','nama_agenda', 'tanggal_mulai','tanggal_selesai','keterangan','sub_nama'];
 
}