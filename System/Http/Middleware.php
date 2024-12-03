<?php

namespace Scooby\Http;

class Middleware
{
    private $middlewareQueue = [];

    public function __construct()
    {
        $this->middlewareQueue = \Scooby\Http\Middlewares::$middleware;
    }
    public function next($data = null)
    {
        $data = $data ?? Request::getRequestDataExcept(['route'], false);
        if (!empty($this->middlewareQueue)) {
            foreach ($this->middlewareQueue as $middleware) {
                $request = (new $middleware)->handle($data ?? []);
                $data = $request;
            }
        }
        Request::setRequest($data);
        return $data;
    }

    public function especificActionNext($middleware, $data = null)
    {
        $data = $data ?? Request::getRequestDataExcept(['route'], false);
        $request = (new $middleware)->handle($data ?? []);
        Request::setRequest($request);
        return $request;
    }
}
