<?php

namespace wccplatform\phalapiPdf;

/** PHPPdf root directory */
if (!defined('PHPPDF_ROOT')) {
    define('PHPPDF_ROOT', dirname(__FILE__) . '/');
    require(PHPPDF_ROOT . 'tcpdf/tcpdf.php');
}

class Lite
{

    public $pdf;

    public function __construct()
    {
        $this->pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    public function getInstance()
    {

        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor("WCC");

        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//        $this->pdf->Ln(4);
        return $this->pdf;
    }

    public function exportPdf($file_name, $title, $html)
    {

        $pdf = $this->getInstance();
        $pdf->SetTitle($title);

        $pdf->setHeaderFont(Array(
            "stsongstdlight",
            "",
            10
        ));

        $pdf->setFooterFont(Array(
            "stsongstdlight",
            "",
            8
        ));

        $pdf->SetHeaderData("", 0, date('Y/m/d'), '');

        $pdf->SetFont("stsongstdlight", "", '10');
        $pdf->AddPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        ob_end_clean();
        $pdf->Output($file_name . '.pdf', "I");
    }
}
