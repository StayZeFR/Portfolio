<?php

use App\Models\UserModel;

/**
 * Get the profile of a user
 *
 * @param string $username
 * @return void
 */
function getProfile(string $username): void
{
    if (empty(session()->get("user")) || session()->get("user")["username"] !== $username) {
        $manager = new UserModel();
        $builder = $manager->builder();
        $builder->select("id, username, first_name, last_name, email");
        $builder->where("username", $username);

        session()->set("user", $builder->get()->getRowArray());
    }
}