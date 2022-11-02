<?php 
    require "db_conn.php";

$s1 = rand(0,503);
echo $s1 ."<br>";
$s2 = rand(0,503);
echo $s2 ."<br>";
$s3 = rand(0,503);
echo $s3 ."<br>";
$s4 = rand(0,503);
echo $s4 ."<br>";
$s5 = rand(0,503);
echo $s5 ."<br>";
$s6 = rand(0,503);
echo $s6 ."<br>";
$s7 = rand(0,503);
echo $s7 ."<br>";
$s8 = rand(0,503);
echo $s8 ."<br>";
$s9 = rand(0,503);
echo $s9 ."<br>";
$s10 = rand(0,503);
echo $s10 ."<br>";
$s11 = rand(0,503);
echo $s11 ."<br>";
$s12 = rand(0,503);
echo $s12 ."<br>";
$s13 = rand(0,503);
echo $s13 ."<br>";
$s14 = rand(0,503);
echo $s14 ."<br>";
$s15 = rand(0,503);
echo $s15 ."<br>";
$s16 = rand(0,503);
echo $s16 ."<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        window.setTimeout( function() {
            window.location.reload();
        }, 60);
    </script>
    <?php
    $sql = "INSERT INTO sensor (S1, S2, S3, S4, S5, S6, S7, S8, S9, S10, S11, S12, S13, S14, S15, S16)
    VALUES ('$s1', '$s2', '$s3' ,'$s4' , '$s5' ,'$s6' ,'$s7' ,'$s8' ,'$s9' ,'$s10' ,'$s11' ,'$s12' ,'$s13' ,'$s14' ,'$s15' ,'$s16')";

    if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    ?>
</body>
</html>