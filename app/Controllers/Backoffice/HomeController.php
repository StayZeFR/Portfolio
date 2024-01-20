<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class HomeController extends BaseController
{
    public function view(): string
    {
        return view("backoffice/pages/home", [
            "page" => "BACKOFFICE-HOME"
        ]);
    }
}
