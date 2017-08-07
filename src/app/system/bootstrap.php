<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */

$app = [];

/**
 * Autoload files for composer packages
 */
require_once APPROOT.'/vendor/autoload.php';


/**
 * Functions
 */
require_once APP_FUNC_ROOT.'/coreFunction.php';
require_once APP_FUNC_ROOT.'/appFunction.php';


/**
 * Default class files
 */
require_once APP_LIB_ROOT.'/default/class.db.php';
require_once APP_LIB_ROOT.'/default/class.paginate.php';
require_once APP_LIB_ROOT.'/default/cache.php';