<?php
namespace App\Models;
use CodeIgniter\Model;
 
class Provinces extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'prov_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['prov_id','prov_name', 'locationid','status'];
}