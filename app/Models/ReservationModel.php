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
    protected $allowedFields    = [
        'user_info_id',
         'user_id',
        'hotel_code',
        'user_info_id',
        'user_id',
        'hotel_id',
        'room_id',
        'discount_id',
        'check_in',
        'check_out',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /** Get all reservations optionally filtered by user */

public function getAllReservations($userId = null)
{
    $builder = $this->db->table('reservation r')
        ->select('r.*, ui.email AS email, h.hotel_name, d.discount_name')
        ->join('users u', 'r.user_id = u.id', 'left')
        ->join('user_info ui', 'r.user_info_id = ui.id', 'left') // <-- fix here
        ->join('hotels h', 'r.hotel_id = h.id', 'left')
        ->join('discounts d', 'r.discount_id = d.id', 'left')
        ->where('r.deleted_at', null);

    if ($userId !== null) {
        $builder->where('r.user_id', $userId);
    }

    $builder->orderBy('r.id');

    return $builder->get()->getResultArray();
}

/** Get reservation by ID */
public function getReservationById($id)
{
    return $this->db->table('reservation r')
        ->select('r.*, ui.email AS email, h.hotel_name, d.discount_name')
        ->join('users u', 'r.user_id = u.id', 'left')
        ->join('user_info ui', 'r.user_info_id = ui.id', 'left') // <-- fix here
        ->join('hotels h', 'r.hotel_id = h.id', 'left')
        ->join('discounts d', 'r.discount_id = d.id', 'left')
        ->where('r.id', $id)
        ->where('r.deleted_at', null)
        ->get()
        ->getRowArray();
}

    /** Insert new reservation */
    public function createReservation(array $data)
    {
        return $this->insert($data);
    }

    /** Update reservation by ID */
    public function updateReservation($id, array $data)
    {

        return $this->update($id, $data);
    }

    /** Soft delete reservation by ID */
    public function softDeleteById($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /** Get all rooms (active only) */
    public function getAllRooms()
    {
        return $this->db->table('rooms')
            ->select('id')
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();
    }
}
