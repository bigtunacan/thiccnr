<?php

namespace App\Controllers;

use \Interop\Container\ContainerInterface;

abstract class AppController
{
  protected $c;

  // public function __construct(\Slim\Container $c)
  public function __construct(\Interop\Container\ContainerInterface $c)
  {
    $this->c = $c;
  }

  protected function render404($response)
  {
    return $this->c->view->render($response->withStatus(404), 'errors/404.twig');
  }
}
