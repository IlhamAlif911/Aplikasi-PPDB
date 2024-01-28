<?php

namespace App\Models;

use CodeIgniter\Model;

class AppSetting extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'app_setting';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_settings(String $name, Bool $global) {
        $quary = $this->where('status', 1);
        $quary->where('name', $name);
        if($global) {
            $quary->where('is_global', 1);
        } else {
            if (isset($_SESSION['user_id'])) {
                $quary->where('user_id', $_SESSION['user_id']);
            }
        }
        return $quary;
    }
}
