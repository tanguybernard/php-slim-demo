<?php

namespace App;

use App\Controller\FormPageController;
use Config\TwigFactory;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


return function (App $app) {

    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    })->setName('root');


    $app->get('/hello/{name}', function (Request $request, Response $response, $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    })->setName('hello');

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
        $twig = TwigFactory::get();
        $response->getBody()->write($twig->render('form.html.twig', ['name' => 'John Doe',
            'occupation' => 'gardener']));

        return $response;
    });


    $app->get('/form2', FormPageController::class);

    $app->post('/myform', function (Request $request, Response $response, $args) {

        $form = $request->getParsedBody();//[name]
        //var_dump($form);
        //var_dump($form['name']);
        //var_dump($form['email']);

        return $response;
    });


    $app->get('/login',  function (Request $request, Response $response, $args) {
        $response = new \Slim\Psr7\Response();
        $twig = TwigFactory::get();


        $response->getBody()->write($twig->render('login.html.twig'));
        return $response;
    })->setName('login');


    $app->get('/logout',  function (Request $request, Response $response) {

        unset($_SESSION['user']);
        return $response
            ->withHeader('Location', '/login')
            ->withStatus(302);
    });

    $app->post('/login',  function (Request $request, Response $response, $args) {

        $form = $request->getParsedBody();
        $user = $form['user'];
        $pass = $form['pass'];

        //get user
        //mock
        $result = ($user === 'admin');

        $_SESSION['user'] = $user;
        //var_dump("User ID: " . (empty($_SESSION['user']) ? ' none' : $_SESSION['user']));


        if (empty($result) ) {
            return $response
                ->withHeader('Location', '/login')
                ->withStatus(302);
        }

        return $response->withHeader('Location', "/hello/{$user}")->withStatus(302);

    })->setName('login');

};