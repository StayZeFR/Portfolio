<?php

namespace App\Models;

use CodeIgniter\Model;
use ReflectionException;

class CategoryModel extends Model
{
    protected $DBGroup = "default";
    protected $table = "category";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ["id", "user_id", "name", "status", "created_at", "updated_at"];

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
     * Cette fonction permet de récupérer une catégorie depuis la base de données et de la retourner en tableau
     *
     * @param int $id L'id de la catégorie à récupérer
     * @return array La catégorie récupérée
     */
    public function getCategory(int $id): array
    {
        $builder = $this->builder();
        $builder->select("category.*");
        $builder->where("id", $id);
        return $builder->get()->getRowArray();
    }

    /**
     * Cette fonction permet de récupérer toutes les catégories depuis la base de données et de les retourner en tableau
     *
     * @param int $user L'id de l'utilisateur à qui appartiennent les catégories
     * @param int $status Le statut des catégories à récupérer
     * @return array Les catégories récupérées
     */
    public function getCategories(int $user, int $status): array
    {
        $builder = $this->builder();
        $builder->select("category.*");
        if ($user !== 0) {
            $builder->where("user_id", $user);
        }
        if ($status !== 0) {
            $builder->where("status", $status);
        }
        return $builder->get()->getResultArray();
    }

    /**
     * Cette fonction permet d'ajouter une catégorie dans la base de données
     *
     * @param array $data Les données de la catégorie à ajouter
     * @return int L'id de la catégorie ajoutée
     * @throws ReflectionException Si une erreur survient lors de l'ajout de la catégorie
     */
    public function addCategory(array $data): int
    {
        $this->insert($data);
        return $this->getInsertID();
    }

    /**
     * Cette fonction permet de mettre à jour une catégorie dans la base de données
     *
     * @param int $id L'id de la catégorie à mettre à jour
     * @param array $data Les données de la catégorie à mettre à jour
     * @return bool Vrai si la catégorie a été mise à jour, faux sinon
     */
    public function updateCategory(int $id, array $data): bool
    {
        $builder = $this->builder();
        $builder->where("id", $id);
        return $builder->update($data);
    }

    /**
     * Cette fonction permet de supprimer une catégorie de la base de données
     *
     * @param int $id L'id de la catégorie à supprimer
     * @return bool Vrai si la catégorie a été supprimée, faux sinon
     */
    public function deleteCategory(int $id): bool
    {
        $builder = $this->builder();
        $builder->where("id", $id);
        return $builder->delete();
    }
}
