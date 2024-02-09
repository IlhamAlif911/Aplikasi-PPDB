<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class DataPembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','id_pendaftar','order_id', 'tanggal_transfer','nama_pemilik_rekening','no_va','nama_bank','opsi_bayar','status','nominal_transfer'];
 
}