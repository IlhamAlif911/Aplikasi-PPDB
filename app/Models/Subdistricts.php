<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Subdistricts extends Model
{
    protected $table = 'subdistricts';
    protected $primaryKey = 'subdis_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['dis_id','subdis_name', 'subdis_id'];
 
}