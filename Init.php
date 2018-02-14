<?php

error_reporting(E_ALL);
ini_set("error_log", __DIR__."/logs/error-log.log");

if ($_SERVER['DEV_SERVER'] == 'enabled'){
    define('DEV_SERVER', true);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

}else{
    define('DEV_SERVER', false);
}

function __autoload($class){
    $path = $class . ".php";
    $path = str_replace ( "\\", "/" , $path);

    include_once $path;
}

function mediaExist($file){
    $path = __DIR__.'/www'.$file;

    if (file_exists($path)){
        return true;
    }
    return false;
}

//user configuration
define("SITE_NAME", "S.ENGINE");

define("BIG_IMAGE", 1200);
define("MEDIUM_IMAGE", 800);
define("PREVIEW_IMAGE", 240);

if (DEV_SERVER){
    define("SQL_SERVER", "localhost");
    define("SQL_USER", "root");
    define("SQL_PASSWORD", "");
    define("SQL_DB", "sengine");
}else{

}

define("PASS_SALT", "RAkyEnA&Zd9F3VQ@Tc%aMm&1NuKiW_um#DanW2mgg1LWZJHZ^fn%#8Yb95h#oR#%");
define("GALLERY_DIR", str_replace('\\', '/', __DIR__.'/www/media/gallery'));
define("GALLERY_LINK", "/media/gallery");

date_default_timezone_set('Europe/Moscow');
session_start();

