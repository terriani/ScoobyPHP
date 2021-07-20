<?php

namespace Scooby\Http;

use Exception;

class Middleware
{
    private $middlewareQueue = [];

    public function __construct()
    {
        $this->middlewareQueue = \Scooby\Http\Middlewares::$middleware;
    }
    public function next()
    {
        $data = Request::getRequestExcept(['route'], false);
        if (!empty($this->middlewareQueue)) {
            foreach ($this->middlewareQueue as $middleware) {
                $request = (new $middleware)->handle($data ?? []);
                if (!$request) {
                    throw new Exception('Something broke!', 500);
                }
                $data = $request;
            }
        }
        Request::setRequest($data);
        return $data;
    }

    public function especificActionNext($middleware)
    {
        $data = Request::getRequestExcept(['route'], false);
        $request = (new $middleware)->handle($data ?? []);
        if (!$request) {
            throw new Exception('Something broke!', 500);
        }
        Request::setRequest($request);
        return $request;
    }
}