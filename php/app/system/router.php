<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */

$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actualUrl = rtrim(str_replace(base_url(), '', $currentUrl), '/');
$actualUrl = ltrim($actualUrl, '/');

$actualUrlArray = explode('/', $actualUrl);
$actualUrlArray = array_map('cln_url_string_array', $actualUrlArray);

$app['current_url_array'] = $actualUrlArray;
$app['current_app_url'] = url('/'.implode('/', $actualUrlArray));
$app['current_full_url'] = filter_var($currentUrl, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);

$app['view_file_name'] = APP_VIEW_ROOT.'/'.view_path($actualUrlArray);

/**
 * Load view
 */
if( file_exists($app['view_file_name']) ) {
    include $app['view_file_name'];
}
else {
    include APP_VIEW_ROOT.'/errors/404.php';
}