<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */
session_start();

define('APP', true);
define('APPROOT', __DIR__);

include APPROOT.'/app/config/config.php';
include APP_SYSTEM_ROOT.'/bootstrap.php';

if($config['database']) {
    $db = new Database();
    $db->connect($config['database']);
}

include APP_SYSTEM_ROOT.'/router.php';

if($config['database']) {
    $db->disconnect();
}