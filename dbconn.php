<?php
$dsn="mysql:host=localhost;dbname=registration_db";
$username="root";
$password='';


try{
    $pdo=new PDO($dsn,$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e){
    die("database connection failed: ".$e->getMessage());

}
?>