<?php

namespace App\Controller;


use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;
use Twig\Environment;


class FormPageController implements RequestHandlerInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $response = new Response();
        $response->getBody()->write($this->twig->render('form.html.twig', ["title" => "Avec DI"]));

        return $response;
    }
}