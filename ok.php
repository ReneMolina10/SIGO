<?php 

define('GENERATOR_SECRET', 'mi_clave_secreta'); // tu palabra clave
define('GENERATOR_IV', '1234567890123456'); // 16 bytes fijos para AES-256-CBC


$texto = "Hola desde PHP!";
$cifrado = encryptValue($texto); // => por ejemplo: "aSNPQ2WZT9nSnq=="

echo $cifrado;
echo "<br/>";
echo decryptValue($cifrado); // "Hola desde PHP!"



  



function encryptValue(string $plaintext): string {
    $key = hash('sha256', GENERATOR_SECRET, true); // 32 bytes
    $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, GENERATOR_IV);
    return base64_encode($ciphertext);
}

function decryptValue(string $encrypted): string {
    $key = hash('sha256', GENERATOR_SECRET, true); // misma clave
    $ciphertext = base64_decode($encrypted);
    return openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, GENERATOR_IV);
}




exit();

?>



<meta charset="UTF-8">
<?php
header('Content-Type: text/html; charset=UTF-8');
$host  = '172.16.2.195'; // ^ <-- LOCAL
$user   = 'sau';
$pass    = 'sau19c';
$dbname    = 'uqro';
$db['local']['CHAR']    = 'utf8'; 



$tns = "  
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = $dbname)
    )
  )";


$db_username = $user;
$db_password = $pass;
putenv('NLS_LANG=AMERICAN_AMERICA.AL32UTF8'); 

// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"
$conn = oci_connect($db_username,$db_password,$tns);

oci_set_client_identifier($conn, 'UTF-8');

//mb_internal_encoding("UTF-8");


if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT SOL_DENOMINACION FROM SAU_SOLICITUDES where SOL_ID = 13003');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? ($item) : "") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

?>





<?php

// Show all information, defaults to INFO_ALL
//phpinfo();

echo "área ";
// Show just the module information.
// phpinfo(8) yields identical results.
// phpinfo(INFO_MODULES);

print_r($_ENV );

exit();
?>

<html>
    <head>
        <script>
                function noatras(){
                    window.location.hash="no-back-button";
                    window.location.hash="Again-No-back-button"
                    window.onhashchange=function(){
                        window.location.hash="no-back-button";
                        alert("Nooo");
                    }
                }

        </script>
    </head>
    <body onload="noatras();">
        
    Hola

    </body>
</html>

