<?php



class indexModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }





    public function getMinutasporFirmar()
    {
        $sql = "SELECT 
                DM.MIN_PROCESO, 
                DM.MIN_FOLIO, 
                DM.MIN_ID,
                DM.FOLIO_DOC,
                DM.TIPO_DOCUMENTO, 
                UPPER(MD5(CONCAT(DM.MIN_ID, '_minuta'))) AS HASH_MINUTA,
                MF.FIR_ID_SEGUIMIENTO,
                MF.FIR_CORREO
            FROM DOC_MINUTA DM
            INNER JOIN DOC_MIN_FIRMANTES MF ON DM.MIN_ID = MF.FIR_FK_MINUTA
            WHERE DM.STATUS_DOC = '2'";
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFirmantesMinutas($minutaId)
    {
        $sql = "SELECT 
                    FIR_ID_SEGUIMIENTO,FIR_CORREO
                FROM DOC_MIN_FIRMANTES
                WHERE FIR_FK_MINUTA = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$minutaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDocumentosPropiosPendientes()
    {
        $sql = "SELECT 
                    DP_DENOMINACION,
                    DP_FOLIO,
                    DP_FOLIO_DOC, 
                    DP_ID, 
                    DP_TIPO_DOCUMENTO, 
                    UPPER(MD5(CONCAT(DP_ID, '_docpro'))) AS HASH_DOC 
                FROM DOC_PROPIOS 
                WHERE DP_STATUS_DOC = '2'"; // Ajusta el estado según tu lógica
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFirmantesPorDocumentoPropio($docPropioId)
    {
        $sql = "SELECT 
                    DP_ID_SEGUIMIENTO 
                FROM DOC_PRO_FIRMANTES 
                WHERE DP_FK_DOCPROPIO = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$docPropioId]); // Pasar el parámetro directamente
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFirmantesConDocumentosPendientes()
    {
        $sql = "SELECT 
                DP.DP_DENOMINACION,
                DP.DP_FOLIO,
                DP.DP_FOLIO_DOC, 
                DP.DP_ID, 
                DP.DP_TIPO_DOCUMENTO, 
                UPPER(MD5(CONCAT(DP.DP_ID, '_docpro'))) AS HASH_DOC,
                DF.DP_ID_SEGUIMIENTO
            FROM DOC_PROPIOS DP
            INNER JOIN DOC_PRO_FIRMANTES DF ON DP.DP_ID = DF.DP_FK_DOCPROPIO
            WHERE DP.DP_STATUS_DOC = '2'"; // Ajusta el estado según tu lógica
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //*datos de SRH

    public function getdocumentosMinutaSRH()
    {
        $sql = "SELECT
        m.MIN_ID,
        m.MIN_PROCESO,
        m.MIN_FOLIO,
        m.MIN_FECHA,
        m.MIN_HINICIO,
        m.MIN_HFIN,
        m.MIN_LUGAR,
        m.MIN_FK_AREAS_PARTICIPA,
        m.MIN_CADENA,
        m.ID_FK_DOC,
        m.EXTERNALID,
        m.DATE_CREATE,
        m.TIPO_DOC_MINUTA,
        m.FOLIO_DOC,
        m.STATUS_DOC,
        m.DATESIGN,
        UPPER(MD5(CONCAT(m.MIN_ID, '_minuta'))) AS HASH_MINUTA,
        f.FIR_ID,
        f.FIR_NUMEMPL,
        f.FIR_PREFIJOESTUDIOS,
        f.FIR_NOMBRE,
        f.FIR_CURP,
        f.FIR_CORREO,
        f.FIR_CARGO,
        f.FIR_ID_SEGUIMIENTO,
        f.FIR_STATUS_FIRMANTE_DOC,
        f.FIR_DATESIGN,
        f.FIR_SIGNATURE,
        f.FIR_ID_DOC,
        f.FIR_SHA_SIGNATURE
    FROM SISRH.DOC_MINUTA m
    INNER JOIN SISRH.DOC_MIN_FIRMANTES f ON m.MIN_ID = f.FIR_FK_MINUTA";
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>