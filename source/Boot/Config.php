<?php
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
define('CONF_URL_BASE', 'http://localhost/management');
define('CONF_URL_IP', 'http://' . file_get_contents(__DIR__ . '/../../../ipv4.txt') . '/management');

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
 * SOCIAL
 */
define('CONF_SOCIAL_INSTAGRAM', 'https://instagram.com');
define('CONF_SOCIAL_FACEBOOK', 'https://facebook.com');
define('CONF_SOCIAL_LINKEDIN', 'https://linkedin.com');
