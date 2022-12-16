<?php

require __DIR__ . '/../vendor/autoload.php';

use Config\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


$app = AppFactory::create();


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


$app->get('/form', function (Request $request, Response $response, $args) {
    $twig = Twig::get();
    $response->getBody()->write($twig->render('form.html.twig', ['name' => 'John Doe',
        'occupation' => 'gardener']));

    return $response;
});

$app->post('/myform', function (Request $request, Response $response, $args) {

    $form = $request->getParsedBody();//[name]
    //var_dump($form);
    //var_dump($form['name']);
    //var_dump($form['email']);

    return $response;
});


$app->run();