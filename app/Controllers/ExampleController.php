<?php
namespace App\Controllers;

class ExampleController extends AppController
{
  public function store($request, $response)
  {
    return $response->withRedirect($this->c->router->pathFor('example.show', ['id' => 3]));
  }

  public function show($request, $response, $args)
  {
    return "Show topic " . $args['id'];
  }
}
