<?php declare(strict_types=1);

    include __DIR__ . '/../vendor/autoload.php';

    use SlimRoute\Routing\Route;

    $route = new Route;

    $route->get('', function($request) {
        echo 'Hello World!';
    });

    $route->get('/request-data', function($request) {
        var_dump($request);
    });

    $route->get('/{id:[0-9a-z]+}', function($request, $id) {
        var_dump($request);
    });

    $route->get('/user/{id:[0-9]+}', function($request, $id) {
        echo 'User ID:' . $id;
    });

    $route->get('/user/{id:[0-9]+}/post/{post:[A-Z]}', function($request, $id, $post) {
        echo 'User ID:' . $id;
        echo '<br>';
        echo 'Post:' . $post;
    });

    $route->fallback(function($request) {
        echo 'Page Not found!';
    });