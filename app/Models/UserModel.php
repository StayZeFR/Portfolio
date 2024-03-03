<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "user";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ["id", "username", "first_name", "last_name", "password", "email", "created_at"];

    protected $useTimestamps = false;
    protected $dateFormat = "datetime";
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField = "deleted_at";

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get user by id
     * @param int $id
     * @return array
     */
    public function getUser(int $id): array
    {
        $builder = $this->builder();
        $builder->select("id, username, first_name, last_name, email");
        $builder->where("id", $id);
        return $builder->get()->getRowArray();
    }

    /**
     * Update user by id
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUser(int $id, array $data): bool
    {
        $builder = $this->builder();
        $builder->where("id", $id);
        return $builder->update($data);
    }
}
