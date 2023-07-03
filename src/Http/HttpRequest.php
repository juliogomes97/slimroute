<?php declare(strict_types=1);

namespace SlimRoute\Http;

class HttpRequest
{
    public readonly string $uri;
    public readonly string $method;

    private array   $query;
    private array   $post;

    public function __construct()
    {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);

        $this->parseUri();
        $this->parseQuery();
        $this->filterPost();
    }

    public function getPostValue(string $key) : mixed
    {
        if(array_key_exists($key, $this->post))
        {
            return $this->post[$key];
        }

        return '';
    }

    public function getQueryValue(string $key) : mixed
    {
        if(array_key_exists($key, $this->query))
        {
            return $this->query[$key];
        }

        return '';
    }

    private function parseUri() : void
    {
        $request_uri = $_SERVER['REQUEST_URI'];

        $position = strpos($request_uri, '?');

        if($position !== false)
        {
            $request_uri = substr($request_uri, 0, $position);
        }

        $this->uri = rtrim($request_uri, '/');
    }
    
    private function parseQuery() : void
    {
        $output = [];

        if(array_key_exists('QUERY_STRING', $_SERVER))
        {
            parse_str($_SERVER['QUERY_STRING'], $output);
        }
        
        $this->query = $output;
    }

    private function filterPost()
    {
        $post = filter_input_array(INPUT_POST);

        if($post)
        {
            $post = array_map('trim', $post);
            $post = array_map('htmlspecialchars', $post);
    
            $this->post = $post;
            return;
        }
        
        $this->post = [];
    }
}