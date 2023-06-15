<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Cities extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'city_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['prov_id','city_name', 'city_id'];
 
}