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
$routes->get("/", "Frontoffice\HomeController::view", ["as" => "FRONTOFFICE-HOME"]);
$routes->get("/profile", "Frontoffice\ProfileController::view", ["as" => "FRONTOFFICE-PROFILE"]);
$routes->get("/projects", "Frontoffice\ProjectsController::view", ["as" => "FRONTOFFICE-PROJECTS"]);
$routes->get("/technology-watch", "Frontoffice\TechnologyWatchController::view", ["as" => "FRONTOFFICE-TECHWATCH"]);


/*
 * --------------------------------------------------------------------
 * BACK OFFICE ROUTES
 * --------------------------------------------------------------------
 */
$routes->get("/login", "Backoffice\LoginController::view", ["as" => "BACKOFFICE-LOGIN"]);
$routes->post("/login", "Backoffice\LoginController::login", ["as" => "BACKOFFICE-LOGIN"]);

$routes->group("backoffice", function (RouteCollection $routes) {
    $routes->get("", "Backoffice\HomeController::view", ["as" => "BACKOFFICE-HOME"]);
    //$routes->get("/backoffice/profile", "Backoffice\ProfileController::view", ["as" => "BACKOFFICE-PROFILE"]);
    $routes->get("projects", "Backoffice\ProjectsController::view", ["as" => "BACKOFFICE-PROJECTS"]);
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
        $routes->post("delete", "API\ProjectController::deleteProject");
        $routes->post("update", "API\ProjectController::updateProject");
    });

    $routes->group("categories", function (RouteCollection $routes) {
        $routes->post("(:num)", "API\CategoryController::getCategory/$1");
        $routes->post("list", "API\CategoryController::getCategories");
        $routes->post("add", "API\CategoryController::addCategory");
        $routes->post("delete", "API\CategoryController::deleteCategory");
        $routes->post("update", "API\CategoryController::updateCategory");
    });

});
