<?php declare(strict_types=1);

    include __DIR__ . '/../vendor/autoload.php';

    use SlimRoute\Routing\Route;

    $route = new Route;

    // Iniciar o controlador LandingController como página inicial
    $route->get('', \SlimRoute_Test\Controllers\LandingController::class, 'get');

    // Exemplo de buscar parametros na url
    $route->add('GET', '/utilizador/{user_id:[0-9]+}', \SlimRoute_Test\Controllers\UserController::class, 'get');

    // Caso nenhuma das rotas for encontradas, o controlador NotFoundController será chamado
    $route->fallback(\SlimRoute_Test\Controllers\NotFoundController::class, 'get');