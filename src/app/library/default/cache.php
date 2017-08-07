<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */

function cacheSet($key, $val, $expirationTime = 5) {
    $val = var_export($val, true);
    $val = str_replace('stdClass::__set_state', '(object)', $val);
    file_put_contents(cacheFolder()."/$key", '<?php $val = ' . $val . '; $expires_at = "'.\Carbon\Carbon::now()->addMinutes($expirationTime).'";');
}

function cacheGet($key) {
    @include cacheFolder()."/$key";

    if(isset($expires_at) && isCacheExpired($expires_at)) {
        unlink(cacheFolder()."/$key");

        return false;
    }

    return isset($val) ? $val : false;
}

function hasCache($key) {
    $filePath = cacheFolder()."/$key";

    if(!file_exists($filePath)) {
        return false;
    }
    else {
        @include $filePath;

        if(isset($expires_at) && isCacheExpired($expires_at)) {
            unlink($filePath);

            return false;
        }
    }

    return true;
}

function addCache($key, $val) {
    if(!hasCache($key)) {
        cacheSet($key, $val);
    }
}

function deleteCache($key) {
    $filePath = cacheFolder()."/$key";

    if(file_exists($filePath)) {
        unlink($filePath);
    }
}

function destroyCache() {
    $files = glob(cacheFolder()."/*");
    foreach($files as $file) {
        if(is_file($file)) unlink($file);
    }
}

function cacheFolder() {
    return APPROOT.'/cache';
}


function isCacheExpired($expires_at) {
    $currentTime = \Carbon\Carbon::now();
    $expirationTime = \Carbon\Carbon::parse($expires_at);

    if($currentTime->gte($expirationTime)) {
        return true;
    }

    return false;
}