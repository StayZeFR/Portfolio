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
        $projects = $manager->findAll();
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
        $data = $this->request->getPost();
        $manager->insert($data);
        return $this->response->setJSON($data);
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
        return $this->response->setJSON($data);
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
        $data = $this->request->getPost();
        $manager->update($data["ID"], $data);
        return $this->response->setJSON($data);
    }
}
