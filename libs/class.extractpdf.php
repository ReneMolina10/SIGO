<?php
//require_once 'bootstrap.php';

require_once dirname(__FILE__).'/vendor_extract_img_txt_pdf/autoload.php';
include ( dirname(__FILE__).'/vendor_extract_img_txt_pdf/phpclasses/pdf-to-text/PdfToText.phpclass' ) ;

/**
* 
*/
class extractPdf 
{
    var $pdf;
    function __construct($file)
    {
        $this->pdf = new PdfToText( $file, PdfToText::PDFOPT_DECODE_IMAGE_DATA ) ; 

        //return($phpWord );
    }

    function getInstancia(){
        return($this->pdf);
    }




      //  $image_count    =  count ( $pdf -> Images ) ;

}
