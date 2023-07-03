<?php declare(strict_types=1);

namespace SlimRoute_Test\Controllers;

class NotFoundController extends AbstractController
{
    public function get()
    {
        echo 'Página não encontrada!';
    }
}