<?php

$r = filter_input(INPUT_GET, 'route');

require __DIR__ . '/source/Boot/Config.php';
require __DIR__ . '/source/Boot/Helpers.php';

// WEB 
$routes[''] = [CONF_VIEW_WEB, '_theme', 'home'];
$routes['/'] = [CONF_VIEW_WEB, '_theme', 'home'];
$routes['/ops'] = [CONF_VIEW_WEB, '_theme', 'error'];
$routes['/confirma'] = [CONF_VIEW_WEB, '_theme', 'optin'];

// AUTH 
$routes['/entrar'] = [CONF_VIEW_APP, '_auth', 'signin'];
$routes['/cadastrar'] = [CONF_VIEW_APP, '_auth', 'register'];
$routes['/recuperar'] = [CONF_VIEW_APP, '_auth', 'recover'];

// APP
$routes['/app'] = [CONF_VIEW_APP, '_theme', 'profile'];
$routes['/app/perfil'] = [CONF_VIEW_APP, '_theme', 'profile'];

// ADMIN 
/*
$routes['/admin'] = [CONF_VIEW_ADMIN, '_theme', 'dash'];
$routes['/admin/dash'] = [CONF_VIEW_ADMIN, '_theme', 'dash'];
*/

$theme = (!empty($routes[$r]) ? $routes[$r][0] : null);
$content = (!empty($routes[$r]) ? $routes[$r][2] : null);

if (!$theme || !$content) {
    redirect('/ops');
    die;
}

require __DIR__ . "/themes/{$theme}/{$routes[$r][1]}.php";
