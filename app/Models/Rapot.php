<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Rapot extends Model
{
    protected $table = 'rapot';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','nama_rapot'];
 
}