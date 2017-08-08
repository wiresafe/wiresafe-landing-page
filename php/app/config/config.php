<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */

defined('APP') or die('Restricted Access!');

/**
 * Default character set
 */
ini_set('default_charset', 'UTF-8');

/**
 * Default time zone
 */
date_default_timezone_set('America/Los_Angeles');

/**
 * Config
 */
$config = [];

/**
 * Base configuration
 */
$config['app_key'] = 'yEN82OcF8Sp0UQn8E40NWzSQYygkKtD1';                            // http://randomkeygen.com/
$config['base_url'] = 'http://wiresafe.com';                       // without slash at the end
$config['environment'] = 'production';                                             // development, production, staging

/**
 * Core configuration files
 */
$configFiles = [
    'deployment',
    'constant',
    'mail',
    'database',
];

foreach ($configFiles as $file) {
    include __DIR__.'/'.$file.'.php';
}

/**
 * Other configuration files
 */

/**
 * Environment config
 */
if(file_exists(__DIR__.'/'.$config['environment'].'.php')) {
    include __DIR__.'/'.$config['environment'].'.php';
}
