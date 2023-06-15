<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftar';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_pendaftar','jalur', 'tahap','periode'];
 
}