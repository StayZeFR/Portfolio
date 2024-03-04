<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\TechnologyWatchModel;
use CodeIgniter\HTTP\ResponseInterface;

class TechWatchController extends BaseController
{
    /**
     * Cette fonction retourne les liens de veille technologique d'un utilisateur
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return ResponseInterface
     */
    public function getLinks(int $id): ResponseInterface
    {
        $manager = new TechnologyWatchModel();
        $links = $manager->getLinks($id);

        $this->response->setStatusCode(200);
        return $this->response->setJSON($links);
    }
}