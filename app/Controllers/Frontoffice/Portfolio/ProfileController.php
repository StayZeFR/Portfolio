<?php

namespace App\Controllers\Frontoffice\Portfolio;

use App\Controllers\BaseController;
use App\Models\ProfileModel;

class ProfileController extends BaseController
{
    public function view(): string
    {
        $manager = new ProfileModel();
        $profile = $manager->getProfile(session()->get("user")["id"]);

        return view("frontoffice/portfolio/pages/profile", [
            "page" => "FRONTOFFICE-PROFILE",
            "profile" => $profile
        ]);
    }
}
