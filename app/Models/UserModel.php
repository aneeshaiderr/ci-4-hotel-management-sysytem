<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $useSoftDeletes   = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $allowedFields = [
        'username', 'password', 'created_at', 'updated_at'
    ];


     // Get users for DataTable (with search, limit, offset)
    public function getUsers(int $limit, int $offset, string $search = '', string $orderColumn = 'id', string $orderDir = 'ASC'): array
    {
        $builder = $this->db->table('users u')
            ->select('u.id, u.username, ui.first_name, ui.last_name, ui.email, ui.contact_no')
            ->join('user_info ui', 'ui.user_id = u.id', 'left')
            ->where('u.deleted_at', null);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('u.username', $search)
                ->orLike('ui.first_name', $search)
                ->orLike('ui.last_name', $search)
                ->orLike('ui.email', $search)
                ->groupEnd();
        }

        $builder->orderBy($orderColumn, $orderDir);
        return $builder->get($limit, $offset)->getResultArray();
    }

    public function countAllUsers(): int
    {
        return $this->where('deleted_at', null)->countAllResults();
    }

    public function countFilteredUsers(string $search = ''): int
    {
        $builder = $this->db->table('users u')->join('user_info ui', 'ui.user_id = u.id', 'left')->where('u.deleted_at', null);

        if (!empty($search)) {
            $builder->groupStart()
                ->like('u.username', $search)
                ->orLike('ui.first_name', $search)
                ->orLike('ui.last_name', $search)
                ->orLike('ui.email', $search)
                ->groupEnd();
        }

        return $builder->countAllResults();
    }

    /**
     * Create user and save email in user_info table
     */
    public function createUser(array $data): int
    {
        $db = $this->db;

        if (empty($data['email'])) {
            throw new \InvalidArgumentException('Email is required');
        }

        $db->transStart();

        // users table
        $db->table('users')->insert([
            'username'   => $data['username'],
            'status'     => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $userId = $db->insertID();

        // user_info table
         $db->table('user_info')->insert([
            'user_id'    => $userId,
            'email'      => $data['email'],
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'contact_no' => $data['contact_no'] ?? null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            throw new \RuntimeException('Failed to create user');
        }

        return $userId;
    }
     public function updateUserWithInfo(int $id, array $data): bool
    {
        $this->db->transStart();

        // Update users table
        $this->update($id, [
            'username' => $data['username']
        ]);

        // Update user_info table
        $this->db->table('user_info')
            ->where('user_id', $id)
            ->update([
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'email'      => $data['email'],
            ]);

        $this->db->transComplete();

        return $this->db->transStatus();
    }
    public function getUserWithInfo(int $id): ?array
{
    return $this->db->table('users u')
        ->select('u.id, u.username, ui.first_name, ui.last_name, ui.email')
        ->join('user_info ui', 'ui.user_id = u.id', 'left')
        ->where('u.id', $id)
        ->get()
        ->getRowArray();
}


 public function softDeleteUser(int $id): bool
    {
        $this->db->transStart();


        $this->delete($id);



        $this->db->transComplete();

        return $this->db->transStatus();
    }

}
