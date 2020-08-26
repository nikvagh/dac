<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_Generate {

    public function __construct() {
//        parent::__construct();
//        echo "123";exit;
    }

    function create_pdf($pdf) {
        include('./vendor/autoload.php');

        $mpdfConfig = array(
            'mode' => 'utf-8', 
            'format' => 'A4',    // format - A4, for example, default ''
            'default_font_size' => 9,     // font size - default 0
            'default_font' => '',    // default font family
            'margin_left' => 10,    	// 15 margin_left
            'margin_right' => 10,    	// 15 margin right
            'margin_top' => 10,     // 16 margin top
            'margin_bottom' => 10,    	// margin bottom
            'margin_header' => 8,     // 9 margin header
            'margin_footer' => 9,     // 9 margin footer
            'orientation' => 'P'  	// L - landscape, P - portrait
        ); 
        
        $mpdf = new \Mpdf\Mpdf($mpdfConfig); 
        //    $mpdf = new mPDF('', 'A4', '', '', 5, 5, 130, 30, 8, 9, 'P');
        $mpdf->use_kwt = true;
        $mpdf->SetDisplayMode('fullpage');
        if (isset($pdf['title'])) {
            $mpdf->SetTitle($pdf['title']);
        }
        if (isset($pdf['author'])) {
            $mpdf->SetAuthor($pdf['author']);
        }
        if (isset($pdf['creator'])) {
            $mpdf->SetCreator($pdf['creator']);
        }
        if (isset($pdf['badge']) && $pdf['badge'] == 'TRUE') {

            $mpdf->showWatermarkImage = true;
            $mpdf->watermarkImageAlpha = 0.3;
            //$mpdf->showWatermarkText = TRUE;
        } else {
            $mpdf->showWatermarkText = FALSE;
        }

        $mpdf->WriteHTML($pdf['html']);
        // $mpdf->AddPage();
        if (isset($pdf['attach'])) {
            $mpdf->Output($pdf['attachpath'].$pdf['filename'], 'F'); //download and set into pdf folder in project
            return $pdf['filename'];
        } else {
            $mpdf->Output($pdf['filename'], 'D');
            exit;
        }
    }

    function create_pdf1($pdf) {
        // include('./mpdf/Mpdf/autoload.php');
        include('./vendor/autoload.php');
        // echo __DIR__ . '/vendor/autoload.php';
        // require_once __DIR__ . '/vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf(); 

        // $mpdf = new mPDF('utf-8', 'A4-L', 11, '', 5, 5, 0, 5, 0, 0, 'L');

        $mpdf->use_kwt = true;
        $mpdf->SetDisplayMode('fullpage');
        if (isset($pdf['title'])) {
            $mpdf->SetTitle($pdf['title']);
        }
        if (isset($pdf['author'])) {
            $mpdf->SetAuthor($pdf['author']);
        }
        if (isset($pdf['creator'])) {
            $mpdf->SetCreator($pdf['creator']);
        }
        if (isset($pdf['badge']) && $pdf['badge'] == 'TRUE') {

            $mpdf->showWatermarkImage = true;
            $mpdf->watermarkImageAlpha = 0.3;
            //$mpdf->showWatermarkText = TRUE;
        } else {
            $mpdf->showWatermarkText = FALSE;
        }


        $img = base_url() . 'assets/images/cover.jpg';
        $mpdf->AddPage();
        $mpdf->Image($img, 0, 0, 297, 211, 'jpg', '', true, false);
        $mpdf->AddPage();
        // $mpdf->WriteHTML($pdf['html1']);
        // $mpdf->AddPage();
        // $mpdf->WriteHTML($pdf['html2']);
        // $mpdf->AddPage();
        // $mpdf->WriteHTML($pdf['html3']);
        // $mpdf->AddPage();
        // $mpdf->WriteHTML($pdf['html4']);
        // $mpdf->AddPage();
        if (isset($pdf['attach'])) {
            $mpdf->Output('./pdf/' . $pdf['filename'], 'F'); //download and set into pdf folder in project
            return './pdf/' . $pdf['filename'];
        } else {
            $mpdf->Output($pdf['filename'], 'D');
            exit;
        }
    }
	
	 function create_pdf_bank($pdf) {

        include('./mpdf/mpdf.php');
        
        $mpdf = new mPDF('', 'A4', 9, '', 10, 10, 10, 10, 8, 9, 'P');
        //    $mpdf = new mPDF('', 'A4', '', '', 5, 5, 130, 30, 8, 9, 'P');
        $mpdf->use_kwt = true;
        $mpdf->SetDisplayMode('fullpage');
        if (isset($pdf['title'])) {
            $mpdf->SetTitle($pdf['title']);
        }
        if (isset($pdf['author'])) {
            $mpdf->SetAuthor($pdf['author']);
        }
        if (isset($pdf['creator'])) {
            $mpdf->SetCreator($pdf['creator']);
        }
        if (isset($pdf['badge']) && $pdf['badge'] == 'TRUE') {

            $mpdf->showWatermarkImage = true;
            $mpdf->watermarkImageAlpha = 0.3;
            //$mpdf->showWatermarkText = TRUE;
        } else {
            $mpdf->showWatermarkText = FALSE;
        }
 		$mpdf->AddPage();
        $mpdf->WriteHTML($pdf['html']);
        $mpdf->AddPage();
        $mpdf->WriteHTML($pdf['html1']);
		 
        if (isset($pdf['attach'])) {
            $mpdf->Output('./pdf/' . $pdf['filename'], 'F'); //download and set into pdf folder in project
            return './pdf/' . $pdf['filename'];
        } else {
            $mpdf->Output($pdf['filename'], 'D');
            exit;
        }
    }

    function create_pdf_budget($pdf) {

        include('./mpdf/mpdf.php');
        
        $mpdf = new mPDF('', 'A4', 9, '', 10, 10, 10, 10, 8, 9, 'P');
        //    $mpdf = new mPDF('', 'A4', '', '', 5, 5, 130, 30, 8, 9, 'P');
        $mpdf->use_kwt = true;
        $mpdf->SetDisplayMode('fullpage');
        if (isset($pdf['title'])) {
            $mpdf->SetTitle($pdf['title']);
        }
        if (isset($pdf['author'])) {
            $mpdf->SetAuthor($pdf['author']);
        }
        if (isset($pdf['creator'])) {
            $mpdf->SetCreator($pdf['creator']);
        }
        if (isset($pdf['badge']) && $pdf['badge'] == 'TRUE') {

            $mpdf->showWatermarkImage = true;
            $mpdf->watermarkImageAlpha = 0.3;
            //$mpdf->showWatermarkText = TRUE;
        } else {
            $mpdf->showWatermarkText = FALSE;
        }
 		$mpdf->AddPage();
        $mpdf->WriteHTML($pdf['html1']);
        $mpdf->AddPage();
        $mpdf->WriteHTML($pdf['html']);
		 
        if (isset($pdf['attach'])) {
            $mpdf->Output('./pdf/' . $pdf['filename'], 'F'); //download and set into pdf folder in project
            return './pdf/' . $pdf['filename'];
        } else {
            $mpdf->Output($pdf['filename'], 'D');
            exit;
        }
    }

}
