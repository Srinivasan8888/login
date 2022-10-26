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

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Srinivasan');
$pdf->SetTitle('Xyma Analytics');
$pdf->SetSubject('Sample document');
$pdf->SetKeywords('Xyma');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// column titles
$header = array('Id', 'Name', 'Mobile No', 'City');

// data loading
$data = $pdf->LoadData('');

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('report.pdf', 'I');

