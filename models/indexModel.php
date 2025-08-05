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
                MF.FIR_ID_SEGUIMIENTO
            FROM DOC_MINUTA DM
            INNER JOIN DOC_MIN_FIRMANTES MF ON DM.MIN_ID = MF.FIR_FK_MINUTA
            WHERE DM.STATUS_DOC = '2'";
        $stmt = $this->_db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFirmantesMinutas($minutaId){
        $sql = "SELECT 
                    FIR_ID_SEGUIMIENTO 
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
}
?>