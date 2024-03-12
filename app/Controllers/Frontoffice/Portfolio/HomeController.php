<?php

namespace App\Controllers\Frontoffice\Portfolio;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function view(): string
    {
        return view("frontoffice/portfolio/pages/home", [
            "page" => "FRONTOFFICE-HOME"
        ]);
    }
}
