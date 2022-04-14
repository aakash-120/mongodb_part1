<?php
// print_r(apache_get_modules());
// echo "<pre>"; print_r($_SERVER); die;
// $_SERVER["REQUEST_URI"] = str_replace("/phalt/","/",$_SERVER["REQUEST_URI"]);
// $_GET["_url"] = "/";

// require __DIR__.'/../vendor/autoload.php';
require '../vendor/autoload.php';

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Url;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Config;
// use IntegrationTester;
use MongoDB\Database;
use MongoDB\Driver\Cursor;
use Phalcon\Incubator\MongoDB\Test\Fixtures\Mvc\Collections\Robots;
use Phalcon\Incubator\MongoDB\Test\Fixtures\Traits\DiTrait;
use Phalcon\Incubator\MongoDB\Mvc\Collection\Manager;

$config = new Config([]);

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . "/controllers/",
        APP_PATH . "/models/",
    ]
);

$loader->register();

$container = new FactoryDefault();

$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);

// $di->set(
//     'collectionManager',
//     function () {
//         return new Manager();
//     }
// );

$application = new Application($container);



// $container->set(
//     'db',
//     function () {
//         return new Mysql(
//             [
//                 'host'     => 'mysql-server',
//                 'username' => 'root',
//                 'password' => 'secret',
//                 'dbname'   => 'store',
//                 ]
//             );
//         }
// );

$container->set(
    'mongo',
    function () {
        $mongo = new MongoClient();

        return $mongo->selectDB('test');
    },
    true
);

// Setting Mongo Connection
// $di->set('mongo', function() {
//     $mongo = new Mongo();
//     return $mongo->selectDb("test");
// }, true);

// // Setting up the collection Manager
// $di->set('collectionManager', function(){
//     return new Phalcon\Mvc\Collection\Manager();
// }, true);

// $di->set('config', function () {
//     return new \Phalcon\Config([
//         'mongodb' => [
//             'host'     => 'localhost',
//             'port'     => 27017,
//             'database' => 'test'
//         ]
//     ]);
// }, true);

// $di->set('mongo', function () use ($di) {
//     $config  = $di->get('config')->mongodb;
//     $manager = new \MongoDB\Client('mongodb://' . $config->host . ':' . $config->port);
//     return $manager;
// },  true);

$container->set(
    'mongo',
    function () {
        $mongo = new \MongoDB\Client("mongodb://mongo3", array("username" => "root", "password" => "password123"));
        return $mongo->test;
    },
    true
);


try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
