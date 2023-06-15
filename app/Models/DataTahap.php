<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataTahap extends Model
{
    protected $table = 'tahap';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_periode','nama_tahap', 'tanggal_mulai','tanggal_selesai','status'];
 
}