<?php declare(strict_types=1);

namespace SlimRoute\Routing;

use SlimRoute\Http\HttpRequest;

class Route
{
    public readonly HttpRequest $httpRequest;
    
    private bool $found = false;

    public function __construct()
    {
        $this->httpRequest = new HttpRequest;
    }

    public function add(string $method, string $uri, string $controller, string $handler) : void
    {
        if($this->found || $this->httpRequest->method !== $method)
            return;

        $pattern = preg_replace('/\{(\w+):([^}]+)\}/', '(?P<$1>$2)', $uri);
        $pattern = '#^' . $pattern . '$#';
        
        if (preg_match($pattern, $this->httpRequest->uri, $matches))
        {
            $parameters = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

            $this->call($controller, $handler, $parameters);

            $this->found = true;
        }
    }

    public function get(string $uri, string $controller, string $handler) : void
    {
        $this->add('GET', $uri, $controller, $handler);
    }

    public function post(string $uri, string $controller, string $handler) : void
    {
        $this->add('POST', $uri, $controller, $handler);
    }

    public function put(string $uri, string $controller, string $handler) : void
    {
        $this->add('PUT', $uri, $controller, $handler);
    }

    public function patch(string $uri, string $controller, string $handler) : void
    {
        $this->add('PATCH', $uri, $controller, $handler);
    }

    public function delete(string $uri, string $controller, string $handler) : void
    {
        $this->add('DELETE', $uri, $controller, $handler);
    }
    
    public function fallback(string $controller, string $handler) : void
    {
        if($this->found)
            return;
        
        $this->call($controller, $handler);
    }

    private function call(string $controller, string $handler, array $parameters = []) : void
    {
        $controller_object = new $controller($this->httpRequest);

        $controller_object->{$handler}(...$parameters);
    }
}
