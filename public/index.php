<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

function coreAutoload($class)
{
    $root = '../core/';
    $prefix = 'Core\\';
    // remove prefix

    $classWithoutPrefix = preg_replace('/^' . preg_quote($prefix) . '/', '', $class);
    // Thay thế \ thành /
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classWithoutPrefix) . '.php';

    $path = $root . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}

spl_autoload_register('coreAutoload');

use Core\Request;
use Core\Router;

/// khởi tạo đối tượng router
$router = new Router(new Request);

$headers = array(
    "x-foody-access-token: ''",
    "x-foody-api-version: 1",
    "x-foody-app-type: 1004",
    "x-foody-client-id: ''",
    "x-foody-client-language: 'vi'",
    "x-foody-client-type: 1",
    "x-foody-client-version: 3.0.0",
    "Content-Type: application/json",
);


$router->get('/', function ($request) {
    include_once(__DIR__.'/../views/index.php');
});

$router->get('/hash/base64', function ($request) use($headers) {
    include_once(__DIR__.'/../views/hash/base64.php');
});

$router->get('/hash/md5', function ($request) use($headers){
    include_once(__DIR__.'/../views/hash/md5.php');
});

$router->get('/hash/uuid', function ($request) use($headers){
    include_once(__DIR__.'/../views/hash/uuid.php');
});

$router->get('/hash/sha256', function ($request) use($headers){
    include_once(__DIR__.'/../views/hash/sha256.php');
});

$router->get('/hash/json', function ($request) use($headers){
    include_once(__DIR__.'/../views/hash/json.php');
});

$router->get('/hash/signature', function ($request) use($headers){
    include_once(__DIR__.'/../views/hash/signature.php');
});