<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Define your routes in an array
$routes = [
    ['POST', '/graphql', [App\Controller\GraphQL::class, 'handle']],
];

// Create a dispatcher
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($routes) {
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});

// Dispatch the request
$routeInfo = $dispatcher->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

var_dump($routeInfo); // Debugging output

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        http_response_code(405);
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // Create an instance of the handler class and call the method
        $controller = new $handler[0];
        echo $controller->{$handler[1]}($vars);
        break;
}
