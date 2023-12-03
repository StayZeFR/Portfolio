<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function view(): string
    {
        return view("pages/frontoffice/profile", [
            "page" => "FRONTOFFICE-PROFILE"
        ]);
    }
}
