<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();

require_once __DIR__ . '/../bootstrap/app.php';

$app->run();
