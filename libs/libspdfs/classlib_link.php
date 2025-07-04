<?php
use setasign\Fpdi\Fpdi;
require ('vendor_editpdf/autoload.php');

class editpdf extends Fpdi
{
    public $files = array();

    public function setFiles($files)
    {
        $this->files = $files;
    }

    public function concat()
    {
        foreach($this->files AS $file) {
            $pageCount = $this->setSourceFile($file);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pageId = $this->ImportPage($pageNo);
                $s = $this->getTemplatesize($pageId);
                $this->AddPage($s['orientation'], $s);
                $this->useImportedPage($pageId);
            }
        }
    }

    public function extraerPagina($pagInicio, $pagFin,$origen,$destino){

        try{  

        $pagecount = $this->setSourceFile($origen); 

        $cont=0;

        for ($cont = $pagInicio; $cont <= $pagFin; $cont++) 
        {

            $templateId = $this->importPage($cont, '/MediaBox');
            $size = $this->getTemplateSize($templateId);
                        
            if ($size['width'] > $size['height']) {
                $this->AddPage('L', array($size['width'], $size['height']));
            } else {
                $this->AddPage('P', array($size['width'], $size['height']));
            }
                        
                $this->useTemplate($templateId,0,0,$size['width'],$size['height'],true);

        }
        $this->SetCompression(true);
        $this->Output($destino,'F');

            return("Ok");
            
        } catch (Exception $e) {
            return("Error".$e);
        }

    }

        public function elminaPagina($pagInicio, $pagFin,$origen){

        try{  

            $pagecount = $this->setSourceFile($origen); 

            $cont=0;

            for ($cont = 1; $cont <= $pagecount; $cont++) 
            {
                if( ($cont<$pagInicio and $cont<$pagFin) or ($cont>$pagInicio and $cont>$pagFin)  ){

                        $templateId = $this->importPage($cont, '/MediaBox');
                        $size = $this->getTemplateSize($templateId);
                        
                        if ($size['width'] > $size['height']) {
                            $this->AddPage('L', array($size['width'], $size['height']));
                        } else {
                            $this->AddPage('P', array($size['width'], $size['height']));
                        }
                        
                        $this->useTemplate($templateId,0,0,$size['width'],$size['height'],true);
                }

            }
            $this->SetCompression(true);
            $this->Output($origen,'F');

            return("Ok");
            
        } catch (Exception $e) {
            return($e);
        }

    }

    public function x(){
        echo "X";
    }

}


$pdf = new editpdf();

//$pdf->elminaPagina(1, 2,"C:\laragon\www\pdf\O00.pdf");

//$pdf->elminaPagina(1, 2,"C:\laragon\www\pdf\O00.pdf");
$x=2;
for ($c=2;   $c <=208 ; $c++) { 
    $pdf->extraerPagina($x, $x,"C:\laragon\www\pdf\O00.pdf",'C:\laragon\www\pdf'.'\\'.$x.".pdf");
    $x++;
    echo "Ok $x";
}

