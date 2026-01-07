<?php
require_once __DIR__."/GeneratePdf.php";
require_once __DIR__."/vendor/autoload.php";
use Dompdf\Options;

$ticket_id = $_GET['id'];
$options = new Options();
$pdf = new GeneratePdf($options);
$pdf->downloadPdf($ticket_id);
