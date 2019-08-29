<?php

namespace App\Middleware;

use Slim\ViewsTwig;

class ValidationErrorsMiddleware
{
  protected $view;

  public function __construct($view)
  {
    $this->view = $view;
  }

  public function __invoke($request, $response, $next)
  {
    if(isset($_SESSION['errors'])) {
      $this->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
    }

    unset($_SESSION['errors']);

    $response = $next($request, $response);
    return $response;
  }
}
