<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class LoginController extends BaseController
{
    public function view(): string
    {
        return view("backoffice/pages/login", [
            "page" => "BACKOFFICE-LOGIN",
            "message" => session()->getFlashdata("error") ?? ""
        ]);
    }

    /**
     * Permet de connecter un utilisateur
     * @return RedirectResponse
     */
    public function login(): RedirectResponse
    {
        $manager = new UserModel();

        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = $manager->where("username", $username)->first();

        if ($user) {
            if (password_verify($password, $user["password"])) {
                session()->set("user", $user);
                session()->set("isLoggedIn", true);
                return redirect()->to(url_to("BACKOFFICE-HOME"));
            }
        }
        session()->setFlashdata("error", "Nom d'utilisateur ou mot de passe incorrect !");
        return redirect()->to(url_to("BACKOFFICE-LOGIN"));
    }
}
