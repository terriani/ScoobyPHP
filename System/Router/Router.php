<?php

namespace Scooby\Router;

use Exception;
use Scooby\Helpers\Auth;

class Router extends Dispatch
{
    private array $methods = ['get', 'post', 'put', 'patch', 'delete'];

    /**
     * Router constructor.
     *
     * @param string $projectUrl
     * @param null|string $separator
     */
    public function __construct(string $projectUrl, ?string $separator = "@")
    {
        parent::__construct($projectUrl, $separator);
    }

    /**
     * @param  array $methods
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function match(array $methods, string $route, $handler, string $name = null): void
    {
        $method = 'GET';
        foreach ($methods as $method) {
            if (!in_array($method, $this->methods)) {
                throw new Exception('HTTP request method [ '.$method.' ] not allowed');
            }
            //$method = strtoupper($method);
            $this->addRoute($method, $route, $handler, $name);
        }
    }

    /**
     * @param  array $methods
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function auth(array $methods, string $route, $handler, string $name = null): void
    {
        if (!Auth::authValidation()) {
            // redireciona para uma página de erro 404
        }

        $method = 'GET';

        foreach ($methods as $method) {
            if (!in_array($method, $this->methods)) {
                throw new Exception('HTTP request method [ ' . $method . ' ] not allowed');
            }

            $method = strtoupper($method);
        }

        $this->addRoute($method, $route, $handler, $name);
    }

    /**
     * @param  array $methods
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function any(string $route, $handler, string $name = null): void
    {
        $method = 'GET';
        foreach ($this->methods as $method) {

            if (!in_array($method, $this->methods)) {
                throw new Exception('HTTP request method [ ' . $method . ' ] not allowed');
            }

            $method = strtoupper($method);
        }
        $this->addRoute(strtoupper($method), $route, $handler, $name);
    }

    /**
     * @param  array $methods
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function form(string $route, $handler, string $name = null): void
    {
        foreach (['get', 'post'] as $method) {
            $this->addRoute(strtoupper($method), $route, $handler, $name);
        }
    }

    /**
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function post(string $route, $handler, string $name = null): void
    {
        $this->addRoute("POST", $route, $handler, $name);
    }

    /**
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function get(string $route, $handler, string $name = null, $middlewares = []): void
    {
        if (is_string($middlewares)) {
            $middlewares = [$middlewares];
        }
        
        $this->addRoute("GET", $route, $handler, $name, $middlewares);
    }

    /**
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function put(string $route, $handler, string $name = null): void
    {
        $this->addRoute("PUT", $route, $handler, $name);
    }

    /**
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function patch(string $route, $handler, string $name = null): void
    {
        $this->addRoute("PATCH", $route, $handler, $name);
    }

    /**
     * @param string $route
     * @param $handler
     * @param string|null $name
     */
    public function delete(string $route, $handler, string $name = null): void
    {
        $this->addRoute("DELETE", $route, $handler, $name);
    }
}
