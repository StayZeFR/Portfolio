<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function view(): string
    {
        return view("pages/frontoffice/home", [
            "page" => "FRONTOFFICE-HOME"
        ]);
    }
}
