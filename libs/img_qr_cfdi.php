<?php 

 include('phpqrcode/qrlib.php'); 
         
    $id = $_GET['id']; // remember to sanitize that - it is user input! 
    $re = $_GET['re'];
    $rr = $_GET['rr'];
    $tt = $_GET['tt'];
    $fe = $_GET['fe'];
     
    // we need to be sure ours script does not output anything!!! 
    // otherwise it will break up PNG binary! 
     
    ob_start("callback"); 
     
    // here DB request or some processing 
    $codeText = "https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?id=".$id."&re=".$re."&rr=".$rr."&tt=".$tt."&fe=".$fe;
     
    // end of processing here 
    $debugLog = ob_get_contents(); 
    ob_end_clean(); 
     
    // outputs image directly into browser, as PNG stream 
    QRcode::png($codeText);

    ?>