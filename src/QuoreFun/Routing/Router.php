<?php

namespace QuoreFun\Routing;

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
        $this->router->addRoute(array(
            'path' => '/',
            'get' => array('QuoreFun\Controller\HomeController', 'getHomepage'),
        ));

        $this->router->addRoute(array(
            'path' => '/region/{id}',
            'get' => array('QuoreFun\Controller\RegionController', 'get'),
            'post' => array('QuoreFun\Controller\RegionController', 'update'),
            'delete' => array('QuoreFun\Controller\RegionController', 'delete'),
        ));

        $this->router->addRoute(array(
            'path' => '/region',
            'get' => array('QuoreFun\Controller\RegionController', 'query'),
            'post' => array('QuoreFun\Controller\RegionController', 'create'),
        ));

        $this->router->addRoute(array(
            'path' => '/property/{regionId}/{propertyId}',
            'get' => array('QuoreFun\Controller\PropertyController', 'get'),
            'post' => array('QuoreFun\Controller\PropertyController', 'update'),
            'delete' => array('QuoreFun\Controller\PropertyController', 'delete'),
        ));

        $this->router->addRoute(array(
            'path' => '/property/{regionId}',
            'get' => array('QuoreFun\Controller\PropertyController', 'query'),
            'post' => array('QuoreFun\Controller\PropertyController', 'create'),
        ));
    }
}