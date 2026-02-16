<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'dailymilk';
$db_port = getenv('DB_PORT');
try {
    if ($db_port !== false && $db_port !== '' && is_numeric($db_port)) {
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name, (int)$db_port);
    } else {
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    }
    $mysqli->set_charset('utf8mb4');
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Database connection failed. Set DB_HOST, DB_USER, DB_PASS, DB_NAME environment variables.';
    error_log('DB connection error: ' . $e->getMessage());
    exit;
}
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
