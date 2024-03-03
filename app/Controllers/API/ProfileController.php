<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class ProfileController extends BaseController
{
    /**
     * Get profile by id
     * @param int $id
     * @return ResponseInterface
     */
    public function getProfile(int $id): ResponseInterface
    {
        $manager = new ProfileModel();
        $profile = $manager->getProfile($id);
        $this->response->setStatusCode(200);
        return $this->response->setJSON($profile);
    }

    /**
     * Update profile by id
     * @param int $id
     * @return ResponseInterface
     */
    public function updateProfile(int $id): ResponseInterface
    {
        helper(["filesystem"]);

        $manager = new UserModel();
        $data = $this->request->getPost();
        $firstName = str_replace(" ", "", $data["firstname"]);
        $lastname = str_replace(" ", "", $data["lastname"]);
        $email = str_replace(" ", "", $data["email"]);
        $username = $firstName . "." . $lastname;
        $params = [
            "username" => $username,
            "first_name" => $firstName,
            "last_name" => $lastname,
            "email" => $email
        ];
        $manager->updateUser($id, $params);
        $manager = new ProfileModel();
        $description = trim($data["description"]);
        $logo = "";
        $cv = "";
        $ts = "";
        $path = "assets/resources/profiles/" . $id . "/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if (!empty($data["logo"])) {
            $logo = $path . "logo.png";
            $base64data = substr($data["logo"], strpos($data["logo"], ",") + 1);
            try {
                write_file($logo, base64_decode($base64data));
            } catch (Exception $e) {
                $this->response->setStatusCode(500);
                return $this->response->setJSON(["message" => $e->getMessage()]);
            }
        }
        if (!empty($data["cv"])) {
            $cv = $path . "cv.pdf";
            $base64data = substr($data["cv"], strpos($data["cv"], ",") + 1);
            try {
                write_file($cv, base64_decode($base64data));
            } catch (Exception $e) {
                $this->response->setStatusCode(500);
                return $this->response->setJSON(["message" => $e->getMessage()]);
            }
        }
        if (!empty($data["ts"])) {
            $ts = $path . "ts.pdf";
            $base64data = substr($data["ts"], strpos($data["ts"], ",") + 1);
            try {
                write_file($ts, base64_decode($base64data));
            } catch (Exception $e) {
                $this->response->setStatusCode(500);
                return $this->response->setJSON(["message" => $e->getMessage()]);
            }
        }
        $params = [
            "body" => $description,
        ];
        if (isset($data["logo"])) {
            $params["logo_path"] = $logo;
        }
        if (isset($data["cv"])) {
            $params["cv_path"] = $cv;
        }
        if (isset($data["ts"])) {
            $params["ts_path"] = $ts;
        }
        $manager->updateProfile($id, $params);
        $this->response->setStatusCode(200);
        return $this->response->setJSON(["message" => "Profile updated"]);
    }

}