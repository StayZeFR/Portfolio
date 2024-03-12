<?php

namespace App\Controllers\Frontoffice\Portfolio;

use App\Controllers\BaseController;
use App\Models\FluxRssModel;

class TechnologyWatchController extends BaseController
{
    public function view(): string
    {
        $manager = new FluxRssModel();
        $flux = $manager->read([
            "https://news.mit.edu/rss/topic/artificial-intelligence2",
            "https://blogs.nvidia.com/feed/"
        ]);

        return view("frontoffice/portfolio/pages/techwatch", [
            "page" => "FRONTOFFICE-TECHWATCH",
            "flux" => $flux
        ]);
    }
}
