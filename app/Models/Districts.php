<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Districts extends Model
{
    protected $table = 'districts';
    protected $primaryKey = 'dis_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['city_id','dis_id', 'dis_name'];
 
}