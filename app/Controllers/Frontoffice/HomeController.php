<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function view(): string
    {
        return view("frontoffice/pages/home", [
            "page" => "FRONTOFFICE-HOME"
        ]);
    }
}
