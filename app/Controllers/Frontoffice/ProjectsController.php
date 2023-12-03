<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;

class ProjectsController extends BaseController
{
    public function view(): string
    {
        return view("pages/frontoffice/projects", [
            "page" => "FRONTOFFICE-PROJECTS"
        ]);
    }
}
