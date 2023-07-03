<?php declare(strict_types=1);

namespace SlimRoute_Test\Controllers;

class UserController extends AbstractController
{
    public function get(string $user_id)
    {
        echo "Olá utilizador $user_id";
    }
}