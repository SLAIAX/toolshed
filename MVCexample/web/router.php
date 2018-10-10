<?php
use PHPRouter\RouteCollection;
use PHPRouter\Router;
use PHPRouter\Route;

$collection = new RouteCollection();

// example of using a redirect to another route
$collection->attachRoute(
    new Route(
        '/',
        array(
            '_controller' => 'agilman\a2\controller\HomeController::indexAction',
            'methods' => 'GET',
            'name' => 'loginPage'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/home',
        array(
            '_controller' => 'agilman\a2\controller\HomeController::homeAction',
            'methods' => 'GET',
            'name' => 'homePage'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/search',
        array(
            '_controller' => 'agilman\a2\controller\SearchController::indexAction',
            'methods' => 'GET',
            'name' => 'searchPage'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/account/',
        array(
        '_controller' => 'agilman\a2\controller\AccountController::indexAction',
        'methods' => 'GET',
        'name' => 'accountIndex'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/account/create/',
        array(
        '_controller' => 'agilman\a2\controller\AccountController::createPageAction',
        'methods' => 'GET',
        'name' => 'accountCreate'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/account/create/submit',
        array(
            '_controller' => 'agilman\a2\controller\AccountController::createAction',
            'methods' => 'POST',
            'name' => 'accountCreateSubmit'
        )
    )
);


$router = new Router($collection);
$router->setBasePath('/');
