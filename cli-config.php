<?php

require_once "bootstrap.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;

$paths = array("src/QuoreFun/Entity");
$isDevMode = false;

// the connection configuration
$yamlParams = Yaml::parse(file_get_contents(__DIR__.'/config/database.yml'));

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($yamlParams['database'], $config);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);