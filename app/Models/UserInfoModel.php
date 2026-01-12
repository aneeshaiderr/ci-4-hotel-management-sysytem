<?php

namespace App\Models;

use CodeIgniter\Model;
class UserInfoModel extends Model
{
    protected $table = 'user_info';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['user_id', 'first_name', 'last_name', 'email', 'contact_no', 'created_at'];

    public function getAllEmails(): array
    {
        // Return id (or user_id if you want) and email
        return $this->select('id, email')
                    ->orderBy('email', 'ASC')
                    ->findAll();
    }
}
