<?php

namespace App\Models;

use CodeIgniter\Model;

class UserInfoModel extends Model
{
    protected $table = 'user_info';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'contact_no',
        'status'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    /**
     * Get all users with joined username from users table
     */
    public function getAllUser()
    {
        return $this->select('user_info.*, users.username')
                    ->join('users', 'users.id = user_info.user_id', 'left')
                    ->findAll();
    }

    /**
     * Find single user with username
     */
    public function getUser($id)
    {
        return $this->select('user_info.*, users.username')
                    ->join('users', 'users.id = user_info.user_id', 'left')
                    ->where('user_info.id', $id)
                    ->first();
    }
}
