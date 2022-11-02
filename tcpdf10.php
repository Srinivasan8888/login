<?php
require_once('tcpdf/tcpdf.php');
include 'db_conn.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo1.jpg';
        $this->Image($image_file, 10, 5, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', '', 8);
        // Title
        date_default_timezone_set('Asia/Calcutta');
        $tDate = date("F j, Y, g:i a");
        $html = '<p>W: www.xyma.in M: info@xyma.in</p>';
        $this->writeHTML($html, true, false, false, false, 'R');
        $this->Cell(160.5, 4, 'Report Generated on: '.$tDate, 0, 0, 'R', 0, '', 0, false, 'T', 'M');       
        
        // $html ='<hr>';
        // $html ='<hr>';
        // $this->writeHTML($html, true, false, false, false, ''); 
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }}
    

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('');
$pdf->SetSubject('');
$pdf->SetKeywords('');

$pdf->SetPrintHeader(true);
$pdf->SetPrintFooter(true); 


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
$page_format = array(
    'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
    'CropBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 297),
    'BleedBox' => array ('llx' => 5, 'lly' => 5, 'urx' => 205, 'ury' => 292),
    'TrimBox' => array ('llx' => 10, 'lly' => 10, 'urx' => 200, 'ury' => 287),
    'ArtBox' => array ('llx' => 15, 'lly' => 15, 'urx' => 195, 'ury' => 282),
    'Dur' => 3,
    'trans' => array(
        'D' => 1.5,
        'S' => 'Split',
        'Dm' => 'V',
        'M' => 'O'
    ),
    'Rotate' => 90,
    'PZ' => 1,
);

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
// ---------------------------------------------------------
//table starts from here
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
$html = '<div style="text-align:center; line-height:60px;">ASSET INFORMATION</div><br/>';
$pdf->writeHTML($html, true, false, true, false, '');
$tbl1 = '<br><table border="1" cellpadding="8">
<tr>
<th>Asset Type</th>
<th>Heater Pipe</th>
</tr>
<tr>
<td>Asset Location</td>
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

if ($count > 8){
    $p = "L";
}
else{
    $p = "P";
}
$pdf->AddPage('L');

$html = '<table id="Table_id" border="2" cellpadding="8">';
$html .="
<tr>
<th><strong>Id</strong></th>
<th><strong>S1</strong></th>
<th><strong>S2</strong></th>
<th><strong>S3</strong></th>
<th><strong>S4</strong></th>
<th><strong>S5</strong></th>
<th><strong>S6</strong></th>
<th><strong>S7</strong></th>
<th><strong>S8</strong></th>
<th><strong>S9</strong></th>
<th><strong>S10</strong></th>
</tr>";

$sql = "SELECT Id,S1,S2,S3,S4,S5,S6,S7,S8,S9,S10
FROM sensor ORDER BY Id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        
    {
        $id = $row["Id"];
        $s1 = $row['S1'];
        $s2 = $row["S2"];
        $s3 = $row["S3"];
        $s4 = $row["S4"];
        $s5 = $row["S5"];
        $s6 = $row["S6"];
        $s7 = $row["S7"];
        $s8 = $row["S8"];
        $s9 = $row["S9"];
        $s10 = $row["S10"];

        $html .="
        <tr>
        <td>". $id ."</td>
        <td>". $s1 ."</td>
        <td>". $s2 ."</td>
        <td>". $s3 ."</td>
        <td>". $s4 ."</td>
        <td>". $s5 ."</td>
        <td>". $s6 ."</td>
        <td>". $s7 ."</td>
        <td>". $s8 ."</td>
        <td>". $s9 ."</td>
        <td>". $s10 ."</td>
        </tr>";
    }
}
}


$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');


$pdf->AddPage('P');

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

$pdf->Output('sample.pdf', 'I');
?>