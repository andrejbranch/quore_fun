<?php

namespace QuoreFun\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

abstract class QuoreController
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct()
    {
        $this->initializeEntityManager();
    }

    protected function returnJsonResponse(array $data, $response)
    {
        $response->setFormat('json');
        $response->add(json_encode($data));
        $response->send();
    } 

    protected function returnHtmlResponse($path, $response)
    {
        $response->setFormat('html');
        $response->add(file_get_contents(__DIR__ . sprintf('/../../../web/%s', $path)));
        $response->send();
    } 

    protected function decodeJsonData($request)
    {
        return json_decode($request->data['_RAW_HTTP_DATA'], true);
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    private function initializeEntityManager()
    {
        $paths = array("src/QuoreFun/Entity");
        $isDevMode = true;

        // the connection configuration
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'quore_fun',
        );

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        $this->entityManager = EntityManager::create($dbParams, $config);
    }
}