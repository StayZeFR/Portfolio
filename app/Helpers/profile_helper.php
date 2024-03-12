<?php

use App\Models\UserModel;

/**
 * Get the profile of a user
 *
 * @param string $username
 * @return bool
 */
function getProfile(string $username): bool
{
    $check = !empty(session()->get("user")) && session()->get("user")["username"] === $username;
    if ((empty(session()->get("user")) || session()->get("user")["username"] !== $username)) {
        $manager = new UserModel();
        $builder = $manager->builder();
        $builder->select("id, username, first_name, last_name, email");
        $builder->where("username", $username);
        $result = $builder->get()->getRowArray();

        session()->set("user", $result);

        $check = !empty($result);
    }
    return $check;
}