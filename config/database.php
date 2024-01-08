<?php 
    define('DB_NAME', 'expctrl_db');
    define('DB_USER', 'dev');
    define('DB_PASS', '123456');
    define('DB_HOST', 'localhost');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($conn->connect_error){
        die('Connection Failed ' . $conn->connect_error);
    }