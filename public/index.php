<?php

use Phalcon\Config\Adapter\Ini;
use Phalcon\Db\Adapter\PdoFactory;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ViewBaseInterface;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Url as UrlProvider;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require BASE_PATH . '/vendor/autoload.php';

$loader = new Loader();
$loader->registerDirs([
    APP_PATH . '/controllers/',
    APP_PATH . '/models/',
]);
$loader->register();

$config = new Ini(APP_PATH . '/storage/config.ini');

$di = new FactoryDefault();
$di->set('config', $config);
$di->set('db', function () use ($config) {
    return (new PdoFactory())->load($config->database);
});
$di->set('view', function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    $view->registerEngines([
        '.volt' => function (ViewBaseInterface $view, DiInterface $container = null) {
            $volt = new Volt($view, $container);
            $volt->setOptions([
                'path' => APP_PATH . '/storage/cache/volt/',
            ]);
            return $volt;
        }
    ]);
    return $view;
});
$di->set('url', function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');
    return $url;
});

$application = new Application($di);
$response = $application->handle($_SERVER["REQUEST_URI"]);
$response->send();

