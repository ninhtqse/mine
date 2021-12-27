<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

function coreAutoload($class)
{
    $root   = '../core/';
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


// chú ý: trong đối tượng router hoàn toàn không có method get, post, put gì cả
/// nhưng ở đây mình vẫn gọi 1 method get => trong php nó sẽ chạy vào hàm __call 
$router->post('/api/v1/request/get', function ($request) use($headers) {
    //get raw json request
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $request =  json_decode($json,true);

    $curl = curl_init($request['url']);
    curl_setopt($curl, CURLOPT_URL, $request['url']);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);

    curl_close($curl);
    return $resp;
});

/// tương tự khi gọi method post mà router không có method post nên sẽ chạy vào hàm __call
$router->post('/api/v1/request', function ($request) use($headers){
    //get raw json request
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $request =  json_decode($json,true);

    $curl = curl_init($request['url']);
    curl_setopt($curl, CURLOPT_URL, $request['url']);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = $request['request'];
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);

    curl_close($curl);
    return $resp;
});

/// kết thúc hoàn toàn quá trình
/// tại đây hàm __destruct được gọi, vì hàm hủy được chạy khi hệ thống chương trình hủy 1 đối tượng
/// lúc này là lúc ta thực thi code cần thiết theo từng router