<?php


/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    if (password_get_info($password)['algo']) {
        return true;
    }

    $len = mb_strlen($password);
    $min = CONF_PASSWD_MIN_LEN;
    $max = CONF_PASSWD_MAX_LEN;

    return ($len >= $min && $len <= $max);
}

/**
 * @param array $keys
 * @param array $array
 * @return boolean
 */
function array_keys_exists(array $keys, array $array): bool
{
    return count(array_intersect(array_keys($array), $keys)) == count($keys);
}

/**
 * @param array $keys
 * @param array $array
 * @return boolean
 */
function array_keys_is(array $keys, array $array): bool
{
    return array_keys($array) == $keys;
}

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * @param string $string
 * @return string
 */
function str_slug(string $string, string $concatenation = '-', array $exceptions = []): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                               ';

    foreach ($exceptions as $e) {
        if (str_include($e, $formats)) {
            $pos = strpos($formats, $e);
            $mbPos = mb_strpos($formats, $e);
            $formats = substr($formats, 0, $pos) . substr($formats, $pos + strlen($e));
            $replace = substr($replace, 0, $mbPos) . substr($replace, $mbPos + mb_strlen($e));
        }
    }

    $slug = str_replace(['-----', '----', '---', '--'], $concatenation,
        str_replace(' ', $concatenation,
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = '...'): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, $limit);

    if (str_include(' ', $chars)) {
        $chars = mb_substr($chars, 0, mb_strrpos($chars, ' '));
    }

    return "{$chars}{$pointer}";
}

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
 * @return string
 */
function passwd(string $password): string
{
    if (!empty(password_get_info($password)['algo'])) {
        return $password;
    }

    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash): bool
{
    return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
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
 * ################
 * ###   DATE   ###
 * ################
 */

/**
 * @param string $date
 * @param string $format
 * @return string
 */
function date_fmt(
    ?string $date = 'now',
    string $toFormat = 'd/m/Y'
): string
{
    $date = (!empty($date) ? $date : 'now');
    return (new DateTime($date))->format($toFormat);
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
 * @return array
 */
function flash_message(): array
{
    $session = new \Source\Core\Session();

    if (!$session->has('flash')) {
        return [];
    }

    return ['message' => (object) $session->flash()->response(false)];
}
