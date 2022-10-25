<?php
// session_start();
// if(!isset($_SESSION['ID'])){
// 	header("Location : login.php");
// 	die();
//   }
?>


<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	<title>Image Upload Using PHP</title>
	<style>
		
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
		}
	</style>
</head>
<body>
	<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data">

           <input type="file" 
                  name="my_image">

           <input type="submit" 
                  name="submit"
                  value="Upload"
				  class="btn btn-outline-primary">

				  <button a href= "view.php" type="button" onclick="window.location.href='view.php'" class="btn btn-primary">view image</button>
				  <button a href= "view.php" type="button" onclick="window.location.href='pdf.php'" class="btn btn-primary">View Table</button>
				  
     	
     </form>
</body>
</html>