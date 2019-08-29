<?php

// use \App\Controllers\TopicController;
// use \App\Middleware\IpFilter;

// Add GLOBAL Middleware
// $app->add(new IpFilter($container['db']));

$app->group('/api', function() use ($app, $container) {

  $app->get('/', function() {
    return 'API Home';
  });

});
