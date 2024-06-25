<?php
// path to the PDF file
$pdfFile = realpath(dirname(__FILE__)) . '/invoice.pdf';

// check if the file exists
if (file_exists($pdfFile)) {
    // set headers to download the pdf file
    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="invoice.pdf"');
    header('Content-Length: ' . filesize($pdfFile));

    readfile($pdfFile);
} else {
    echo 'File does not exist.';
}