<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Users extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','role', 'id_ref','status','password','nomor_pendaftaran','email'];
 
}