<?php
include "connection.php";  

//$sql = "SELECT * FROM images ORDER BY id DESC";


?>

<!DOCTYPE html>

<html>
    <head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src='assets/bootstrap/js/bootstrap.min.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		}
		.alb {
			width: 200px;
			height: 200px;
			padding: 5px;
		}
		.alb img {
			width: 100%;
			height: 100%;
		}
		a {
			text-decoration: none;
			color: black;
		}
    </style>
    <title>view page</title>

    </head>

    <body>

    <button type="button" class="btn btn-primary" onClick="location.href='logged.php'">upload page</button>
    
   <?php
   
   $sql = "SELECT * FROM images ORDER BY id";
   $res = mysqli_query($conn,  $sql);
   
   // $img = $img["image_url"];
   // $img = base64_encode($img);
   // $ext = pathinfo($name, PATHINFO_EXTENSION);
   // echo "<img src='data:upload/" .$ext.";base64,".$img."'/>";

   if (mysqli_num_rows($res) > 0) {
      while ($img = mysqli_fetch_assoc($res)) 
  
   { 
   ?> 
   <div class="alb">
      <img src="uploads/<?=$img['image_url'];?>">
   </div>


<?php } }

   ?>
               
    </body>

</html>

