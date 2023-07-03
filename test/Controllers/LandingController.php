<?php declare(strict_types=1);

namespace SlimRoute_Test\Controllers;

class LandingController extends AbstractController
{
    public function hello()
    {
        echo "<h1>$this->title</h1>";
    }
}