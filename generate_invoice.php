<?php
require_once ('vendor/autoload.php');

//create new PDF document
$pdf = new TCPDF();

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('stringLeap');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Invoice', 'stringLeap');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margin
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add page
$pdf->AddPage();

// set font
$pdf->SetFont('helvetica', '', 12);

// add content
$html = '<h1>Invoice</h1>
<p>Thank you for your purchase!</p>
<table>
<tr>
    <th>Item</th>
    <th>Price</th>
</tr>
<tr>
    <td>Product 1</td>
    <td>$10.00</td>
</tr>
<tr>
    <td>Product 2</td>
    <td>$15.00</td>
</tr>
<tr>
    <td><strong>Total</strong></td>
    <td><strong>$25.00</strong></td>
</tr>
</table>';

// output the html content
$pdf->writeHTML($html, true, false, true, false, '');

// Define the absolute path to save the PDF
$savePath = realpath(dirname(__FILE__)) . '/invoice.pdf'; // __DIR__ gives the directory of the current script

// Check if the directory is writable
if (is_writable(dirname($savePath))) {
    // Close and output PDF document
    $pdf->Output($savePath, 'F');
} else {
    echo 'Directory is not writable.';
}