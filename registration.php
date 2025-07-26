<?php
require_once 'dbconn.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $username=trim($_POST['username']);
    $email=filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL);
    $password=trim($_POST['password']);
    $hashed_password=password_hash($password,PASSWORD_DEFAULT);
     if(empty($username)||empty($email)||empty($password)){
        $message="fill all required fields";
     }elseif(strlen($password)<6){
        $message="password should have digits greater than 6";
     }
     else{
        $sql="INSERT INTO users(username,email,password)values(?,?,?)";
        $stmt=$pdo->prepare($sql);
        try{
            $stmt->execute([$username,$email,$hashed_password]);
            $message="registration successfully";
            header('location:index.html');
        }catch(PDOException $e){
            die("registration  fails".$e->getMessage());
        }
     }


}