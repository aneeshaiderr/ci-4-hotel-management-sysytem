<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table            = 'hotels';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   =true;
    protected $protectFields    = true;
      protected $allowedFields = [
        'hotel_name',
        'address',
        'contact_no',
    ];

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


     public function getAllHotels()
    {
        return $this->where('deleted_at', null)
                    ->orderBy('id')
                    ->findAll();
    }

    /**
     * Get hotel by ID (only not deleted)
     */
    public function getHotelById($id)
    {
        return $this->where('id', $id)
                    ->where('deleted_at', null)
                    ->first();
    }

    /**
     * Create a new hotel
     */
    public function createHotel($data)
    {
        return $this->insert($data);

    }

    /**
     * Update hotel
     */
    public function updateHotel($id, $data)
    {
        return $this->update($id, [
            'hotel_name' => $data['hotel_name'],
            'address'    => $data['address'],
            'contact_no' => $data['contact_no'],
        ]);
    }

    /**
     * Soft delete a hotel
     */
    public function softDeleteHotel($id)
    {
        return $this->delete($id);
    }

    /**
     * Get all hotels (including deleted if needed)
     */
    public function getAllHotelsIncludingDeleted()
    {
        return $this->withDeleted()->findAll();
    }
}
