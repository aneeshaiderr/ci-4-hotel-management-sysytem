<?php

namespace App\Libraries;

use Config\Database;
use CodeIgniter\Shield\Models\UserModel;

class UserInfoLibrary
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Magic Method Handler
     */
    public function __call($method, $arguments)
    {
        if ($method === 'userCreated') {
            return $this->storeUserInfo();
        }

        throw new \BadMethodCallException("Method {$method} not supported.");
    }

    /**
     * Save email to user_info table
     */
    protected function storeUserInfo(): bool
    {
        $userModel = new UserModel();

        // Last created user (Shield)
        $user = $userModel->orderBy('id', 'DESC')->first();

        if (!$user) {
            return false;
        }

        // Prevent duplicate insert
        $exists = $this->db->table('user_info')
            ->where('user_id', $user->id)
            ->countAllResults();

        if ($exists) {
            return true;
        }

        return (bool) $this->db->table('user_info')->insert([
            'user_id'    => $user->id,
            'email'      => $user->email,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
