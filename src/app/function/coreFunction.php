<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */


/**
 * Hash a string
 *
 * @param $string
 * @return bool|string
 */
function bcrypt($string)
{
    return password_hash($string, PASSWORD_DEFAULT);
}


/**
 * Checking if encrypted string is valid
 *
 * @param $plainString
 * @param $hash
 * @return bool
 */
function validBcrypt($plainString, $hash)
{
    return password_verify($plainString, $hash);
}

/**
 * Array pluck
 *
 * @param $array
 * @param $key
 * @return array
 */
function array_pluck($array, $key) {
    return array_map(function($v) use ($key)  {
        return is_object($v) ? $v->$key : $v[$key];
    }, $array);
}


/**
 * Print r
 *
 * @param $array
 * @param bool $exit
 */
function dd($array, $exit = true) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if($exit) {
        exit();
    }
}


/**
 * Redirect to url
 *
 * @param $url
 * @param bool $forceUrl
 */
function redirect($url, $forceUrl = false) {
    if(isset($_GET['rurl']) && strlen(trim($_GET['rurl'])) > 0 && $forceUrl == false) {
        if (filter_var($_GET['rurl'], FILTER_VALIDATE_URL)) {
            $url = $_GET['rurl'];
        }

        header('Location: '.$url);
    }
    else {
        header('Location: '.base_url($url));
    }

    exit();
}

/**
 * Clean URL string
 *
 * @param $string
 * @return mixed
 */
function cln_url_string($string){
    return preg_replace("/[^a-zA-Z0-9-._]+/", "", $string);
}

/**
 * Clean url string array
 *
 * @param $string
 * @return mixed
 */
function cln_url_string_array($string) {
    if(strstr($string, '?')) {
        $string = substr($string, 0, strpos($string, '?'));
    }

    return cln_url_string($string);
}

/**
 * Javascript direct
 *
 * @param $url
 * @param int $timeout
 * @param bool $nomsg
 * @return string
 */
function js_redirect($url, $timeout = 5, $nomsg = false){
    if(!$nomsg) {
        $html = '<p style="font-family: Consolas, Courier, monospace; font-size: 12px; text-align: center; padding: 100px 0">
                <a href="'.$url.'">click here</a> if your browser doesn\'t automatically redirect you in '.$timeout.' second(s)</p>';
    }
    else $html = '';
    $html .= '<script>';
    $html .= 'setTimeout(function() { window.location.href = "'.$url.'"; }, '.($timeout * 1000).');';
    $html .= '</script>';
    return $html;
}

/**
 * Clean email string
 *
 * @param $email
 * @return mixed
 */
function cln_email_string($email){
    return preg_replace("/[^a-z0-9+_.@-]/i", "", $email);
}

/**
 * Clean array data
 *
 * @param $array
 * @return array
 */
function cln_array_data($array) {
    $filteredArray = [];

    foreach($array as $key => $value) {
        $filteredArray[cln_data($key)] = cln_data($value);
    }

    return $filteredArray;
}

/**
 * Clean string
 *
 * @param $string
 * @return array|mixed|string
 */
function cln_data($string){
    if(is_array($string)) {
        return cln_array_data($string);
    }

    $search = array(
        '@<script[^>]*?>.*?</script>@si',
        '@<[\/\!]*?[^<>]*?>@si',
        '@<style[^>]*?>.*?</style>@siU',
        '@<![\s\S]*?--[ \t\n\r]*>@'
    );

    $string = preg_replace($search, '', $string);

    $string = strip_tags(trim($string));
    $string = htmlentities($string, ENT_QUOTES, "UTF-8");

    if (get_magic_quotes_gpc())
        $string = stripslashes($string);

    return $string;
}

/**
 * Normal text to safe string
 *
 * @param $str
 * @return mixed
 */
function safe_string($str){
    return filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
}

/**
 * Sanitize full array
 *
 * @param $data
 * @param array $type
 * @param array $exception
 * @return array
 */
