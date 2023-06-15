<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataPeriode extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','nama_periode', 'tanggal_mulai','tanggal_selesai','status'];
 
}