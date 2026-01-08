<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table            = 'auth_permissions_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'permission', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
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
     public function getAll(): array
    {
        return $this->select()
            ->orderBy('id')
            ->get()
            ->getResultArray();
    }

    /**
     * Get  user IDs for dropdown
     */
    public function getUsers(): array
    {
        return $this->select()
            ->select('user_id')
            ->distinct()
            ->orderBy('user_id')
            ->get()
            ->getResultArray();
    }

    /**
     * Check if user already has this permission
     */
    public function exists(int $userId, string $permission): bool
    {
        return (bool) $this->select()
            ->where('user_id', $userId)
            ->where('permission', $permission)
            ->countAllResults();
    }

    /**
     * Assign permission to user
     */
    public function assign(int $userId, string $permission)
    {
        return $this->insert([
            'user_id'    => $userId,
            'permission' => $permission,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Delete permission by ID
     */
 public function remove(int $id): bool
    {
        
        return (bool) $this->delete($id);
    }


}
