<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;

class ProjectsController extends BaseController
{
    public function view(): string
    {
        return view("frontoffice/pages/projects", [
            "page" => "FRONTOFFICE-PROJECTS"
        ]);
    }
}
