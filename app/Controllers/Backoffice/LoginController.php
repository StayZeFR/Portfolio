<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class LoginController extends BaseController
{
    public function view(): string
    {
        return view("pages/backoffice/login", [
            "page" => "BACKOFFICE-LOGIN",
            "message" => session()->getFlashdata("error") ?? ""
        ]);
    }

    /**
     * Login user to backoffice
     *
     * @return RedirectResponse
     */
    public function login(): RedirectResponse
    {
        $manager = new UserModel();

        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = $manager->where("USERNAME", $username)->first();

        if ($user) {
            if (password_verify($password, $user["PASSWORD"])) {
                return redirect()->to("/backoffice");
            }
        }
        session()->setFlashdata("error", "Nom d'utilisateur ou mot de passe incorrect !");
        return redirect()->to("/login");
    }
}
