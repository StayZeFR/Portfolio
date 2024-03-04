<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "project";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ["id", "user_id", "title", "status", "description", "image_path", "category_id", "created_at", "updated_at"];

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
     * Cette méthode permet de récupérer un projet par son identifiant
     *
     * @param int $user Identifiant de l'utilisateur
     * @param int $category Identifiant de la catégorie
     * @param int $status Statut du projet
     * @return array Résultat de la requête
     */
    public function getProjects(int $user, int $category, int $status): array
    {
        $builder = $this->builder();
        $builder->select("project.*, category.name AS category_name");
        $builder->join("category", "category.id = project.category_id");

        if ($user !== 0) {
            $builder->where("project.user_id", $user);
            $builder->where("category.user_id", $user);
        }

        if ($category !== 0) {
            $builder->where("category_id", $category);
        }
        if ($status !== -1) {
            $builder->where("project.status", $status);
            $builder->where("category.status", $status);
        }
        return $builder->get()->getResultArray();
    }

    /**
     * Cette méthode permet de récupérer un projet par son identifiant
     * @param int $id Identifiant du projet
     * @return array Résultat de la requête
     */
    public function getProject(int $id): array
    {
        $builder = $this->builder();
        $builder->select("project.*, category.name AS category_name");
        $builder->join("category", "category.id = project.category_id");
        $builder->where("project.id", $id);
        return $builder->get()->getRowArray();
    }
}
