<?php declare(strict_types=1);

namespace SlimRoute\Routing;

use SlimRoute\Http\HttpRequest;

abstract class Controller
{
    protected readonly HttpRequest $httpRequest;

    public function __construct(HttpRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }
}