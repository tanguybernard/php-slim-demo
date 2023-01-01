<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

return function (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $routeContext = RouteContext::fromRequest($request);
    $route = $routeContext->getRoute();

    if (empty($route)) {
        throw new HttpNotFoundException($request);
    }
    $routeName = $route->getName();

    //par defaut, si pas de nom de route alors assigner "protected"
    if(!isset($routeName)){
        $routeName = "protected";
    }

    // Define routes that user does not have to be logged in with. All other routes, the user needs to be logged in with.
    // Names for routes must be defined in routes.php with ->setName() for each one.
    $publicRoutesArray = array('root', 'login');

    //var_dump("User ID: " . (empty($_SESSION['user']) ? ' none' : $_SESSION['user']));
    if (empty($_SESSION['user']) && (!in_array($routeName, $publicRoutesArray))) {
        // Create a redirect for a named route
        $routeParser = $routeContext->getRouteParser();
        $url = $routeParser->urlFor('login');
        //var_dump("Failed");
        $response = new Response();

        return $response->withHeader('Location', $url)->withStatus(302);
    } else {
        $response = $handler->handle($request);
        return $response;
    }
};
