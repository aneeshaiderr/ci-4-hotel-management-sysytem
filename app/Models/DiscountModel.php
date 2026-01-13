<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscountModel extends Model
{
    protected $table            = 'discounts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['discount_type',
        'discount_name',
        'value',
        'start_date',
        'end_date',
        'status'];

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
  public function getAllDiscounts()
{
    return $this->select([
                'id',
                'discount_type',
                'discount_name',
                'value',
                'start_date',
                'end_date',
                'status',
            ])
            ->orderBy('start_date', 'ASC')
            ->findAll();
}

    /**
     * Find single discount by ID
     */
    public function getDiscountById(int $id)
    {
        return $this->select([
                'id',
                'discount_type',
                'discount_name',
                'value',
                'start_date',
                'end_date',
                'status',
            ])
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();
    }

    /**
     * Create new discount
     */
    public function createDiscount(array $data)
    {
        return $this->insert([
            'discount_type' => $data['discount_type'],
            'discount_name' => $data['discount_name'],
            'value'         => $data['value'],
            'start_date'    => $data['start_date'],
            'end_date'      => $data['end_date'],
            'status'        => $data['status'],
        ]);
    }

    /**
     * Update discount
     */
    public function updateDiscount(int $id, array $data)
    {
        return $this->update($id, [
            'discount_type' => $data['discount_type'],
            'discount_name' => $data['discount_name'],
            'value'         => $data['value'],
            'start_date'    => $data['start_date'],
            'end_date'      => $data['end_date'],
            'status'        => $data['status'],
        ]);
    }

    /**
     * Soft delete discount
     */
    public function softDeleteDiscount(int $id)
    {
        return $this->delete($id);
    }
}

