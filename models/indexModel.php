<?php



class indexModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }




    
    public function getMinutasporFirmar() {
    $sql = "SELECT 
                MIN_PROCESO, 
                MIN_FOLIO, 
                MIN_ID,FOLIO_DOC,
                TIPO_DOCUMENTO, 
                UPPER(MD5(CONCAT(MIN_ID, '_minuta'))) AS HASH_MINUTA 
        FROM DOC_MINUTA 
        WHERE STATUS_DOC = '2'";
    $stmt = $this->_db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>