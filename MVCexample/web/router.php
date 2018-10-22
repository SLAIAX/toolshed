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
        '/accountNameValidate',
        array(
            '_controller' => 'agilman\a2\controller\AccountController::validateAccNameAction',
            'methods' => 'GET',
            'name' => 'accountNameValidate'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/searchQuery',
        array(
            '_controller' => 'agilman\a2\controller\SearchController::searchAction',
            'methods' => 'GET',
            'name' => 'searchQuery'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/login/submit',
        array(
            '_controller' => 'agilman\a2\controller\AccountController::loginAction',
            'methods' => 'POST',
            'name' => 'loginSubmit'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/browse',
        array(
            '_controller' => 'agilman\a2\controller\HomeController::browseAction',
            'methods' => 'GET',
            'name' => 'browsePage'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/search',
        array(
            '_controller' => 'agilman\a2\controller\HomeController::searchAction',
            'methods' => 'GET',
            'name' => 'searchPage'
        )
    )
);

$collection->attachRoute(
    new Route(
        '/logout',
        array(
            '_controller' => 'agilman\a2\controller\HomeController::logoutAction',
            'methods' => 'GET',
            'name' => 'logoutAction'
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
