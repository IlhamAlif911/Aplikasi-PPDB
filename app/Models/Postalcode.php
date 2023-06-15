<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Postalcode extends Model
{
    protected $table = 'ec_postalcode';
    protected $primaryKey = 'postal_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['postal_id','postal_code', 'subdis_id'];
 
}