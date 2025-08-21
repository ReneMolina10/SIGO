<?php

class doc_firmadosModel extends Model
{
    private $_correoUsuario = '';

    public function __construct()
    {
        parent::__construct();

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

    // Documentos que el usuario (correo) ya firmó (estatus = 3)
    public function getDocumentosFirmadosUsuario()
    {
        if (empty($this->_correoUsuario)) {
            return [];
        }

        // Se filtra por firmante con estatus 3 y correo del usuario actual
        // Se hace join por TDOC_DOCUMENTO = TDFI_DOCUMENTO
        $sql = " SELECT  d.*,
                    TO_CHAR(d.TDOC_FECHA_FIRMA,'DD/MON/YYYY - HH:MI AM','NLS_DATE_LANGUAGE=SPANISH') AS TDOC_FECHA_FIRMA_FMT,
                    TO_CHAR(d.TDOC_FECHA,'DD/MON/YYYY - HH:MI AM','NLS_DATE_LANGUAGE=SPANISH')       AS TDOC_FECHA_FMT,
                    f.TDFI_CORREO,
                    f.TDFI_ESTATUS,
                    f.TDFI_NOMBRE,
                    (SELECT COUNT(*) 
                       FROM EFIRMAS.TFIRMANTE fx 
                      WHERE fx.TDFI_DOCUMENTO = d.TDOC_DOCUMENTO 
                        AND fx.TDFI_ESTATUS = 3) AS FIRMANTES_FIRMADOS,
                    (SELECT COUNT(*) 
                       FROM EFIRMAS.TFIRMANTE fx2 
                      WHERE fx2.TDFI_DOCUMENTO = d.TDOC_DOCUMENTO) AS FIRMANTES_TOTAL
            FROM EFIRMAS.TDOCUMENTO d
            INNER JOIN EFIRMAS.TFIRMANTE f ON f.TDFI_DOCUMENTO = d.TDOC_DOCUMENTO
            WHERE f.TDFI_ESTATUS = 3
              AND f.TDFI_CORREO = :correo
            ORDER BY d.TDOC_FECHA_FIRMA DESC NULLS LAST, d.TDOC_FECHA DESC
        ";

        $params = [':correo' => $this->_correoUsuario];

        return $this->ssql($sql, $params);
    }

    public function getFirmantesDeDocumentos(array $docIds)
    {
        if (empty($docIds)) {
            return [];
        }
        // Crear placeholders :d0,:d1,...
        $placeholders = [];
        $params = [];
        foreach ($docIds as $i => $id) {
            $ph = ':d'.$i;
            $placeholders[] = $ph;
            $params[$ph] = (int)$id;
        }

        $sql = "
            SELECT 
                f.TDFI_DOCUMENTO,
                f.TDFI_FIRMANTE,
                f.TDFI_NOMBRE,
                f.TDFI_ESTATUS,
                f.TDFI_CORREO
            FROM EFIRMAS.TFIRMANTE f
            WHERE f.TDFI_DOCUMENTO IN (" . implode(',', $placeholders) . ")
            ORDER BY f.TDFI_DOCUMENTO, f.TDFI_FIRMANTE
        ";
        return $this->ssql($sql, $params);
    }

    // (Opcional) si aún se requiere la lista cruda de firmantes
    
}

?>