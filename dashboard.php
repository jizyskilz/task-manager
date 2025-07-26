<?php
session_start();
if(!isset($_SESSION['username']));{
    header('location:login.php');
}
echo "welcome ".$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBORD</title>
</head>
<body>
    <div class="the_header">
        <h1>the runner is cooking here </h1>
        <p>try this out</p>
        <p>hello my name is nelson emanuel sauka i am 22 years of age:
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Laboriosam laudantium dolores, 
            quos molestias provident ad ipsam corrupti, dolor quaerat,
             nobis harum expedita praesentium doloribus eum maxime amet? Error, repellat sunt.
        </p>
    </div>
</body>
</html>