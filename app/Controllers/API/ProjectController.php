<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

class ProjectController extends BaseController
{
    /**
     * Get a project from database and return it as JSON
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function getProject(int $id): ResponseInterface
    {
        $manager = new ProjectModel();
        $project = $manager->find($id);
        return $this->response->setJSON($project);
    }

    /**
     * Get all projects from database and return them as JSON
     *
     * @return ResponseInterface
     */
    public function getProjects(): ResponseInterface
    {
        $manager = new ProjectModel();

        $builder = $manager->builder();
        $builder->select("p.ID_PROJECT AS ID, CONCAT(p.ID_CATEGORY, ' - ', c.NAME) AS CATEGORY, p.TITLE AS TITLE, CONCAT(p.ID_USER_CREATION, ' - ', u.USERNAME) AS USER_CREATION, p.DATE_CREATION AS DATE_CREATION, CONCAT(p.ID_USER_MODIFICATION, ' - ', u.USERNAME) AS USER_MODIFICATION, p.DATE_MODIFICATION AS DATE_MODIFICATION, p.STATUS AS STATUS");
        $builder->from("project p");
        $builder->join("category c", "c.ID_CATEGORY = p.ID_CATEGORY", "left");
        $builder->join("user u", "u.ID_USER = p.ID_USER_CREATION OR u.ID_USER = p.ID_USER_MODIFICATION", "left");
        $builder->groupBy("p.ID_PROJECT");
        $projects = $builder->get()->getResult();

        return $this->response->setJSON($projects);
    }

    /**
     * Add a new project in database
     *
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function addProject(): ResponseInterface
    {
        $manager = new ProjectModel();
        $values = $this->request->getPost();
        $data = [
            "ID_CATEGORY" => intval(trim($values["category"])),
            "TITLE" => trim($values["title"] ?? ""),
            "TEXT" => trim($values["text"] ?? ""),
            "STATUS" => intval(trim($values["status"])),
        ];
        $manager->insert($data);
        return $this->response->setStatusCode(201);
    }

    /**
     * Delete a project from database
     *
     * @return ResponseInterface
     */
    public function deleteProject(): ResponseInterface
    {
        $manager = new ProjectModel();
        $data = $this->request->getPost();
        $manager->delete($data["ID"]);
        return $this->response->setStatusCode(204);
    }

    /**
     * Update a project from database
     *
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function updateProject(): ResponseInterface
    {
        $manager = new ProjectModel();
        $values = $this->request->getPost();
        $data = [
            "ID_CATEGORY" => intval(trim($values["category"])),
            "TITLE" => trim($values["title"] ?? ""),
            "TEXT" => trim($values["text"] ?? ""),
            "STATUS" => intval(trim($values["status"]))
        ];
        $manager->update($values["id"], $data);
        return $this->response->setStatusCode(204);
    }
}
