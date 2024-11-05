<?php
class Router {
    protected $routes = [];

    public function add($path, $controller, $method) {
        $this->routes[$path] = [$controller, $method];
    }

    public function dispatch($path) {
        if (isset($this->routes[$path])) {
            call_user_func([new $this->routes[$path][0], $this->routes[$path][1]]);
        } else {
            echo("404 - Route not found!");
        }
    }
}

