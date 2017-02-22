<?php
// PHP error reporting & visibility:
// DISABLE & HIDE IN PRODUCTION.
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// Source & version information:
define('SOURCE_URL', 'http://github.com/Drefetr/Shush');
define('SOURCE_VERSION', '1.2RC1');

// Local filesystem, directory & path info:
// INCLUDE TRAILING SLASHES.
define('DIR_BASE', '/var/www/shush.ch/private/');
define('DIR_CORE', DIR_BASE . 'core/');
define('DIR_CONTROLLERS', DIR_BASE . 'controllers/');
define('DIR_TEMPLATES', DIR_BASE . 'templates/');

// Webroot & public-facing filesystem, directory & path info:
// INCLUDE TRAILING SLASHES.
define('URL_BASE', 'https://shush.ch/');
define('DIR_WEBROOT', URL_BASE);
define('DIR_DOCS', DIR_WEBROOT . 'docs/');

// MySQL user credentials & database information:
define('DB_HOST', 'localhost');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');

// Default Message settings:
define('MESSAGE_TTL_DEFAULT', 1440); // 72 hours.
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
