<?php
require_once __DIR__ . '/../vendor/autoload.php';

$request_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '\/?' => ['Test\\Controller\\TaskController', 'listAction'],
    '\/new\/?' => ['Test\\Controller\\TaskController', 'newAction'],
    '\/edit\/(\d+)\/?' => ['Test\\Controller\\TaskController', 'editAction'],
    '\/login\/?' => ['Test\\Controller\\AuthController', 'loginAction'],
    '\/logout\/?' => ['Test\\Controller\\AuthController', 'logoutAction'],
];

$base_url = str_replace('/', '\/', Test\Controller\BaseController::getRoot());

foreach ($routes as $url => $action) {
    $match = preg_match("/^{$base_url}{$url}$/", $request_url, $params);

    if ($match) {        
        $controller = new $action[0];
        return $controller->handle($action[1], $params);
    }
}

return Test\Controller\BaseController::show404();
