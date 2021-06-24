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
$router->get('/entrar', 'Source\Controllers\App\Auth::signin');
$router->get('/cadastrar', 'Source\Controllers\App\Auth::register');
$router->get('/recuperar', 'Source\Controllers\App\Auth::recover');

// ERROR
$router->get('/ops', 'Source\Controllers\Web::error');
$router->get('/ops/{code}', 'Source\Controllers\Web::error');

try {
    $response = $router->dispatch($request);
    (new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
} catch (\League\Route\Http\Exception\NotFoundException $e) {
    redirect('/ops');
}
