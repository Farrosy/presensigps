<?php

// router untuk PHP built-in server
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false; // layani file langsung
}

require_once __DIR__.'/public/index.php';
