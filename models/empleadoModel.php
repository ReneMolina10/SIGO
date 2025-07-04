<?php

class empleadoModel extends Model{

  public function __construct() 
  {
    parent::__construct();

  }

function getFechasTrabajadoresAnio($anio,$trab)
{
    $sql = "SELECT TO_CHAR(CNT_FECHA_INICIO,'DD-MM-YYYY') AS CNT_FECHA_INICIO,
TO_CHAR(CNT_FECHA_FIN,'DD-MM-YYYY') AS CNT_FECHA_FIN
FROM CNT_CONTRATOS 
WHERE CNT_PK_ANIO=$anio AND 
CNT_STATUS IN (1,2) AND 
CNT_FK_NOEMPL = '$trab'";

//echo "$sql ";
$post = $this->_db->query($sql);
        return $post->fetchall();
}

function getTrabajadoresAnio($anio)
{
    $sql = "SELECT CNT_FK_NOEMPL 
FROM CNT_CONTRATOS 
WHERE CNT_PK_ANIO=$anio AND CNT_STATUS IN (1,2) AND CNT_FK_NOEMPL IS NOT NULL -- AND CNT_FK_NOEMPL = '9902577'
GROUP BY CNT_FK_NOEMPL";

// echo "$sql ";
$post = $this->_db->query($sql);
        return $post->fetchall();
}




     public function getEmpleados()
     {

       $empleados = $this->_db->query("
    SELECT VEMP_EMPL AS NOEMPL, VEMP_APEPAT ||' '|| VEMP_APEMAT||', ' ||VEMP_NOMBRE|| ' (' || VEMP_EMPL || ')' AS NOMBRE 
    FROM PVEMPLDOS 
    WHERE VEMP_APEPAT IS NOT NULL AND VEMP_APEPAT!='0'

        "); 

      

       return $empleados->fetchall(); 

  }


     
   }


   ?>
