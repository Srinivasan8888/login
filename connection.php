<?php
error_reporting(0);
$host = "localhost";
$user = "root";
$password = "";
$db = "suma";
$conn = new mysqli($host,$user,$password,$db, 3308);


if($conn-> connect_error)
{
    die("" .$conn->connect_error);
    echo "<script>alert('connection failed to database! Try again.')</script>";
} else 
{
    echo "";
}
?> 