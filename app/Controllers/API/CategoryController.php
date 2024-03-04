<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

class CategoryController extends BaseController
{
    /**
     * Cette fonction permet de récupérer une catégorie depuis la base de données et de la retourner en JSON
     *
     * @param int $id L'id de la catégorie à récupérer
     * @return ResponseInterface
     */
    public function getCategory(int $id): ResponseInterface
    {
        $manager = new CategoryModel();
        $category = $manager->getCategory($id);
        $this->response->setStatusCode(200);
        return $this->response->setJSON($category);
    }

    /**
     * Cette fonction permet de récupérer toutes les catégories depuis la base de données et de les retourner en JSON
     *
     * @return ResponseInterface
     */
    public function getCategories(): ResponseInterface
    {
        $manager = new CategoryModel();
        $user = $this->request->getGet("user") ?? 0;
        $status = $this->request->getGet("status") ?? 0;

        $categories = $manager->getCategories($user, $status);

        $this->response->setStatusCode(200);
        return $this->response->setJSON($categories);
    }

    /**
     * Cette fonction permet d'ajouter une catégorie dans la base de données
     *
     * @return ResponseInterface
     * @throws ReflectionException Si une erreur survient lors de l'ajout de la catégorie
     */
    public function addCategory(): ResponseInterface
    {
        $params = $this->request->getPost();
        $name = trim($params["name"]);
        $status = intval(trim($params["status"]));
        $user = intval(trim($params["user"]));

        $manager = new CategoryModel();
        $data = [
            "name" => $name,
            "status" => $status,
            "user_id" => $user
        ];
        $manager->addCategory($data);

        $this->response->setStatusCode(200);
        return $this->response->setJSON(["message" => "Category added successfully"]);
    }

    /**
     * Cette fonction permet de mettre à jour une catégorie dans la base de données
     *
     * @param int $id L'id de la catégorie à mettre à jour
     * @return ResponseInterface
     */
    public function updateCategory(int $id): ResponseInterface
    {
        $manager = new CategoryModel();
        $params = $this->request->getPost();

        $data = [
            "name" => $params["name"],
            "status" => $params["status"],
            "user_id" => $params["user"]
        ];
        $result = $manager->updateCategory($id, $data);

        $this->response->setStatusCode($result ? 200 : 500);
        return $this->response->setJSON(["message" => $result ? "Category updated successfully" : "An error occurred"]);
    }

    /**
     * Cette fonction permet de supprimer une catégorie de la base de données
     *
     * @param int $id L'id de la catégorie à supprimer
     * @return ResponseInterface
     */
    public function deleteCategory(int $id): ResponseInterface
    {
        $manager = new CategoryModel();
        $result = $manager->deleteCategory($id);
        $this->response->setStatusCode($result ? 200 : 500);
        return $this->response->setJSON(["message" => $result ? "Category deleted successfully" : "An error occurred"]);
    }

}
