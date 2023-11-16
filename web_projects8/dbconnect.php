<?php 
    define('DB_HOST', 'localhost');
    define('DB_USER', '1'); 
    define('DB_PASSWORD', ''); 
    define('DB_NAME', 'web_lab5');
    try {
        $mysql = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    }
    catch (Exception $e) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    // $mysql = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    // if ($mysql == false) {
    //     echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //     exit();
    // }
?>
