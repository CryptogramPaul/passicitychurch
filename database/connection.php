<?php
    if(!defined('DB_SERVER')){
        require_once("config.php");
    }

    $servername = DB_SERVER;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
    $database = DB_NAME;
    
    // $servername = 'localhost';
    // $username = "root";
    // $password = "";
    // $database = "passicitychurch";    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    // $conn = null; // Close connection

?>