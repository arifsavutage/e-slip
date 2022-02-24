<?php
require 'vendor\autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

function samplepdf($template = null)
{
    $html2pdf = new Html2Pdf('P', 'A4', 'en', true);
    $html2pdf->writeHTML($template);
    $html2pdf->output();
}
