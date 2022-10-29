<?php
require_once('tcpdf/tcpdf.php');

class MYPDF extends TCPDF{
    
    public function Header(){
    $this->SetFont('helvetica', 'B', 20);
    // Title to right allignment
    $this->Cell(0, 15, '<< Header TITLE >>', 0, false, 'R', 0, '', 0, false, 'M', 'M');
}
}


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetPrintHeader(true);
$pdf->SetPrintFooter(true); 
// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('');
$pdf->setTitle('');
$pdf->setSubject('');
$pdf->setKeywords('');

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

$pdf->AddPage();

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

