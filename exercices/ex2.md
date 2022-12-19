# Exercise 2

## Objective

- Explain dependency injection
- Use dependency injection

## Statement

### Install PHP-DI

    composer require php-di/php-di


### Declare into slim

    use DI\ContainerBuilder;
    use Slim\Factory\AppFactory;
    
    $containerBuilder = new ContainerBuilder();
    // configure PHP-DI here
    
    AppFactory::setContainer($containerBuilder->build());
    $app = AppFactory::create();

### Config

    $containerBuilder->addDefinitions([
         Environment::class => function () : Environment{
            $loader = new FilesystemLoader(__DIR__ . '/templates');
            $twig = new Environment($loader, [
                __DIR__ . '/../var/cache'
            ]);

            return $twig;
        }
    ]);


### Use

Controller

    // HomePageHandler.php
    class HomePageHandler implements RequestHandlerInterface
    {
    private $twig;
    
        public function __construct(\Twig\Environment $twig)
        {
            $this->twig = $twig;
        }
    
        public function handle(ServerRequestInterface $request): ResponseInterface
        { 
            $response = new Response();
            $response->getBody()->write(
                $this->twig->render('home-page.twig', ['title' => 'home'])
            );
            return $response;
        }
    }


Route

    $app->get('/home', HomePageHandler::class);