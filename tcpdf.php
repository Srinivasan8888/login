<?php
require_once('tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    public function Header(){
        $image_file = K_PATH_IMAGES.'logo.png';
        $this->Image($image_file, 15, 10, 22, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
    }

    public function Footer(){

        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    

    public function LoadData() {
        
        // $lines = file($file);
        // $data = array();
        // foreach($lines as $line) {
        //     $data[] = explode(';', chop($line));
        // }
        // return $data;

        //require_once('pdf.php');
        include 'db_conn.php';
        $sql = "SELECT * FROM `employee`";
        $result = $conn->query($sql);
        return $result;
    }
    

    // Colored table
    public function ColoredTable($header,$data) {

        //$pdf->Image('images/logo.png', 15, 140, 75, 113, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
        // Colors, line width and bold font
        $this->SetFillColor(33, 37, 41);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(20, 40, 50, 25);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row['Id'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['Name'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['Phone_No'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['City'], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    
}



$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 015');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// bg image properties
$pdf->AddPage();

$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'bg2.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


// table starts from here
$pdf->AddPage();

$html = '<div style="text-align:center; line-height:60px;">PERSONAL INFORMATION</div><br/>';
$pdf->writeHTML($html, true, false, true, false, '');
$tbl = '<br><table border="1" cellpadding="8">
<tr>
<td style="padding: 10px">Name</td>
<td style="padding: 10px">Srinivasan</td>
</tr>
<tr>
<td>Email</td>
<td>srinivasanr.org.in</td>
</tr>
<tr>
<td>Customer Id</td>
<td>XYMA1337</td>
</tr>
<tr>
<td>Contact No</td>
<td>808-234-7584</td>
</tr>
</table><br/>';
$pdf->writeHTML($tbl, true, false, true, false, 'C');
// ---------------------------------------------------------
$html = '<div style="text-align:center; line-height:60px;">A SSET INFORMATION</div><br/>';
$pdf->writeHTML($html, true, false, true, false, '');
$tbl1 = '<br><table border="1" cellpadding="8">
<tr>
<th>A sset Type</th>
<th>Heater Pipe</th>
</tr>
<tr>
<td>A sset Location</td>
<td>Furnace</td>
</tr>
<tr>
<td>Total Sensors</td>
<td>8</td>
</tr>
<tr>
<td>Temperature Unit</td>
<td><span>&#176;</span>C</td>
</tr>
<tr>
<td>Report Generated On</td>
<td>Date to be inserted</td>
</tr>
</table><br/>';
$pdf->writeHTML($tbl1, true, false, true, false, 'C');


$txt = <<<EOD
DISCLAIMER
EOD;
$pdf->Write(80, $txt, '', 0, 'C', true, 0, false, false, 0);

$txt = <<<EOD
The information contained in these documents is confidential, privileged and only for the information of the intended recipient and may not be used, published or redistributed without the prior written consent of Xyma Analytics Pvt Ltd.
EOD;
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
// $p = '<div style="text-align:center; height: 340px">DISCLAIMER</div>';
// $pdf->writeHTML($p, true, false, false, false, 'C');

// set font
// $pdf->SetFont('helvetica', '', 12);

// $pdf->SetFont('helvetica', '', 12);

// // add a page
$pdf->AddPage();

// column titles
// $header = array('Id', 'Name', 'Mobile No', 'City');

// // data loading
// $data = $pdf->LoadData('');

// // print colored table
// $pdf->ColoredTable($header, $data);

$html = '<table border="2" cellpadding="8">';
$html .="<tr>
        <th>Id</th>
        <th>Name</th>
        <th>Phone No</th>
        <th>City </th>
        </tr>'";


include 'db_conn.php';
$sql = "SELECT * FROM `employee`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    {
        $id = $row["Id"];
        $name = $row["Name"];
        $phone_no = $row["Phone_No"];
        $city = $row["City"];

        $html .="<tr>
        <td>". $id."</td>
        <td>". $name ."</td>
        <td>". $phone_no ."</td>
        <td>". $city ."</td>
        </tr>";
    }
}
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->AddPage();

$txt = <<<EOD
<---------------This Page is Intentionally Left Blank--------------->
EOD;
$pdf->Write(80, $txt, '', 0, 'C', true, 0, false, false, 0);

$txt = <<<EOD
DISCLAIMER
EOD;
$pdf->Write(40, $txt, '', 0, 'C', true, 0, false, false, 0);

$txt = <<<EOD
The information contained in these documents is confidential, privileged and only for the information of the intended recipient and may not be used, published or redistributed without the prior written consent of Xyma Analytics Pvt Ltd.
EOD;
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

$txt = <<<EOD
<---------------This Page is Intentionally Left Blank--------------->
EOD;
$pdf->Write(100, $txt, '', 0, 'C', true, 0, false, false, 0);

$pdf->Output('example_015.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+

