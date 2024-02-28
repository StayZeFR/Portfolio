<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function view(): string
    {
        return view("backoffice/pages/profile", [
            "page" => "BACKOFFICE-PROFILE"
        ]);
    }
}