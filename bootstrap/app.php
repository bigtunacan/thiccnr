<?php

use Tracy\Debugger;
if(getenv('ENVIRONMENT') === "development") {
  Debugger::enable(Debugger::DEVELOPMENT);
}

if(session_status() == PHP_SESSION_NONE) {
  session_start();
}

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true
  ]
]);

$container = $app->getContainer();

// Temporary DB setup...
$config = new \Doctrine\DBAL\Configuration();

$connectionParams = array(
  'dbname' => getenv('DB_NAME'),
  'user' => getenv('DB_USER'),
  'password' => getenv('DB_PASSWORD'),
  'host' => getenv('DB_HOST'),
  'driver' => getenv('DB_DRIVER'),
);
$container['conn'] = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$container['view'] = function($container) {
  $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
    // 'cache' => 'cache'
    'cache' => false
  ]);

  // Instantiate and add Slim specific extension
  $router = $container->get('router');
  $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
  $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

  return $view;
};

// Init Validation
use Respect\Validation\Validator as v;
v::with('App\\Validation\\Rules\\');
$container['validator'] = function() {
  return new \App\Validation\Validator;
};

// Class based handler
use App\Handlers\NotFoundHandler;
$container['notFoundHandler'] = function($container) {
  return new NotFoundHandler($container['view']);
};

// This is adding the validation middleware to the entire app
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container->view));

require __DIR__ . '/../helpers/helpers.php';
require __DIR__ . '/../routes/web.php';
require __DIR__ . '/../routes/api.php';
