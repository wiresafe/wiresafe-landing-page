<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */

function logger(){

}

/**
 * If user logged in
 *
 * @return bool
 */
function isUserLoggedIn() {
    if( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ) {
        return true;
    }

    return false;
}

/**
 * Create user session
 *
 * @param $userId
 * @return bool
 */
function createUserSession($userId) {
    if(!$userId) {
        return false;
    }

    $_SESSION['logged_in'] = true;
    $_SESSION['logged_in_user'] = $userId;

    return true;
}

/**
 * Destory user session
 *
 * @return bool
 */
function destroyUserSession() {
    unset($_SESSION['logged_in']);
    unset($_SESSION['logged_in_user']);

    return true;
}

/**
 * Get current url slug
 *
 * @return string
 */
function currentUrlSlug() {
    global $actualUrlArray;

    return implode('-', $actualUrlArray);
}

/**
 * File upload
 *
 * @param $file
 * @param string $folder
 * @return bool|string
 */
function fileUpload($file, $folder = 'uploads') {
    $folderPath = '/'.$folder.'/'.date('Y').'/'.date('m').'/'.date('d').'/';
    $filename = secure_file_upload($file, APP_IMG_ROOT.$folderPath);

    if(!$filename) {
        return false;
    }

    return $folderPath.$filename;
}


/**
 * Abort connection
 *
 * @param string $string
 */
function abort_connection($string = 'Invalid!') {
    header('Content-type: text/plain');
    echo $string;
    exit();
}


/**
 * Get app build number
 *
 * @return int
 */
function buildNumber() {
    global $config;

    if($config['environment'] == 'production') {
        return APP_BUILD_NUMBER;
    }
    else {
        return time();
    }
}


/**
 * Get current user
 *
 * @return bool|null
 */
function currentUser() {
    global $db;

    if(!isUserLoggedIn()) {
        return false;
    }

    return $db->query('SELECT * FROM users WHERE id = '.$_SESSION['logged_in_user'])->first();
}


/**
 * Save files to disk
 *
 * @param $file
 * @return bool|string
 */
function saveToDisk($file) {
    $folderPath = '/'.date('Y').'/'.date('m').'/'.date('d').'/';
    $filename = file_upload($file, APP_ATTACHMENT_ROOT.$folderPath);

    if(!$filename) {
        return false;
    }

    return $folderPath.$filename;
}


/**
 * Multiple file upload
 *
 * @param $field
 * @return array
 */
function multipleFileUpload($field) {
    $attachments = [];

    if(isset($field['name'][0]) && $field['name'][0] != NULL) {
        $attachmentFiles = [];

        for($i = 0; $i < count($field['name']); $i++) {
            $attachmentFiles[$i] = [
                'name' => $field['name'][$i],
                'type' => $field['type'][$i],
                'tmp_name' => $field['tmp_name'][$i],
                'error' => isset($field['error'][$i]) ? $field['error'][$i] : 0,
                'size' => $field['size'][$i],
            ];
        }

        $i = 0;
        foreach($attachmentFiles as $file) {
            $filePath = saveToDisk($file);

            if($filePath) {
                $attachments[$i] = [
                    'name' => $file['name'],
                    'path' => $filePath,
                ];

                $i++;
            }
        }

        return $attachments;
    }

    return false;
}
