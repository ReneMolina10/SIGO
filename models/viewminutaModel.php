<?php

class viewminutaModel extends Model
{



    public function getInfoGeneral($id)
    {

        $sql = "SELECT
            MD5(MIN_ID||'_minuta'), -- FILTRAR POR MINUTA
            MIN_PROCESO,
            TIPO_DOCUMENTO,
            MIN_FOLIO,
            MIN_FECHA,
            MIN_HINICIO,
            MIN_HFIN,
            MIN_LUGAR,
            FOLIO_DOC,
            TH.LURES AS MIN_FK_AREAS_PARTICIPA,
            RUTA_PDF_MINUTA,
            METADATOS_DOC,
            BINARIO_DOC,
            TIPO_DOCUMENTO,
            MIN_CADENA AS CADENA_ORIGINAL_SHA_256
        FROM DOC_MINUTA DM
        LEFT JOIN TURESH TH ON TH.URES = DM.MIN_FK_AREAS_PARTICIPA
        WHERE MD5(MIN_ID||'_minuta') = :id";


        $miarray = array(':id' => $id);
        $infoGen = $this->ssql($sql, $miarray, 1);


        /* print_r($infoGen);
         exit;*/

        return $infoGen;

    }

    public function getAsuntos($id)
    {

        $S_key = base64_encode(GENERATOR_TEXT_ENCRYPTION_KEY);


        $sql = "SELECT
            ASU_ID,
            ASU_FK_MINUTA, --FILTRAR POR MINUTA
            ASU_TEMA,
            LURES AS ASU_PRESENTA,
            MY_DECRYPT(ASU_RESUMEN, '$S_key') as  ASU_RESUMEN
        FROM DOC_MIN_ASUNTO
        LEFT JOIN TURESH ON URES = ASU_PRESENTA
        WHERE MD5(ASU_FK_MINUTA||'_minuta')  = :id";

        $miarray = array(':id' => $id);
        $asuntos = $this->ssql($sql, $miarray);

        //desencriptado de ASU_RESUMEN
        /* foreach ($asuntos as &$asunto) {
             if (!empty($asunto['ASU_RESUMEN'])) {
                 $asunto['ASU_RESUMEN'] = $this->decryptValue($asunto['ASU_RESUMEN']);
             }
         }*/

        /* print_r($asuntos);
         exit;*/

        return $asuntos;
    }

    public function getAreasParticipa($id)
    {
        $sql = "SELECT
            ID_URE_PAR AS ID,
           ID_URE_PAR,
            ID_URE_PAR || ' - ' || LURES AS AREA_PARTICIPA
        FROM DOC_FIR_AREAS_PARTICIPA
        LEFT JOIN TURESH ON URES = ID_URE_PAR
        WHERE MD5(ID_FK_MINUTA||'_minuta')  = :id";

        $miarray = array(':id' => $id);
        $areasParticipa = $this->ssql($sql, $miarray);

        /* print_r($areasParticipa);
         exit;*/

        return $areasParticipa;
    }


    public function getAcuerdos($id)
    {
        $S_key = base64_encode(GENERATOR_TEXT_ENCRYPTION_KEY);


        $sql = "SELECT
            ACU_ID,
             MY_DECRYPT(ACU_DESCRIPCION, '$S_key') as ACU_DESCRIPCION,
            ACU_RESPONSABLE AS RESPONSABLE_ID,
            TH.LURES AS ACU_RESPONSABLE,
            ACU_FECHA_FIN,
            ACU_FK_ASUNTO, -- FILTRAR POR ASUNTO
            ACU_FK_MINUTA -- FILTRAR POR MINUTA
        FROM DOC_MIN_ACUERDOS DM
        LEFT JOIN TURESH TH ON TH.URES = DM.ACU_RESPONSABLE
        WHERE MD5(ACU_FK_MINUTA||'_minuta')  = :id";

        $miarray = array(':id' => $id);
        $acuerdos = $this->ssql($sql, $miarray);


        //desencriptado de ACU_DESCRIPCION

        /* foreach ($acuerdos as &$acuerdo) {
             if (!empty($acuerdo['ACU_DESCRIPCION'])) {
                 $acuerdo['ACU_DESCRIPCION'] = $this->decryptValue($acuerdo['ACU_DESCRIPCION']);
             }
         }*/



        /* print_r($acuerdos);
         exit;*/

        return $acuerdos;
    }


    public function getMejoras($id)
    {
        $S_key = base64_encode(GENERATOR_TEXT_ENCRYPTION_KEY);

        $sql = "SELECT
            MEJ_ID AS ID,
            MEJ_TIPO,
            MY_DECRYPT(MEJ_DESCRIPCION, '$S_key') as MEJ_DESCRIPCION,
            MEJ_FK_MINUTA
        FROM DOC_MIN_MEJORAS
        WHERE MD5(MEJ_FK_MINUTA||'_minuta') = :id";

        $miarray = array(':id' => $id);
        $mejoras = $this->ssql($sql, $miarray);

        //desencriptado de MEJ_DESCRIPCION
        /*foreach ($mejoras as &$mejora) {
            if (!empty($mejora['MEJ_DESCRIPCION'])) {
                $mejora['MEJ_DESCRIPCION'] = $this->decryptValue($mejora['MEJ_DESCRIPCION']);
            }
        }*/

        /* print_r($mejoras);
         exit;*/

        return $mejoras;
    }

    public function getFirmantes($id)
    {
        $sql = "SELECT
             FIR_ID AS ID, 
             FIR_NUMEMPL, 
             --FIR_PREFIJOESTUDIOS
             
             FIR_NOMBRE, 
             FIR_PREFIJOESTUDIOS ||' '||FIR_NOMBRE AS FIRMANTE, 
             FIR_CURP, 
             FIR_CORREO, 
             FIR_CARGO, 
             FIR_FK_MINUTA,
             FIR_ID_SEGUIMIENTO,
             FIR_SIGNATURE,
             FIR_DATESIGN,
             FIR_SHA_SIGNATURE,
             FIR_STATUS_FIRMANTE_DOC,
             
         FIR_DATESIGN
            FROM DOC_MIN_FIRMANTES
        WHERE MD5(FIR_FK_MINUTA||'_minuta')   = :id";

        $miarray = array(':id' => $id);
        $firmantes = $this->ssql($sql, $miarray);
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
        return $firmantes;
    }



    /* protected function decryptValue(string $ciphertext): string
     {
         list($iv, $cipher) = explode('::', base64_decode($ciphertext), 2);
         return openssl_decrypt($cipher, 'AES-256-CBC', GENERATOR_TEXT_ENCRYPTION_KEY, 0, $iv);
     }*/
}

