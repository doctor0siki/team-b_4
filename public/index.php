<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/larapack/dd/src/helper.php';

// APPを作ります
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

//SLIMのセッションを扱えるようにします
$app->add(new \Slim\Middleware\Session([
    'name'        => 'slim_session',
    'autorefresh' => true,
    'lifetime'    => '1 hour'
]));

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// load routes
$routers = glob(__DIR__ . '/../app/Controller/*/*.*');
foreach ($routers as $router) {
    require $router;
}

// Run app
$app->run();
