<?php 
require ('autoload.php');

$pdf = new \setasign\Fpdi\Fpdi();

$files = array(1 => 'CPSC-107-2018.pdf', 2 => 'ejemplo.pdf' );

foreach ($files as $var) {
	$pagecount = $pdf->setSourceFile($var); 

	$cont=0;

	for ($cont = 1; $cont <= $pagecount; $cont++) 
	{
		$tplidx = $pdf->importPage($cont, '/MediaBox'); 
		$pdf->addPage(); 
		$pdf->useTemplate($tplidx); 

		}
}


//, 2 => 'CPSCHE-all-2018.pdf'


$pdf->Output('Ejemplo2.pdf','d');
?>