<?php
if (!function_exists('config')) {
    function config($key, $default = null) {
        static $cache = [];
        if (array_key_exists($key, $cache)) {
            return $cache[$key];
        }
        $envMap = [
            'db.host' => ['DB_HOST', 'localhost'],
            'db.user' => ['DB_USER', 'root'],
            'db.pass' => ['DB_PASS', ''],
            'db.name' => ['DB_NAME', 'dailymilk'],
            'db.port' => ['DB_PORT', null],
            'imagekit.private_key' => ['IMAGEKIT_PRIVATE_KEY', null],
            'imagekit.url' => ['IMAGEKIT_URL_ENDPOINT', null],
        ];
        if (isset($envMap[$key])) {
            $envName = $envMap[$key][0];
            $fallback = $envMap[$key][1];
            $value = getenv($envName);
            if ($value === false || $value === '') {
                $cache[$key] = $fallback;
                return $cache[$key];
            }
            $cache[$key] = $value;
            return $cache[$key];
        }
        $cache[$key] = $default;
        return $cache[$key];
    }
}
$envPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
if (is_readable($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            $pos = strpos($line, '=');
            if ($pos === false) {
                continue;
            }
            $name = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos + 1));
            if ($name === '') {
                continue;
            }
            $len = strlen($value);
            if ($len >= 2 && (($value[0] === '"' && $value[$len - 1] === '"') || ($value[0] === "'" && $value[$len - 1] === "'"))) {
                $value = substr($value, 1, -1);
            }
            if (getenv($name) === false) {
                putenv($name . '=' . $value);
            }
        }
    }
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db_host = config('db.host');
$db_user = config('db.user');
$db_pass = config('db.pass');
$db_name = config('db.name');
$db_port = config('db.port');

$port = null;
if ($db_port !== false && $db_port !== '' && is_numeric($db_port)) {
    $port = (int)$db_port;
}

if ($port !== null) {
    $mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name, $port);
} else {
    $mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name);
}

if ($mysqli->connect_errno && $db_name === 'dailymilk') {
    $altDbName = 'daily_milk';
    if ($port !== null) {
        $alt = @new mysqli($db_host, $db_user, $db_pass, $altDbName, $port);
    } else {
        $alt = @new mysqli($db_host, $db_user, $db_pass, $altDbName);
    }
    if (!$alt->connect_errno) {
        $mysqli = $alt;
    }
}

if ($mysqli->connect_errno) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');
try {
    $set = $mysqli->query("SELECT * FROM `setting` LIMIT 1")->fetch_assoc();
    if (!$set) {
        $set = [];
    }
    if (!isset($set['timezone']) || $set['timezone'] === '') {
        $set['timezone'] = 'UTC';
    }
    if (!isset($set['logo']) || $set['logo'] === '') {
        $set['logo'] = 'assets/images/logo.svg';
    }
    if (!isset($set['pdbanner']) || $set['pdbanner'] === '') {
        $set['pdbanner'] = 'assets/images/favicon.ico';
    }
    if (!isset($set['d_title']) || $set['d_title'] === '') {
        $set['d_title'] = 'Daily Milk';
    }
    if (!isset($set['currency']) || $set['currency'] === '') {
        $set['currency'] = 'USD';
    }
    date_default_timezone_set($set['timezone']);
} catch (Throwable $e) {
    error_log('Setting fetch error: ' . $e->getMessage());
}
try {
    $main = $mysqli->query("SELECT * FROM `tbl_rmilk` LIMIT 1")->fetch_assoc();
} catch (Throwable $e) {
    error_log('tbl_rmilk fetch error: ' . $e->getMessage());
}
?>
