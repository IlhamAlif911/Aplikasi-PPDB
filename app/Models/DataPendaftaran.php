<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataPendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftar';
    protected $returnType = "object";
    protected $allowedFields = ['id_pendaftar','jalur', 'tahap','periode'];
 
}