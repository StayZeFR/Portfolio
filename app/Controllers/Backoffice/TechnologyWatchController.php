<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;

class TechnologyWatchController extends BaseController
{
    public function view(): string
    {
        return view("backoffice/pages/techwatch", [
            "page" => "BACKOFFICE-TECHWATCH"
        ]);
    }
}