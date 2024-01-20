<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProjectsController extends BaseController
{
    public function view(): string
    {
        return view("backoffice/pages/projects", [
            "page" => "BACKOFFICE-PROJECTS"
        ]);
    }
}
