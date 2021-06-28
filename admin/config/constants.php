<?php
    //Start the session
    session_start();

    //Upto 2. Food Order website with PHP and MYSQL (Add and Display Admins)
    //Create constants to store non repeating values
    define('SITEURL','http://localhost/food_menu/');
    define('LOCALHOST',"localhost");
    define('DB_USERNAME',"root");
    define('DB_PASSWORD',"");
    define('DB_NAME',"food_menu");

    $conn= mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //Database connection
    $db_select= mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //Database selection
?>





















