<?php
// PHP error reporting & visibility:
// DISABLE & HIDE IN PRODUCTION.
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// Source & version information:
define('SOURCE_URL', 'http://github.com/Drefetr/Shush');
define('SOURCE_VERSION', '2-dev');

// Local filesystem, directory & path info:
// INCLUDE TRAILING SLASHES.
define('DIR_BASE', '/home/drefetr/public_html/Shush/private/');
define('DIR_CORE', DIR_BASE . 'core/');
define('DIR_CONTROLLERS', DIR_BASE . 'controllers/');
define('DIR_TEMPLATES', DIR_BASE . 'templates/');

// Webroot & public-facing filesystem, directory & path info:
// INCLUDE TRAILING SLASHES.
define('URL_BASE', 'http://127.0.0.1/~drefetr/Shush/www/');
define('DIR_WEBROOT', URL_BASE);
define('DIR_DOCS', DIR_WEBROOT . 'docs/');

// MySQL user credentials & database information:
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '#Lazarus$8192');
define('DB_NAME', 'c1shushdev');

// Default Message settings:
define('MESSAGE_TTL_DEFAULT', 1440); // 24 hours.
define('MESSAGE_TTL_MIN', 1); // 1 hour.
define('MESSAGE_TTL_MAX', 10080); // 7 days.
define('MESSAGE_ID_CHARSET', 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
define('MESSAGE_ID_LENGTH_MIN', 4);
define('MESSAGE_ID_LENGTH_MAX', 256);
define('MESSAGE_MID_LENGTH_MIN', 4);
define('MESSAGE_MID_LENGTH_DEFAULT', 8);
define('MESSAGE_MID_LENGTH_MAX', 256);
define('MESSAGE_KEY_LENGTH_MIN', 8);
define('MESSAGE_KEY_LENGTH_MAX', 256);
define('MESSAGE_KEY_LENGTH_DEFAULT', 16);
