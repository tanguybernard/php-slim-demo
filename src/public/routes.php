<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

// Group different routes under the same path
return function (App $app) {

    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });


    $app->get('/hello/{name}', function (Request $request, Response $response, $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });

    $app->get('/template-with-ob-start', function(Request $request, Response $response, $args){

        ob_start();
        $title = "Page de test" ;
        $contenu = "Lorem ipsum blabla";
        include '../templates_with_ob_start/template.php' ;
        $content = ob_get_clean();
        $response->getBody()->write($content);
        return $response;
    });

};