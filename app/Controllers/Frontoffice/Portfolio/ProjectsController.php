<?php

namespace App\Controllers\Frontoffice\Portfolio;

use App\Controllers\BaseController;

class ProjectsController extends BaseController
{
    public function view(): string
    {
        return view("frontoffice/portfolio/pages/projects", [
            "page" => "FRONTOFFICE-PROJECTS"
        ]);
    }
}
