<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservation';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['hotel_code',
        'user_id',
        'auth_id',
        'hotel_id',
        'room_id',
        'discount_id',
        'check_in',
        'check_out',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',];

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
     public function getAllReservations($userId = null)
    {
        $builder = $this->db->table('reservation r');
        $builder->select('
            r.*,

            a.secret,
            h.hotel_name,
            d.discount_name
        ');
        $builder->join('users u', 'r.user_id = u.id', 'left');
        $builder->join('auth_identities a', 'r.auth_id = a.id', 'left');
        $builder->join('hotels h', 'r.hotel_id = h.id', 'left');
        $builder->join('discounts d', 'r.discount_id = d.id', 'left');
        $builder->where('r.deleted_at', null);

        if ($userId !== null) {
            $builder->where('r.user_id', $userId);
        }

        $builder->orderBy('r.id', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * Soft delete reservation by ID
     */
    public function softDeleteById($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Create reservation
     */
    public function createReservation(array $data)
    {
        return $this->insert($data);
    }

    /**
     * Update reservation
     */
    public function updateReservation($id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Get reservation by ID with related info
     */
    public function getReservationById($id)
    {
        return $this->db->table('reservation r')
            ->select('r.*, u.user_email, a.secret AS user_secret, h.hotel_name, d.discount_name')
            ->join('users u', 'r.user_id = u.id', 'left')
            ->join('auth_identities a', 'r.auth_id = a.id', 'left')
            ->join('hotels h', 'r.hotel_id = h.id', 'left')
            ->join('discounts d', 'r.discount_id = d.id', 'left')
            ->where('r.id', $id)
            ->where('r.deleted_at', null)
            ->get()
            ->getRowArray();
    }

    /**
     * Get all rooms (active only)
     */
    public function getAllRooms()
    {
        return $this->db->table('rooms')
            ->select('id')
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();
    }
}
