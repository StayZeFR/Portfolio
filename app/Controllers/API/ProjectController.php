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

    private const DOCUMENTS_PATH = "assets/resources/projects/documents/";
    private const IMAGES_PATH = "assets/resources/projects/images/";

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
        $user = $this->request->getGet("user") ?? "";
        $category = $this->request->getGet("category") ?? "";
        $status = $this->request->getGet("status") ?? "";

        $builder = $manager->builder();
        $builder->select("project.*, category.name AS category_name");
        $builder->join("category", "category.id = project.category_id");

        if ($user !== "") {
            $builder->where("project.user_id", $user);
            $builder->where("category.user_id", $user);
        }

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
            "description" => trim($values["description"]),
            "status" => intval(trim($values["status"])),
            "user_id" => intval(trim($values["user"]))
        ];
        $manager->insert($data);
        $id = $manager->getInsertID();

        if (!empty($values["image"])) {
            $name = "img_" . $id;
            $base64data = substr($values["image"], strpos($values["image"], ",") + 1);
            try {
                if (!is_dir(self::IMAGES_PATH)) {
                    mkdir(self::IMAGES_PATH, 0777, true);
                }
                write_file(self::IMAGES_PATH . $name . ".png", base64_decode($base64data));
            } catch (Exception $e) {
                $this->response->setStatusCode(500);
                return $this->response->setJSON(["message" => $e->getMessage()]);
            }
            $manager->update($id, ["image_path" => self::IMAGES_PATH . $name . ".png"]);
        }

        $manager = new ProjectFileModel();
        $data = [];
        foreach ($values["files"] as $file) {
            $name = "doc_" . strtolower(str_replace(" ", "", trim($file["name"])));
            $path = self::DOCUMENTS_PATH . $id . "/";
            try {
                $base64data = substr($file["file"], strpos($file["file"], ",") + 1);
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                write_file($path . $name . ".pdf", base64_decode($base64data));
            } catch (Exception $e) {
                $this->response->setStatusCode(500);
                return $this->response->setJSON(["message" => $e->getMessage()]);
            }
            $data[] = [
                "project_id" => $id,
                "name" => trim($file["name"]),
                "file_path" => $path . $name . ".pdf"
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
        $id = $this->request->getPost("id");
        $manager = new ProjectModel();
        $path = "documents/" . $id . "/";
        rmdir($path);
        $manager->delete($id);
        $manager = new ProjectFileModel();
        $manager->where("project_id", $id)->delete();
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
