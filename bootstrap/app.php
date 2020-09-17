<?php
/*
 * Bootstrap performs application configuration (Slim / Twig / Eloquent ORM).
 *  
 */

require __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../env.php';

// Create app - Pass eloquent connection to slim settings object
$app = new \Slim\App ([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  =>  $config['database'],
            'username'  =>  $config['username'],
            'password'  =>  $config['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]
    ]
]);

// Get all container items
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    return $view;
};

// Boot(botar) eloquent connection
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

//Pass the connection to global container
$container['db'] = function ($container) use ($capsule){
    return $capsule;
};



// ======================== Controllers =========================== //

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

// =============================================================== //

require_once __DIR__ . '/../app/routes.php';