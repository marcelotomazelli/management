<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$uri = '/management';
$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));

$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

// WEB
$router->get('/', 'Source\Controllers\Web::home');
$router->get('/confirme', 'Source\Controllers\Web::confirm');

// AUTH
$router->get('/entrar', 'Source\Controllers\App\Account::signin');
$router->get('/cadastrar', 'Source\Controllers\App\Account::register');
$router->get('/recuperar', 'Source\Controllers\App\Account::recover');

$router->post('/register', 'Source\Controllers\App\Account::register');
$router->post('/signin', 'Source\Controllers\App\Account::signin');
$router->post('/recover', 'Source\Controllers\App\Account::recover');

// APP
$router->group('/app', function (\League\Route\RouteGroup $route) {
    $route->get('/', 'Source\Controllers\App::profile');
    $route->get('/perfil', 'Source\Controllers\App::profile');

    $route->post('/profile', 'Source\Controllers\App::profile');

    $route->get('/sair', 'Source\Controllers\App::signout');
});

// ADM
$router->group('/adm', function (\League\Route\RouteGroup $route) {
    $route->get('/entrar', 'Source\Controllers\Adm\Account::signin');

    $route->post('/signin', 'Source\Controllers\Adm\Account::signin');

    $route->get('/', 'Source\Controllers\Adm::users');
    $route->get('/usuarios', 'Source\Controllers\Adm::users');

    $route->get('/sair', 'Source\Controllers\Adm::signout');
});

// ERROR
$router->get('/ops', 'Source\Controllers\Web::error');
$router->get('/ops/{code}', 'Source\Controllers\Web::error');

try {
    $response = $router->dispatch($request);
    (new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
} catch (\League\Route\Http\Exception\NotFoundException $e) {
    redirect('/ops');
}
