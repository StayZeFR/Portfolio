<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

class CategoryController extends BaseController
{
    /**
     * Get a type project from database and return it as JSON
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function getCategory(int $id): ResponseInterface
    {
        $manager = new CategoryModel();
        $category = $manager->find($id);
        $this->response->setStatusCode(200);
        return $this->response->setJSON($category);
    }

    /**
     * Get all type projects from database and return them as JSON
     *
     * @return ResponseInterface
     */
    public function getCategories(): ResponseInterface
    {
        $manager = new CategoryModel();
        $user = $this->request->getGet("user") ?? "";
        $status = $this->request->getGet("status") ?? "";

        $builder = $manager->builder();
        $builder->select("category.*");

        if ($user !== "") {
            $builder->where("user_id", $user);
        }

        if ($status !== "") {
            $builder->where("status", $status);
        }

        $categories = $builder->get()->getResultArray();
        return $this->response->setJSON($categories);
    }

    /**
     * Add a new type project in database
     *
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function addCategory(): ResponseInterface
    {
        $name = trim($this->request->getPost("name"));
        $status = intval(trim($this->request->getPost("status")));
        $user = intval(trim($this->request->getPost("user")));

        $manager = new CategoryModel();
        $data = [
            "name" => $name,
            "status" => $status,
            "user_id" => $user
        ];
        $manager->insert($data);

        $this->response->setStatusCode(201);
        return $this->response->setJSON(["status" => "success", "message" => "Category created successfully"]);
    }

    /**
     * Delete a type project from database
     *
     * @return ResponseInterface
     */
    public function deleteCategory(): ResponseInterface
    {
        $manager = new CategoryModel();
        $data = $this->request->getPost();
        $manager->delete($data["id"]);
        $this->response->setStatusCode(200);
        return $this->response->setJSON(["status" => "success", "message" => "Category deleted successfully"]);
    }

    /**
     * Update a type project in database
     *
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function updateCategory(): ResponseInterface
    {
        $manager = new CategoryModel();
        $data = $this->request->getPost();
        $manager->update($data["id"], $data);
        $this->response->setStatusCode(200);
        return $this->response->setJSON(["status" => "success", "message" => "Category updated successfully"]);
    }
}
