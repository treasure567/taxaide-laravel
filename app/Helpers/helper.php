<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define('JWT_ALGORITHM', 'HS256');

if (! function_exists("jwt_secret")) {
    function jwt_secret() : string {
        return env('JWT_SECRET_KEY');
    }
}

if (! function_exists('jwt_encode')) {
    function jwt_encode() : string {
        $payload = [
            'uuid' => user()->uuid,
            'exp' => time() + (10 * 24 * 60 * 60)
        ];
        return JWT::encode($payload, jwt_secret(), JWT_ALGORITHM);
    }
}

if (! function_exists('jwt_decode')) {
    function jwt_decode($token) : mixed {
        try {
            return JWT::decode($token, new Key(jwt_secret(), JWT_ALGORITHM));
        } catch (\Exception $e) {
            info($e->getMessage());
            return null;
        }
    }
}

if (! function_exists('user') ) {
    function user() : User {
        return User::find(auth_id('web'));
    }
}

if (! function_exists('auth_id') ) {
    function auth_id($guard = 'web') : int {
        return auth($guard)->user()->id;
    }
}

if (! function_exists('tippy') ) {
    function tippy($tip = '', $content = '', $id = '') {
        $html = "<span class='toolTip onTop' data-tippy-content='$tip' id='$id'>$content</span>";
        return $html;
    }
}

if (! function_exists('icon') ) {
    function icon($key, $size = '15', $class = 'nav-icon') {
        $html = '<iconify-icon class=" ' . $class . '" icon="' . $key . '" style="font-size:' . $size . 'px"></iconify-icon>';
        return $html;
    }
}

if (! function_exists('load_file') ) {
    function load_file($path) : string {
        $newPath = str_replace('public/', 'public/storage/', $path);
        return (server_name() == '0.0.0.0') ? Storage::url($path) : url($newPath);
    }
}

if (! function_exists('assets') ) {
    function assets($path) : string {
        return (server_name() == '127.0.0.1') ? url('/') . "/public/assets/$path" : url('/') . "/assets/$path";
    }
}

if (! function_exists('route_name') ) {
    function route_name() : string {
        return Route::currentRouteName();
    }
}

if (! function_exists('active_menu') ) {
    function active_menu($route) : string {
        return route_name() == $route ? 'active' : '';
    }
}

if (! function_exists('current_guard') ) {
    function current_guard($guard) {
        $middlewares = Route::current()->middleware();
        $auth = 'auth:';
        $guard = $auth . $guard;
        if (in_array($guard, $middlewares)) {
            return true;
        }
        return false;
    }
}

if (! function_exists('server_name') ) {
    function server_name() : string {
        return $_SERVER['SERVER_NAME'];
    }
}

if (! function_exists('info_tip') ) {
    function info_tip($message = '') {
        $tippy = tippy($message, icon('material-symbols:info-outline'));
        return $tippy;
    }
}

if (! function_exists('status') ) {
    function status($status) : string {
        $sucess = ['successful', 'responded', 'called', 'active', 'credit', true];
        if (in_array($status, $sucess)) {
            return 'success';
        }
        $warning = ['pending'];
        if (in_array($status, $warning)) {
            return 'warning';
        }
        $danger = ['failed', 'inactive', 'banned', 'debit', false];
        if (in_array($status, $danger)) {
            return 'danger';
        }
        return 'success';
    }
}

if (! function_exists("select_dropdown")) {
    function select_dropdown($item, $selected = null) : string {
        return ($item == $selected) ? 'selected' : '';
    }
}

if (! function_exists('generate_string')) {
    function generate_string(int $length, string $type = 'alpha', string $case = 'lower', string $prefix = '', string $suffix = '') : string {
        $chars = '';
        if ($type == 'alpha') {
          $chars .= $case == 'lower' ? 'abcdefghijklmnopqrstuvwxyz' : 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif ($type == 'mixed') {
          $chars .= $case == 'lower' ? 'abcdefghijklmnopqrstuvwxyz0123456789' : ($case == 'upper' ? 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' : 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789');
        } elseif ($type == 'numeric') {
          $chars .= '0123456789';
        }
        $str = '';
        for ($i = 0; $i < $length; $i++) {
          $str .= $chars[rand(0, strlen($chars) - 1)]; 
        }
        return $prefix . $str . $suffix;
    }
}

if (! function_exists('socket')) {
    function socket($route, $method, $data = []) {
        try {
            $url = apiurl() . $route;
            $token = jwt_encode();
            $headers =  [
                'Content-Type' => 'application/json',
                "Authorization: Bearer $token"
            ];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_close($curl);
            $response = json_decode(curl_exec($curl));
            info(json_encode($response));
            if (isset($response->status) && isset($response->message)) {
                if ($response->status == true) {
                    $data = [
                        'status' => true,
                        'resp' => $response,
                        'msg' => $response->message,
                        'data' => $response->data ?? null
                    ];
                } else {
                    $data = [
                        'status' => false,
                        'resp' => $response,
                        'msg' => $response->message
                    ];
                }
            } else {
                $data = [
                    'status' => false,
                    'resp' => [],
                    'msg' => 'An error occured while trying to update the Todo, Please try again later'
                ];
            }
            return $data; 
        } catch (\Exception $e) {
            $data = [
                'status' => false,
                'resp' => [],
                'msg' => 'An error occured while trying to update the Todo, Please try again later'
            ];
            return $data; 
        }
    }
}


if (! function_exists('apiurl')) {
    function apiurl() {
        return env('NODE_URL', 'http://127.0.0.1:3123/api/v1/todo/');
    }
    
}