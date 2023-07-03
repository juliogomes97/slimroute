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

    public function call(string $method, string $uri, callable | string $callback) : void
    {
        if($this->found && $this->httpRequest->method !== $method)
            return;

        $pattern = preg_replace('/\{(\w+):([^}]+)\}/', '(?P<$1>$2)', $uri);
        $pattern = '#^' . $pattern . '$#';
        
        if (preg_match($pattern, $this->httpRequest->uri, $matches))
        {
            $parameters = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

            $callback($this->httpRequest, ...$parameters);

            $this->found = true;
        }
    }

    public function get(string $uri, callable | string $callback) : void
    {
        $this->call('GET', $uri, $callback);
    }

    public function post(string $uri, callable | string $callback) : void
    {
        $this->call('POST', $uri, $callback);
    }

    public function fallback(callable | string $callback) : void
    {
        if($this->found)
            return;
        
        $callback($this->httpRequest);
    }
}