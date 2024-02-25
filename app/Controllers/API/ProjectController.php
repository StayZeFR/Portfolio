<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ProjectFileModel;
use App\Models\ProjectModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
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
        $category = $this->request->getGet("category") ?? "";
        $status = $this->request->getGet("status") ?? "";

        $builder = $manager->builder();
        $builder->select("project.*, category.name AS category_name");
        $builder->join("category", "category.id = project.category_id");

        if ($category !== "") {
            $builder->where("category_id", $category);
        }
        if ($status !== "") {
            $builder->where("project.status", $status);
            $builder->where("category.status", $status);
        }
        $projects = $builder->get()->getResultArray();
        return $this->response->setJSON($projects);
    }

    /**
     * Get all files from a project and return them as JSON
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function getProjectFiles(int $id): ResponseInterface
    {
        $manager = new ProjectFileModel();
        $files = $manager->where("project_id", $id)->findAll();
        return $this->response->setJSON($files);
    }

    /**
     * Add a new project in database
     *
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function addProject(): ResponseInterface
    {
        helper(["filesystem"]);

        $manager = new ProjectModel();
        $values = json_decode($this->request->getBody(), true);
        $data = [
            "category_id" => intval(trim($values["category"])),
            "title" => trim($values["title"] ?? ""),
            "status" => intval(trim($values["status"])),
            "user_id" => intval(trim($values["user"])),
        ];
        $manager->insert($data);
        $id = $manager->getInsertID();

        $manager = new ProjectFileModel();
        $data = [];
        foreach ($values["files"] as $file) {
            $name = trim($file["name"]);
            $path = "documents/" . $id . "_" . $name . ".pdf";
            try {
                $base64data = substr($file["file"], strpos($file["file"], ",") + 1);
                write_file($path, base64_decode($base64data));
            } catch (Exception $e) {
                $this->response->setStatusCode(500);
                return $this->response->setJSON(["message" => $e->getMessage()]);
            }
            $data[] = [
                "project_id" => $id,
                "name" => $name,
                "file_path" => $path
            ];
        }
        $manager->insertBatch($data);
        $this->response->setStatusCode(201);
        return $this->response->setJSON(["message" => "Project created successfully."]);
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
