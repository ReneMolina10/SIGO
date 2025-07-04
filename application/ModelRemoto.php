<?php

class ModelRemoto
{
    private $_registry;
    protected $_db;
    private $LinkOrc;
    private $resultParse;

    public function __construct()
    {
        $this->_registry = RegistryRemoto::getInstancia();
        $this->_db = $this->_registry->_db;
    }

    function close()
    {
        @oci_close($this->LinkOrc);
    }

    function setArray($a)
    {
        $this->resultParse = $a;
    }

    public function val($valor)
    {
        if ($valor == "php:hora") {
            return (date("H:i:s"));
        } elseif ($valor == "php:fecha") {
            return (date("Y-m-d"));
        } elseif ($valor == "php:ip") {
            return ($_SERVER["REMOTE_ADDR"]);
        } else {
            return ($valor);
        }
    }


    public function sql($sql, $fila = 1)
    {

        try {
            $res = $this->_db->query($sql);

            if ($res) {
                $x = $res->setFetchMode(PDO::FETCH_ASSOC);
                if ($fila == 1)
                    $row = $res->fetch();
                else
                    $row = $res->fetchAll();

                return ($row);
            } else {
                throw new PDOException("Error en consulta");
            }


        } catch (PDOException $e) {
            echo " [$sql] " . $e->getMessage() . " <br/>";
            return $e->getMessage();
        }

    }

    public function ssql($sql, $array = array(), $fila = 2)
    {

        if (DB_MANAGER == "oracle") {

            try {
                $rows = $this->_db->prepare($sql)->execute2($array);


                //if(! (isset($rows["error"] ) ))
                //{
                if ($fila == 1 and count($rows) >= 0)
                    return ($rows[0]);
                else if ($fila == 2 and count($rows) >= 0)
                    return ($rows);
                else
                    return (true);
                //}
            } catch (PDOException $e) {
                echo " [$sql] " . $e->getMessage() . " <br/>";
                return $e->getMessage();
            }
        } else {
            try {
                $consulta = $this->_db->prepare($sql);
                $x = $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $res = $consulta->execute($array);

                $a = $consulta->errorInfo();


//echo "**** SQL: $sql |".$consulta->errorCode()."**** <br/>";


                /*

                       echo "<pre>";
                      print_r($a);
                      echo "</pre>";
                      */

                if ($consulta->errorCode() != 0 or $consulta->errorCode() == 'HY000') {
                    $a = $consulta->errorInfo();
                    throw new PDOException($a["2"]);
                } else {
                    if ($fila == 1 and $row = $consulta->fetch()) {
                        return ($row);
                    } else if ($fila == 2 and $rows = $consulta->fetchAll()) {
                        return ($rows);
                    } else {
                        return (true);
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage() . " [$sql] <br/>";
                return $e->getMessage();
            }
        }
    }

    public function getLimitSQL($num = 1)
    {
        $num = (int)$num;
        if (DB_MANAGER == "oracle")
            $limit = " AND ROWNUM <= " . $num; //Si la consulta no tiene la condición WHERE hay que poner “WHERE 1 = 1”
        else
            $limit = " LIMIT " . $num;

        return $limit;
    }
    /*public function secureSelectSQL($sql, $array=array(), $fila=2)
    {


    	try {
	    	$consulta = $this->_db->prepare($sql); 
			$consulta->execute($array);

			$x = $consulta->setFetchMode(PDO::FETCH_ASSOC);


			if ($consulta->errorCode() != 0) {
			           $a = $consulta->errorInfo();
			           throw new PDOException($a["2"]);
			}else{
				if($fila==1)
					return($consulta->fetch());
				else
					return($consulta->fetchAll());
			}


		} catch (PDOException $e) {
			echo "excepción:".$e->getMessage()." <br/>";
            return $e->getMessage();        
        }
    }*/

    /*function query($sql){
      try{
          $resultParse=@oci_parse($this->LinkOrc,$sql);

          if (!$resultParse) {
            $this->close();
          }

          $ejecuta=@oci_execute ($resultParse,OCI_DEFAULT);

          if (!$ejecuta) {
              $e = @oci_error($resultParse);
              //echo "-->".$e['message'].": ".$sql."<--";

              $this->close();
          }
          //$this->objMyPDO->setArray($resultParse);

          return($resultParse);
      } catch (Exception $e) {
        	echo 'Excepción: ',  $e->getMessage(), "\n";
        	oci_close($this->LinkOrc);
      }  
    }*/
}

?>