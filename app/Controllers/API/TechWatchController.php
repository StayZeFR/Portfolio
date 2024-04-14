<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\TechnologyWatchModel;
use CodeIgniter\HTTP\ResponseInterface;

class TechWatchController extends BaseController
{

    /**
     * Cette fonction retourne les informations de la veille technologique
     *
     * @param int $user
     * @return ResponseInterface
     */
    public function getTechnologyWatch(int $user): ResponseInterface
    {
        $manager = new TechnologyWatchModel();
        $technologyWatch = $manager->getTechnologyWatch($user);

        $this->response->setStatusCode(200);
        return $this->response->setJSON($technologyWatch);
    }

    /**
     * Cette fonction permet de changer le statut du flux RSS
     *
     * @param int $user
     * @return ResponseInterface
     */
    public function setStatusRssFeed(int $user): ResponseInterface
    {
        $status = intval($this->request->getPost("status"));
        $manager = new TechnologyWatchModel();
        $manager->setStatusRssFeed($user, $status);

        $this->response->setStatusCode(200);
        return $this->response->setJSON([
            "message" => "State updated"
        ]);

    }

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