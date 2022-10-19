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
    <button class="btn btn-success" type="button" value="print" onclick=generatePDF()>Generate PDF</button>
    <script >
    // var doc = new jsPDF();
    // var specialElementHandlers = {
    //     '#editor': function (element, renderer) {
    //         return true;
    //     }
    // };

    // $('#cmd').click(function () {
    //     doc.fromHTML($('#content').html(), 15, 15, {
    //         'width': 170,
    //             'elementHandlers': specialElementHandlers
    //     });
    //     doc.save('sample-file.pdf');
    // });

        // $(document).ready(funtction($){
        //     $(document).on('click','btn_print',function(event){
        //         event.preventDefault();
        //         var element = document.getElemenetById('container_content');
        //         //html2pdf().from(element).save();
        //         //html2pdf().set({filename: js.AutoCode()+'.pdf'}).from(element).save();
        //         var opt = {
        //             margin: 1,
        //             filename: 'pageContent_'+js.AutoCode()+'.pdf',
        //             image: {type: 'jpeg', quality: 0.98},
        //             html2canvas: {scale: 2},
        //             jsPDF: {unit: 'in', format: 'letter',orientation: 'potrait'};
                    
        //         }
        //     });
        // });

</script>
        </tbody>
    </table>
</body>
</html>