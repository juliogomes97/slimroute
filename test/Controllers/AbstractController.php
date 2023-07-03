<?php declare(strict_types=1);

namespace SlimRoute_Test\Controllers;

use SlimRoute\Http\HttpRequest;

abstract class AbstractController extends \SlimRoute\Routing\Controller
{
    protected string $title;

    public function __construct(HttpRequest $httpRequest)
    {
        parent::__construct($httpRequest);

        $this->title = 'Olá Mundo!';
    }
}