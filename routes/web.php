<?php

use \App\Controllers\TopicController;
use \App\Middleware\IpFilter;

$app->group('', function() use ($app, $container) {

  $app->get('/', function() {
    return 'Welcome to Thiccnr';
  })->setName('home');

});

// Testing Validations...
$app->get('/validate', function($request, $response) {
  return $this->view->render($response, 'home.twig');
})->setName('validate');

use Respect\Validation\Validator as v;
$app->post('/signup', function($request, $response) {
  $validation = $this->validator->validate($request, [
    'username' => v::notEmpty()->noWhitespace()->isSameAs('joe'),
  ]);

  if ($validation->failed()) {
    // redirect to previous page and show errors
    return $response->withRedirect($this->router->pathFor('validate'));
  }

  die('register user');
})->setName('signup');
