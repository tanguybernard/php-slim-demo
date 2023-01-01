<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$containerBuilder = new ContainerBuilder();
// configure PHP-DI here
$containerBuilder->addDefinitions([
    Environment::class => function () : Environment{
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        return new Environment($loader);
    }
]);

AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();


// Setup a supersimple auth checker, intercepting http calls with this middleware
// and checking that only allowed routes can be navigated without auth
$loggedInMiddleware = require(__DIR__.'/../app/middleware/LoggedInMiddleware.php');
$app->add($loggedInMiddleware);

// Add Routing Middleware (needed to use RouteContext previously in middleware, for example)
$app->addRoutingMiddleware();

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);


$app->run();