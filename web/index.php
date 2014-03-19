<?php

require_once "../bootstrap.php";

use QuoreFun\Routing\Router;

$router = new Router();

try {

    $router->route();

} catch (\Exception $ex) {
    header("Content-Type: application/json;", TRUE, 404);
    $out = array("error" => $ex->getMessage());
    die($ex->getMessage());
}
