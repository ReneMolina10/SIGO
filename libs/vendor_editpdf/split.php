
<?php 
require ('autoload.php');

$pdf = new \setasign\Fpdi\Fpdi();

$pagecount = $pdf->setSourceFile('ejemplo.pdf'); 

$cont=0;

for ($cont = 1; $cont <= $pagecount; $cont++) 
{


$tplidx = $pdf->importPage($cont, '/MediaBox'); 
$pdf->addPage(); 
$pdf->useTemplate($tplidx); 

//print_r($cont);


}

$pdf->Output('Ejemplo.pdf','d');
?>