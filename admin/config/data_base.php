<?php 
    define("SERVER_NAME",'localhost');
    define("USER_NAME",'root');
    define("PASSWORD",'');
    // define("DB_NAME",'sir_blog_21');
    define("DB_NAME",'new_pro_ex');
    // define("DB_NAME",'bolg_21a');

    try{
        $conn = new PDO("mysql:host=".SERVER_NAME.";dbname=".DB_NAME, USER_NAME, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "success";
    }catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
?>