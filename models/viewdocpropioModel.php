<?php

class viewdocpropioModel extends Model
{


    public function getInfoDocPro($id)
    {
        $sql = "SELECT
            DP_ID, -- FILTRAR POR DOCUMENTO PROPIO
            DP_DENOMINACION,
            DP_FOLIO,
            DP_FECHA,
            DP_CADENA_ORIGINAL,
            DP_ID_FK_DOC, -- ID del documento asociado
            DP_EXTERNALID, -- ID externo del documento
            DP_DATE_CREATE, -- Fecha de creación del documento
            DP_FOLIO_DOC, -- Folio del documento UNACAR
            DP_STATUS_DOC, -- Estado del documento UNACAR
            DP_DATESIGN, -- Fecha de firma del documento UNACAR
            DP_TIPO_DOCUMENTO, -- Tipo de documento 
            DP_DESCRIPCION -- Descripción del documento
        FROM DOC_PROPIOS DP
        WHERE MD5(DP_ID||'_docpro') = :id";


        $miarray = array(':id' => $id);
        $postInfoDocPro = $this->ssql($sql, $miarray, 1);


         

        return $postInfoDocPro;

    }

    public function getFirmantes($id)
    {
        $sql = "SELECT
             ID_DP AS ID, 
             DP_NUMEMPL, 
             DP_NOMBRE, 
             DP_PREFIJOESTUDIOS ||' '||DP_NOMBRE AS FIRMANTE, 
             DP_CURP, 
             DP_CORREO, 
             DP_CARGO, 
             DP_FK_DOCPROPIO,
             DP_ID_SEGUIMIENTO,
             DP_SIGNATURE,
             DP_DATESIGN,
             DP_SHA_SIGNATURE,
             DP_STATUS_FIRMANTE_DOC,
             DP_DATESIGN
            FROM DOC_PRO_FIRMANTES
        WHERE MD5(DP_FK_DOCPROPIO||'_docpro')   = :id";

        $miarray = array(':id' => $id);
        $firmantesPDF = $this->ssql($sql, $miarray);
        /*
                echo "<pre>";
                foreach ($firmantes as $index => $firmante) {
                    echo ($index + 1) . ". ";
                    print_r($firmante);
                    echo "\n";
                }
                echo "</pre>";
                exit;
        */
        return $firmantesPDF;
    }


    /*ID_DP
DP_NUMEMPL
DP_PREFIJOESTUDIOS
DP_NOMBRE
DP_CURP
DP_CORREO
DP_CARGO
DP_FK_DOCPROPIO
DP_ID_SEGUIMIENTO
DP_STATUS_FIRMANTE_DOC
DP_DATESIGN
DP_SIGNATURE
DP_ID_DOC
DP_SHA_SIGNATURE */

    //Método para desencriptar valores
        protected function decryptValue(string $ciphertext): string {
            list($iv, $cipher) = explode('::', base64_decode($ciphertext), 2);
            return openssl_decrypt($cipher, 'AES-256-CBC', GENERATOR_TEXT_ENCRYPTION_KEY, 0, $iv);
        }
}