function sanitize($data,$type=array(),$exception=array()){
    if(is_array($data)){
        $sant = array();
        foreach($data as $key=>$val){
            if( !array_search($key,$exception) && !in_array($key,$exception) ) {
                if( isset($type[$key]) && $type[$key]=='int' && trim($val)!=NULL) {
                    if( is_numeric($val) )
                        $sant[$key] = filter_var($val, FILTER_SANITIZE_NUMBER_INT);
                    else
                        $sant[$key] = '';
                }
                elseif( isset($type[$key]) && $type[$key]=='email' && trim($val)!=NULL){
                    if( !filter_var($val, FILTER_VALIDATE_EMAIL) )
                        $sant[$key] = '';
                    else {
                        $val = cln_email_string($val);
                        $sant[$key] = filter_var($val, FILTER_SANITIZE_EMAIL);
                    }
                }
                elseif( isset($type[$key]) && ($type[$key]=='bbcode' || $type[$key]=='low') && trim($val)!=NULL ){
                    $sant[$key] = htmlentities($val, ENT_QUOTES, "UTF-8");

                    $search = array(
                        '@<script[^>]*?>.*?</script>@si',
                        '@<[\/\!]*?[^<>]*?>@si',
                        '@<style[^>]*?>.*?</style>@siU',
                        '@<![\s\S]*?--[ \t\n\r]*>@'
                    );

                    $sant[$key] = preg_replace($search, '', $sant[$key]);
                    $sant[$key] = strip_tags($sant[$key]);
                }
                elseif(isset($type[$key]) && $type[$key]=='simple' && trim($val)!=NULL) {
                    $sant[$key] = htmlentities($val, ENT_QUOTES, "UTF-8");
                }
                elseif( trim($val)!=NULL ) {
                    $normal = cln_data($val);
                    $sant[$key] = filter_var($normal, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                }
                elseif( trim($val)==NULL ) $sant[$key] = '';
                else $sant[$key] = '';
            }
        }

        foreach($exception as $key){
            $sant[$key] = $data[$key];
        }
    }
    return $sant;
}


/**
 * Generate unique string
 *
 * @return string
 */
function unique_string(){
    $prefix  = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ',4)),0,4);
    $postfix = time();
    $result  = $prefix.'-'.$postfix;
    return $result;
}

/**
 * Generate unique integer
 *
 * @return string
 */
function unique_integer() {
    return mt_rand(100000,999999).time();
}


/**
 * Send email
 *
 * @param array $settings
 * @param bool $debug
 * @param bool $fakeMail
 * @return bool
 */

//sendEmail([
//    'to' => 'hadicse@gmail.com',
//    'name' => 'Habib Hadi',
//    'subject' => 'Hi from support',
//    'message' => 'This is simple message!',
//], true);

function sendEmail($settings = [], $debug = false, $fakeMail = false) {
    global $config;

    $mail = new PHPMailer();

    $mail->CharSet  = 'UTF-8';
    if(isset($settings['lang'])) {
        $mail->setLanguage($settings['lang']);
    }

    if($debug) $mail->SMTPDebug = 3;

    $mail->isSMTP();
    $mail->Host = $config['mail']['smtp']['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['mail']['smtp']['username'];
    $mail->Password = $config['mail']['smtp']['password'];
    $mail->SMTPSecure = $config['mail']['smtp']['secure'];
    $mail->Port = $config['mail']['smtp']['port'];

    $mail->Encoding = '8bit';
    $mail->ContentType = 'text/html; charset=utf-8\r\n';

    if( !isset($settings['fromEmailAddress']) || !isset($settings['fromEmailName']) ) {
        $mail->setFrom($config['mail']['smtp']['from']['email'], $config['mail']['smtp']['from']['name']);
    }
    else {
        $mail->setFrom($settings['fromEmailAddress'], $settings['fromEmailName']);
    }

    if(isset($settings['attachment'])) {
        $mail->addAttachment($settings['attachment']['path'], $settings['attachment']['name']);
    }

    $mail->addAddress($settings['to'], $settings['name']);

    if( isset($settings['replyTo']) ) {
        $mail->addReplyTo($settings['replyTo']['email'], $settings['name']);
    }

    if( isset($settings['cc']) ) {
        $mail->addCC($settings['cc']);
    }

    if( isset($settings['bcc']) ) {
        $mail->addBCC($settings['bcc']);
    }

    $mail->isHTML(true);

    $mail->Subject = $settings['subject'];
    $mail->Body    = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>Wiresafe</title></head><body>'.$settings['message'].'</body></html>';

    if($fakeMail) {
        return $mail->preSend();
    }

    $mail->send();
    $mail->smtpClose();

    if($mail->isError()) {
        return false;
    }
    else {
        return true;
    }
}


/**
 * Bind value to string
 *
 * @param $string
 * @param array $findArray
 * @param array $valueArray
 * @return mixed
 */
function bind_value($string, $findArray = [], $valueArray = []) {
    $findPregArray = [];
    $replacePregArray = [];

    foreach ($findArray as $findText) {
        $findPregArray[] = '/{'.$findText.'}/';
        $replacePregArray[] = $valueArray[$findText];
    }

    return preg_replace($findPregArray, $replacePregArray, $string);
}

/**
 * String length
 *
 * @param $string
 * @return int
 */
function string_length($string) {
    return strlen(trim($string));
}

/**
 * Base url
 *
 * @param null $url
 * @return string
 */
function base_url($url = NULL){
    global $config;

    return $config['base_url'].$url;
}


/**
 * Alternate to base url
 *
 * @param $string
 * @return string
 */
function url($string) {
    if($string[0] != '/') $string = '/'.$string;
    return base_url($string);
}


/**
 * Generate random string
 *
 * @param int $length
 * @return string
 */
function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Current URL
 *
 * @param bool $rurlCheck
 * @return string
 */
function current_url($rurlCheck = false) {
    if($rurlCheck && get_rurl()) {
        return urlencode(get_rurl());
    }

    return urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
}

/**
 * Get return url
 *
 * @return null
 */
function get_rurl() {
    return isset($_GET['rurl']) ? $_GET['rurl'] : NULL;
}

/**
 * Direct URL
 *
 * @param string $operator
 * @return bool|string
 */
function redirect_url($operator = '?') {
    $url = get_rurl();

    if($url) {
        return $operator.'rurl='.urlencode($url);
    }

    return false;
}

/**
 * Secure file upload
 *
 * @param $file_name
 * @param $destination
 * @param array $allowed_file_type
 * @param int $max_upload_size
 * @param bool $uniqueName
 * @return bool|string
 */
function secure_file_upload($file_name,$destination,$allowed_file_type=array('jpg', 'jpeg', 'png'),$max_upload_size=2, $uniqueName = false) {
    $max_upload_size_byte = $max_upload_size * 1024 * 1024;

    if(!is_dir($destination))
    {
        $making = mkdir($destination,0777, true);
        chmod($destination, 0777);

        if(!$making) return false;
    }

    $fileName = $file_name['name'];
    $file_type = substr($fileName, strrpos($fileName, '.') + 1);
    $file_type = strtolower($file_type);

    if( !array_search($file_type, $allowed_file_type) && !in_array($file_type, $allowed_file_type) ) return false;
    if( $file_name['size'] > $max_upload_size_byte ) return false;
    if( isset($file_name['error']) && $file_name['error'] != 0 ) return false;

    $final_name = time()."_".preg_replace("/[^a-zA-Z0-9-_.]+/", "", $file_name['name']);

    if( $uniqueName == true ) {
        $file_detail = pathinfo($final_name);
        $final_name = md5(uniqid($file_detail['filename'], true)).'.'.strtolower($file_detail['extension']);
    }

    $final_des = $destination.$final_name;
    $uploading = move_uploaded_file($file_name['tmp_name'],$final_des);
    if( !$uploading ) return false;
    return $final_name;
}


/**
 * Generic file upload
 *
 * @param $file_name
 * @param $destination
 * @return bool|string
 */
function file_upload($file_name, $destination) {
    if(!is_dir($destination))
    {
        $making = mkdir($destination,0777, true);
        chmod($destination, 0777);

        if(!$making) return false;
    }

    $fileName = $file_name['name'];
    $file_type = substr($fileName, strrpos($fileName, '.') + 1);
    $file_type = strtolower($file_type);

    $disAllowedFiles = ['php', 'htaccess', 'exe'];
    if(in_array($file_type, $disAllowedFiles)) return false;

    if( isset($file_name['error']) && $file_name['error'] != 0 ) return false;

    $final_name = time()."_".preg_replace("/[^a-zA-Z0-9-_.]+/", "", $file_name['name']);

    $final_des = $destination.$final_name;
    $uploading = move_uploaded_file($file_name['tmp_name'],$final_des);
    if( !$uploading ) return false;
    return $final_name;
}

/**
 * Remove empty values from array
 *
 * @param $haystack
 * @return mixed
 */
function array_remove_empty($haystack) {
    foreach ($haystack as $key => $value) {
        if (is_array($value)) {
            $haystack[$key] = array_remove_empty($haystack[$key]);
        }

        if (empty($haystack[$key])) {
            unset($haystack[$key]);
        }
    }

    return $haystack;
}

/**
 * If is null
 *
 * @param $string
 * @return bool
 */
function is_null_data($string) {
    $string = trim($string);

    return strlen($string) == 0;
}

/**
 * Text to slug
 *
 * @param $text
 * @return mixed|string
 */
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

/**
 * String to slug
 *
 * @param $str
 * @param string $delimiter
 * @return string
 */
function stringToSlug($str, $delimiter = '-'){
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;
}


/**
 * Convert array to object recurssively
 *
 * @param $a
 * @return array|object
 */
function array_to_object($a) {
    if (is_array($a) ) {
        foreach($a as $k => $v) {
            if (is_integer($k)) {
                $a['index'][$k] = array_to_object($v);
            }
            else {
                $a[$k] = array_to_object($v);
            }
        }

        return (object) $a;
    }

    return $a;
}


/**
 * Add http is not present
 *
 * @param $url
 * @return string
 */
function convert_to_full_url($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}


/**
 * Get array except supplied
 *
 * @param $array
 * @param $keyArray
 * @return array
 */
function filter_array_key($array = [], $keyArray = []) {
    $newArray = [];

    foreach($keyArray as $key) {
        if(isset($array[$key])) {
            $newArray[$key] = $array[$key];
        }
    }

    return $newArray;
}

/**
 * Get array excluding supplied key
 *
 * @param array $array
 * @param array $excludeArray
 * @return array
 */
function return_array_except($array = [], $excludeArray = []) {

    foreach($excludeArray as $item) {
        if(isset($array[$item])) {
            unset($array[$item]);
        }
    }

    return $array;
}

/**
 * Router helper function
 *
 * @param $urlArray
 * @return string
 */
function view_path($urlArray)
{
    $viewPath = 'home.php';

    if(is_array($urlArray) && count($urlArray) > 0) {
        $folderArray = [];

        for($i = 0; $i < count($urlArray); $i++) {

            if($i > 0) {
                $folderArray[] = implode('/', array_slice($urlArray, 0, $i)).'/'.$urlArray[$i];
            }
            else {
                $folderArray[] = $urlArray[$i];
            }
        }

        for($j = 0; $j < count($folderArray); $j++) {
            $path = APP_VIEW_ROOT.'/'.$folderArray[$j];

            if(!is_dir($path)) {
                if($j > 0) {
                    return $folderArray[$j - 1].'/'.implode('-', array_slice($urlArray, $j)).'.php';
                }
                else {
                    return implode('-', array_slice($urlArray, $j)).'.php';
                }
            }
        }
    }

    return $viewPath;
}


function extractOnlyAllowedKeys($postedData, $allowedFieldArray) {
    $result = [];

    foreach ($postedData as $key => $value) {
        if( in_array($key, $allowedFieldArray) || array_search($key, $allowedFieldArray) ) {
            $result[$key] = $value;
        }
    }

    return $result;
}

function stringLength($string) {
    return strlen(trim($string));
}
