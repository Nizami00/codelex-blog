<?php

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// TODO Make this look better
function database(): Connection
{
    $connectionParams = [
        'dbname' => $_ENV['DB_DATABASE'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'host' => $_ENV['DB_HOST'],
        'driver' => 'pdo_mysql',
    ];

    $connection = DriverManager::getConnection($connectionParams);
    $connection->connect();

    return $connection;
}

function query(): QueryBuilder
{
    return database()->createQueryBuilder();
}

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $namespace = 'App\Controllers\\';
    //display main pages
    $r->addRoute('GET', '/', $namespace . 'ArticlesController@index');
    //register
    $r->addRoute('GET', '/register', $namespace . 'RegisterController@register');
    $r->addRoute('GET', '/register/reffer', $namespace . 'RegisterController@register');
    //register
    $r->addRoute('GET', '/register', $namespace . 'RegisterController@register');
    //login
    $r->addRoute('GET', '/login', $namespace . 'LoginController@login');
    $r->addRoute('POST', '/login/authorize', $namespace . 'LoginController@authorize');
    $r->addRoute('POST', '/register/store', $namespace . 'RegisterController@store');
    //logout
    $r->addRoute('GET', '/logout', $namespace . 'LoginController@logout');
    //create new article
    $r->addRoute('GET', '/articles/create', $namespace . 'ArticlesController@create');
    $r->addRoute('POST', '/articles/submitNewArticle', $namespace . 'ArticlesController@submitNewArticle');
    $r->addRoute('GET', '/articles', $namespace . 'ArticlesController@index');
    //register
    $r->addRoute('GET', '/{reffer}', $namespace . 'RegisterController@register');
    //show articles
    $r->addRoute('GET', '/articles/{id}', $namespace . 'ArticlesController@show');
    //create comment
    $r->addRoute('POST', '/articles/{id}/comment', $namespace . 'CommentController@storeComment');
    //delete comment
    $r->addRoute('DELETE', '/articles/{id}/{idC}/deleteComment', $namespace . 'CommentController@deleteComment');
    //delete article
    $r->addRoute('DELETE', '/articles/{id}', $namespace . 'ArticlesController@delete');
    //edit existing pages
    $r->addRoute('GET', '/articles/{id}/edit', $namespace . 'ArticlesController@edit');
    $r->addRoute('PUT', '/articles/{id}/update', $namespace . 'ArticlesController@update');
    //like or dislike each article
    $r->addRoute('POST', '/articles/{id}/like', $namespace . 'ArticlesController@like');
    $r->addRoute('POST', '/articles/{id}/dislike', $namespace . 'ArticlesController@dislike');

});

// Fetch method and URI from somewhere
$httpMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 PAGE NOT FOUND';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo 'METHOD NOT ALLOWED';
        break;
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = explode('@', $routeInfo[1]);
        $vars = $routeInfo[2];

        (new $controller)->$method($vars);

        break;
}