<?php
include_once("db_conn.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        
    </style>
</head>
<body>
    <div id="content">
    <table class = "table table-dark" id="table"
    style="width:100%;"
    >
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
        
        $sql = "SELECT * FROM `employee`";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
           echo "<tr>
           <td>". $row["Id"] ."</td>
           <td>". $row["Name"] ."</td>
           <td>". $row["Phone_No"] ."</td>
           <td>". $row["City"] ."</td>
           </tr>";
        }?>
    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
    <script src="script.js"></script>
        </tbody>
    </table>
    </div>
    <!-- <button id="download" class="btn btn-success" type="button" value="print">Generate PDF</button> -->
    <form method="post" action="tcpdf.php">
    <button class="btn btn-success">Generate employee PDF</button>

    <input type="button" onclick="window.location.href='tcpdf1.php';" class="btn btn-success" value="tcpdf 1"/>

    <input type="button" onclick="window.location.href='tcpdf2.php';" class="btn btn-success" value="tcpdf 2"/>

    <input type="button" onclick="window.location.href='tcpdf3.php';" class="btn btn-success" value="tcpdf 3"/>

    <input type="button" onclick="window.location.href='tcpdf4.php';" class="btn btn-success" value="tcpdf 4"/>
    
    <input type="button" onclick="window.location.href='tcpdf5.php';" class="btn btn-success" value="tcpdf 5"/>

    <input type="button" onclick="window.location.href='tcpdf6.php';" class="btn btn-success" value="tcpdf 6"/>

    <input type="button" onclick="window.location.href='tcpdf7.php';" class="btn btn-success" value="tcpdf 7"/>

    <input type="button" onclick="window.location.href='tcpdf8.php';" class="btn btn-success" value="tcpdf 8"/>

    <input type="button" onclick="window.location.href='tcpdf9.php';" class="btn btn-success" value="tcpdf 9"/>

    <input type="button" onclick="window.location.href='tcpdf10.php';" class="btn btn-success" value="tcpdf 10"/>

    <input type="button" onclick="window.location.href='tcpdf11.php';" class="btn btn-success" value="tcpdf 11"/>

    <input type="button" onclick="window.location.href='tcpdf12.php';" class="btn btn-success" value="tcpdf 12"/>

    <input type="button" onclick="window.location.href='tcpdf13.php';" class="btn btn-success" value="tcpdf 13"/>

    <input type="button" onclick="window.location.href='tcpdf14.php';" class="btn btn-success" value="tcpdf 14"/>

    <input type="button" onclick="window.location.href='tcpdf15.php';" class="btn btn-success" value="tcpdf 15"/>

    <input type="button" onclick="window.location.href='tcpdf16.php';" class="btn btn-success" value="tcpdf 16"/>


    </form>   

</body>
</html>

