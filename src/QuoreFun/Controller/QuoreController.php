<?php

namespace QuoreFun\Controller;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use QuoreFun\Service\Validation\Validator;
use Symfony\Component\Yaml\Yaml;

abstract class QuoreController
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var QuoreFun\Service\Validation\Validator
     */
    private $validator;

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

    protected function getValidator()
    {
        if (!$this->validator) {
            $this->validator = new Validator();
        }

        return $this->validator;
    }

    private function initializeEntityManager()
    {
        $paths = array("src/QuoreFun/Entity");
        $isDevMode = false;

        // the connection configuration
        $connectionParams = Yaml::parse(file_get_contents(__DIR__.'/../../../config/database.yml'));

        $driver = new AnnotationDriver(new AnnotationReader(), $paths);

        $config = Setup::createConfiguration($isDevMode);
        $config->setMetadataDriverImpl($driver);

        $this->entityManager = EntityManager::create($connectionParams['database'], $config);
    }
}