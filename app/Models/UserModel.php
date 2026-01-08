<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = [
        'username', 'password', 'created_at', 'updated_at'
    ];

    /**
     * Get all users with auth_logins info (status + identifier)
     */
    public function getAllUsers()
    {
        $builder = $this->db->table('users u');
        $builder->select('
            u.id,
            u.username,
            u.status,
            al.identifier
        ');
        $builder->join('auth_logins al', 'al.user_id = u.id', 'left');
        $builder->orderBy('u.id');

        return $builder->get()->getResultArray();
    }
      public function createUser(array $data)
    {
   $db = $this->db;

    $db->table('users')->insert([
        'username'   => $data['username'],
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    $userId = $db->insertID();


    $db->table('auth_identities')->insert([
        'user_id'    => $userId,

        'identifier' => $data['identifier'],
        'secret2'    => password_hash($data['password'], PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    return $userId;
}

}
