<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "profile";
    protected $primaryKey = "user_id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ["user_id", "body", "logo_path", "status"];

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
     * Get profile by id
     * @param int $id
     * @return array
     */
    public function getProfile(int $id): array
    {
        $builder = $this->builder();
        $builder->select("user.id, username, first_name, last_name, email, body, logo_path, cv_path, ts_path");
        $builder->join("user", "user.id = profile.user_id");
        $builder->where("user.id", $id);
        return $builder->get()->getRowArray();
    }

    /**
     * Update profile
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateProfile(int $id, array $data): bool
    {
        $builder = $this->builder();
        $builder->where("user_id", $id);
        return $builder->update($data);
    }
}
