<?php
error_reporting(0);
$host = "localhost";
$user = "root";
$password = "";
$db = "suma";
$conn = new mysqli($host,$user,$password,$db, 3308);


if($conn-> connect_error)
{
    die("connection failed" .$conn->connect_error);
} else 
{
    echo "1";
}
?>