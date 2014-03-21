<?php

function __autoload($class) {
    // convert namespace to full file path
    $class = __DIR__.'/src/' . str_replace('\\', '/', $class) . '.php';
    require_once($class);
}

// bootstrap.php
require_once "vendor/autoload.php";

use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerFile(__DIR__.'/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
AnnotationRegistry::registerFile(__DIR__.'/src/QuoreFun/Service/Validation/ValidationAnnotations.php');
