<?php 
include_once("connection.php");
session_start();

if(isset($_POST['submit']) && isset($_FILES['upload'])){
   
    echo "<pre>";
    print_r($_FILES['upload']);
    echo "</pre>";

    $name       = $_FILES['upload']['name'];
    $tmp_name   = $_FILES['upload']['tmp_name'];
    //$type       = $_FILES['UPLOAD']['type'];
    $error      = $_FILES['upload']['error'];
    $size       = $_FILES['upload']['size'];
    
    if ($error === 0) {
        if($size > 1250000) {
            //echo "<script>alert('File size is too large. Try less than 1mb.')</script>";
            // echo ("File size is too large. Try less than 1mb");
       $er = "file size is too large! try less than "; 
       header("Location: logged.php?error=$er");
        
    } else {

            $type = pathinfo($name, PATHINFO_EXTENSION);
            $ex = strtolower($type);
            $allowedex = array("jpg","jpeg","png","zip");

        if (in_array($ex, $allowedex)){

            $new_name = uniqid("IMG-", true).'.'.$ex;
            //$img_upload = './uploads/'.$new_name;
            //move_uploaded_file($new_name, $img_upload);

            $query = "INSERT INTO images (image_url) VALUES('$new_name')";
            mysqli_query($conn, $query);
            //$er = "file uploaded";
            //header("Location: logged.php?error=$er");
            //header("Location: img.php");

        }else{
                //echo "<script>alert('not a valid file type.')</script>";
                $er = "not a valid file type.";
                header("Location: logged.php?error=$er");
            }
        }
    } else {
        //echo "<script>alert('unexpected error has occured. Try again!')</script>";
        $er = "unexpected error has occured";
        header("Location: logged.php?error=$er");
    }
    
}else {
    //echo "<script>alert('file is not uploaded')</script>"; 
    // $er = "file not uploaded";
    // header("Location: logged.php?error=$er");
}

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
        <title>Logged-in Page</title>
        <style>
           body{
            padding-top: 20px;
            background-color: ffff;
        }
        </style>
    </head>
     
    <body>
       <!-- <P>you are sucessfully logged-in</P> -->
       
       
       
       <div class="upload-box">
        <form action="#" method="post" enctype="multipart/form-data">
            <input type = "file" name="upload">
            <input type="submit" class="btn btn-outline-primary" name="submit" value="upload">

            <?php if(isset($_GET['error'])):      ?>
            <p> <?php echo $_GET['error']; ?></p>
            <?php endif ?>

            <button type="button" class="btn btn-primary" onClick="location.href='img.php'">view images</button>
            <!-- <?php
            $query1 = "SELECT * FROM `image` ORDER BY `image`.`image_url` DESC";
            //$query1 = "SELECT * FROM image ORDER BY id DESC";
            $req = mysqli_query($conn, $query1);
            
            if(mysqli_num_rows($req) > 0){
                while ($image = mysqli_fetch_assoc($res)) { ?>
                    
                <div class="alb">
                    <img src="upload/<?=$image['image_url']?>">
                </div>
                <?php }} ?> -->
        </form>
        </div>
    </body>
</html>