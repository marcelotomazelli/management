<?php
/**
 * Use this file to create Config.php in this same directory
 */

/**
 * DATABASE
 */
define('CONF_DB_HOST', 'localhost');
define('CONF_DB_USER', 'root');
define('CONF_DB_PASS', '');
define('CONF_DB_NAME', 'management');

/**
 * PROJECT URLs
 */
define('CONF_URL_SHEME', 'http' . (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 's' : ''));
define('CONF_URL_BASE', CONF_URL_SHEME . '://management.local');
define('CONF_URL_IP', CONF_URL_SHEME . '://192.168.3.18');

/**
 * SITE
 */
define('CONF_SITE_NAME', 'Management');
define('CONF_SITE_TITLE', CONF_SITE_NAME . ' - Gerencie suas atividades');
define('CONF_SITE_DESC', 'A ' . CONF_SITE_NAME . ' é a melhor plafaforma para gerenciar suas atividades');

/**
 * PASSWORD
 */
define('CONF_PASSWD_MIN_LEN', 8);
define('CONF_PASSWD_MAX_LEN', 40);
define('CONF_PASSWD_ALGO', PASSWORD_DEFAULT);
define('CONF_PASSWD_OPTION', ['cost' => 10]);

/**
 * VIEW
 */
define('CONF_VIEW_EXT', 'php');
define('CONF_VIEW_WEB', 'mngweb');
define('CONF_VIEW_APP', 'mngapp');
define('CONF_VIEW_ADMIN', 'mngadmin');

/**
 * MINIFY VERSIONS
 */
define('CONF_VIEW_WEB_VERSION_CSS', 'v1');
define('CONF_VIEW_WEB_VERSION_JS', 'v1');
define('CONF_VIEW_APP_VERSION_CSS', 'v1');
define('CONF_VIEW_APP_VERSION_JS', 'v1');
define('CONF_VIEW_ADMIN_VERSION_CSS', 'v1');
define('CONF_VIEW_ADMIN_VERSION_JS', 'v1');

/**
 * SOCIAL
 */
define('CONF_SOCIAL_INSTAGRAM', 'https://instagram.com');
define('CONF_SOCIAL_FACEBOOK', 'https://facebook.com');
define('CONF_SOCIAL_LINKEDIN', 'https://linkedin.com');
