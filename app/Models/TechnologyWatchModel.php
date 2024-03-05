<?php

namespace App\Models;

use CodeIgniter\Model;

class TechnologyWatchModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "technology_watch";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ["id", "user_id", "description", "link_status", "updated_by"];

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
     * Cette fonction retourne les informations de la veille technologique
     *
     * @param int $user L'identifiant de l'utilisateur
     * @return array Les liens de veille technologique
     */
    public function getTechnologyWatch(int $user): array
    {
        $builder = $this->builder();
        $builder->select("id, user_id, description, link_status, created_at");
        $builder->where("user_id", $user);
        return $builder->get()->getResultArray();
    }

    /**
     * Cette fonction retourne les liens de veille technologique d'un utilisateur
     *
     * @param int $user L'identifiant de l'utilisateur
     * @return array Les liens de veille technologique
     */
    public function getLinks(int $user): array
    {
        $builder = $this->builder();
        $builder->select("user_id, technology_watch_id, link, status, created_at");
        $builder->join("technology_watch_link", "technology_watch_link.technology_watch_id = technology_watch.id");
        $builder->where("user_id", $user);
        return $builder->get()->getResultArray();
    }
}
