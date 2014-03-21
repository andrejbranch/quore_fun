<?php

namespace QuoreFun\Routing;

use Symfony\Component\Yaml\Yaml;

class Router
{
    /**
     * @see http://zaphpa.org/doc.html
     * @var Zaphpa_Router
     */
    private $router;

    public function __construct()
    {
        $this->router = new \Zaphpa_Router();
        $this->loadRoutes();
    }

    public function route()
    {
        $this->router->route();
    }

    private function loadRoutes()
    {
        // the connection configuration
        $routes = Yaml::parse(file_get_contents(__DIR__.'/../../../config/routes.yml'));

        foreach ($routes as $route) {
            $this->router->addRoute($route);
        }
    }
}