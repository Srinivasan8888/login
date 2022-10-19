<?php
include_once("db_conn.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table class = "table table-dark" style="width:100%;">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Phone No</th>
            <th>City</th>
            </tr>
        </thead>
        <tbody>
        <?php
        
        $sql = "SELECT * FROM 'Employee'";
        $result = $conn->query($sql);
        $result->execute();

        // if($result->rowCount() > 0):
        //     $rows = $result->fetchAll();
        //     //foreach($rows as $row):
        // 

        while($row = $result->fetch_assoc()){
           echo "<tr>
           <td>". $row["Id"] ."</td>
           <td>". $row["Name"] ."</td>
           <td>". $row["Phone_No"] ."</td>
           <td>". $row["City"] ."</td>
           </tr>";
        }?>
        
        </tbody>

        <?php
        //endforeach;
    //endif;
        ?>
    </table>
</body>
</html>