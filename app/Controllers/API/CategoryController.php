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
        $status = $this->request->getGet("status") ?? "";

        $builder = $manager->builder();
        $builder->select("category.*");

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
        $manager = new CategoryModel();
        $data = $this->request->getPost();
        $manager->insert($data);
        return $this->response->setJSON($data);
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
        $manager->delete($data["ID"]);
        return $this->response->setJSON($data);
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
        $manager->update($data["ID"], $data);
        return $this->response->setJSON($data);
    }
}
