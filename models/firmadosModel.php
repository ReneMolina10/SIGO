<?php

class firmadosModel extends Model
{
    private $_correoUsuario;

    public function __construct()
    {
        parent::__construct();

        $correoUsuario = '';
        if (!empty($_SESSION['infousr']['email'])) {
            $this->_correoUsuario = $_SESSION['infousr']['email'];
        } elseif (!empty($_SESSION['getOffice']['nickname'])) {
            $this->_correoUsuario = $_SESSION['getOffice']['nickname'];
        }

        /*
    echo "<pre>";
            print_r($this->_correoUsuario);
            echo "</pre>";
            exit; */

    }

    public function minutasfirmadas()
    {

        $sql = "SELECT 
                    F.*, 
                    DM.*, 
                    MD5(CONCAT(DM.MIN_ID, '_minuta')) AS hash_minuta,
                    (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES WHERE FIR_FK_MINUTA = DM.MIN_ID) AS TOTAL_FIRMAS,
                    (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES WHERE FIR_FK_MINUTA = DM.MIN_ID AND FIR_STATUS_FIRMANTE_DOC = 3) AS FIRMAS_HECHAS
                FROM DOC_MIN_FIRMANTES F
                LEFT JOIN DOC_MINUTA DM
                       ON DM.MIN_ID = F.FIR_FK_MINUTA
                WHERE F.FIR_CORREO = :correo_creador
                AND FIR_STATUS_FIRMANTE_DOC = 3
                ORDER BY DM.MIN_ID DESC";


        $params = [':correo_creador' => $this->_correoUsuario];
        $minutasFirmadas = $this->ssql($sql, $params);

        return $minutasFirmadas;
    }

    public function getFirmantesPendientes($id_minuta)
    {
        $sql = "SELECT FIR_NOMBRE, FIR_STATUS_FIRMANTE_DOC 
                FROM DOC_MIN_FIRMANTES 
                WHERE FIR_FK_MINUTA = :id_minuta
                ORDER BY FIR_NOMBRE ASC";

        $params = [':id_minuta' => $id_minuta];
        return $this->ssql($sql, $params);
    }

}