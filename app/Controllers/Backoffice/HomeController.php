<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class HomeController extends BaseController
{
    public function view(): string
    {
        return view("pages/backoffice/home", [
            "page" => "BACKOFFICE-HOME"
        ]);
    }
}
