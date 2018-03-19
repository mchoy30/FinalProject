<?php

    // Define constants for your DB user, password and database.
    // Uses these constants to connect to your DB by creating a PDO object called $db.
    define('DB_DSN','mysql:host=localhost;port=3306;dbname=webdevproject;charset=utf8');
    define('DB_USER','finalProjectUser');
    define('DB_PASS','gorgonzola7!');    
    
    // Create a PDO object called $db.
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    }
?>