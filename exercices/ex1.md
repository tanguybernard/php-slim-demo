# Exercise 1


## Objective

- Explain how template engine work.
- Employ a template engine.

### Install Twig

    composer require "twig/twig:^3.0"

### Create a templates folder to place your view

    mkdir templates

### Twig configuration first.php

    <?php
    
    require __DIR__ . '/vendor/autoload.php';
    
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);
    
    echo $twig->render('first.html.twig', ['name' => 'John Doe', 
        'occupation' => 'gardener']);

### Create template first.html.twig

    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    
    <body>
    
        <p>
            {{ name }} is a {{ occupation }}
        </p>
    
    </body>
    
    </html>