<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
         'service_name',
        'price',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];


    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
      public function getAll()
    {
        return $this->select('id, service_name, price, status')
                    ->where('deleted_at', null)
                    ->findAll();
    }


    public function all()
    {
        return $this->getAll();
    }


    public function getAllServicesList()
    {
        return $this->select('id, service_name, price, status')
                    ->where('deleted_at', null)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }


    public function createService(array $data)
    {
        return $this->insert([
            'service_name' => $data['service_name'],
            'price'        => $data['price'],
            'status'       => $data['status'],
        ]);
    }


    public function getById($id)
    {
        return $this->where('id', $id)
                    ->where('deleted_at', null)
                    ->first();
    }


    public function updateService($id, array $data)
    {
        return $this->update($id, [
            'service_name' => $data['service_name'],
            'price'        => $data['price'],
            'status'       => $data['status'],
        ]);
    }


    public function softDeleteService($id)
    {
        return $this->delete($id);
    }


    public function getAllServices()
    {
        return $this->orderBy('created_at', 'ASC')
                    ->findAll();
    }

}
