<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
 * --------------------------------------------------------------------
 * FRONT OFFICE ROUTES
 * --------------------------------------------------------------------
 */

$routes->group("", ["filter" => "profile"], function (RouteCollection $routes) {
    $routes->get("/", "Frontoffice\HomeController::view", ["as" => "FRONTOFFICE-HOME"]);
    $routes->get("/profile", "Frontoffice\ProfileController::view", ["as" => "FRONTOFFICE-PROFILE"]);
    $routes->get("/projects", "Frontoffice\ProjectsController::view", ["as" => "FRONTOFFICE-PROJECTS"]);
    $routes->get("/technology-watch", "Frontoffice\TechnologyWatchController::view", ["as" => "FRONTOFFICE-TECHWATCH"]);
});

/*
 * --------------------------------------------------------------------
 * BACK OFFICE ROUTES
 * --------------------------------------------------------------------
 */
$routes->get("/login", "Backoffice\LoginController::view", ["as" => "BACKOFFICE-LOGIN"]);
$routes->post("/login", "Backoffice\LoginController::login", ["as" => "BACKOFFICE-LOGIN-POST"]);

$routes->group("backoffice", ["filter" => "authGuard"], function (RouteCollection $routes) {
    $routes->get("", "Backoffice\HomeController::view", ["as" => "BACKOFFICE-HOME"]);
    $routes->get("profile", "Backoffice\ProfileController::view", ["as" => "BACKOFFICE-PROFILE"]);
    $routes->get("projects", "Backoffice\ProjectsController::view", ["as" => "BACKOFFICE-PROJECTS"]);
    $routes->get("technology-watch", "Backoffice\TechnologyWatchController::view", ["as" => "BACKOFFICE-TECHWATCH"]);
});

/*
 * --------------------------------------------------------------------
 * API ROUTES
 * --------------------------------------------------------------------
 */
$routes->group("api", function (RouteCollection $routes) {

    $routes->group("projects", function (RouteCollection $routes) {
        $routes->post("(:num)", "API\ProjectController::getProject/$1");
        $routes->post("list", "API\ProjectController::getProjects");
        $routes->post("add", "API\ProjectController::addProject");
        $routes->post("delete/(:num)", "API\ProjectController::deleteProject/$1");
        $routes->post("update", "API\ProjectController::updateProject");
        $routes->post("files/(:num)", "API\ProjectController::getProjectFiles/$1");
    });

    $routes->group("categories", function (RouteCollection $routes) {
        $routes->post("(:num)", "API\CategoryController::getCategory/$1");
        $routes->post("list", "API\CategoryController::getCategories");
        $routes->post("add", "API\CategoryController::addCategory");
        $routes->post("delete/(:num)", "API\CategoryController::deleteCategory/$1");
        $routes->post("update/(:num)", "API\CategoryController::updateCategory/$1");
    });

    $routes->group("profile", function (RouteCollection $routes) {
        $routes->post("(:num)", "API\ProfileController::getProfile/$1");
        $routes->post("update/(:num)", "API\ProfileController::updateProfile/$1");
    });

    $routes->group("techwatch", function (RouteCollection $routes) {
        $routes->post("links/(:num)", "API\TechWatchController::getLinks/$1");
    });

});

