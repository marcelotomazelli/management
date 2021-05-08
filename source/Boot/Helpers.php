<?php

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * @param $include 
 * @param string $string 
 * @return bool
 */
function str_include($include, string $string): bool
{
    if (is_int(mb_strpos($string, $include))) {
        return true;
    }

    return false;
}

/**
 * ####################
 * ###   PASSWORD   ###
 * ####################
 */

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    $len = mb_strlen($password);
    $min = CONF_PASSWORD_MIN_LEN;
    $max = CONF_PASSWORD_MAX_LEN;

    if (password_get_info($password)['algo']) {
        return true;
    }

    return ($len >= $min && $len <= $max);
}

/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string
{
    $url = CONF_URL_BASE;

    if (str_include('localhost', $url)) {
        $mobile = ['android', 'linux'];

        $verify = function (string $system) {
            $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
            return str_include($system, $userAgent);
        };

        if (in_array(true, array_map($verify, $mobile))) {
            $url = CONF_URL_IP;
        }
    }

    if ($path) {
        $url .= ($path[0] != '/' ? "/{$path}" : $path);
    }

    return $url;
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header('HTTP/1.1 302 Redirect');
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    $path = ($url[0] != '/' ? "/{$url}" : $url);

    if (filter_input(INPUT_GET, 'route', FILTER_DEFAULT) != $path) {
        $location = url($path);
        header("Location: {$location}");
        exit;
    }
}

/**
 * ##################
 * ###   ASSETS   ###
 * ##################
 */

/**
 * @param string $pathFile 
 * @param string $theme 
 * @return string
 */
function theme(string $pathFile, string $theme): string
{
    if ($pathFile[0] == '/') {
        $pathFile = substr($pathFile, 1);
    }

    return url("/themes/{$theme}/{$pathFile}");
}

/**
 * @param string $pathFile 
 * @return string
 */
function shared(string $pathFile): string
{
    if ($pathFile[0] == '/') {
        $pathFile = substr($pathFile, 1);
    }

    return url("/shared/{$pathFile}");
}


/**
 * ###################
 * ###   REQUEST   ###
 * ###################
 */

/**
 * @return string
 */
function csrf_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrfToken ?? '') . "'/>";
}

/**
 * @param string $token
 * @return bool
 */
function csrf_verify(string $token): bool
{
    $session = new \Source\Core\Session();

    if (!$session->has('csrfToken')) {
        return false;
    }

    if ($token != $session->csrfToken) {
        return false;
    }

    return true;
}

/**
 * @return string|null
 */
function flash_message(): ?string
{
    $session = new \Source\Core\Session();

    if (!$session->has('flash')) {
        return null;
    }

    return $session->flash()->render();
}
