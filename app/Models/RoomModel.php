<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table            = 'rooms';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'room_number',
    'floor',
    'beds',
    'max_guests',
    'hotel_id',
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
    public function getAllRooms()
    {
        return $this->where('deleted_at', null)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    /**
     * Get all rooms including deleted
     */
    public function getAll()
    {
        return $this->findAll(); // includes soft deleted if use withDeleted()
    }

    /**
     * Get room by ID
     */
    public function getRoomById($id)
    {
        return $this->where('id', $id)
                    ->first();
    }

    /**
     * Create new room
     */
    public function create($data)
     {
        return $this->insert($data);
    }

    /**
     * Update room
     */
    public function updateRoom($id, $data)
    {
        return $this->update($id, [
            'room_number' => $data['room_number'],
            'floor'       => $data['floor'],
            'beds'        => $data['beds'],
            'max_guests'  => $data['max_guests'],
            'status'      => $data['status'],
        ]);
    }

    /**
     * Soft delete room
     */
    public function softDeleteRoom($id)
    {
        return $this->delete($id);
    }

    /**
     * Get all hotels (id, hotel_name) for dropdowns
     */
    public function getAllHotels()
    {
        return $this->db->table('hotels')
                        ->select('id, hotel_name')
                        ->get()
                        ->getResultArray();
    }

}
