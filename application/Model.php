<?php

class Model
{
    private $_registry;
    protected $_db;
    private $LinkOrc;
    private $resultParse;
    private $_origen;

    public function __construct($origen = 'local')
    {
        $this->_registry = Registry::getInstancia();
        $this->_db = $this->_registry->_db[$origen]; // <--- MULTI_BD
        $this->_origen = $origen;
    }

    function setOrigen($origen)
    {
        $this->_db = $this->_registry->_db[$origen]; // <--- MULTI_BD
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

public function ssql($sql, $array = [], $fila = 2)
{
    try {
        if (DB[$this->_origen]['MANAGER'] == "oracle") {
            // Preparar y ejecutar para Oracle
            $rows = $this->_db->prepare($sql)->execute2($array);

            if ($fila == 1 && count($rows) > 0) {
                return $rows[0]; // Retorna una sola fila
            } elseif ($fila == 2 && count($rows) > 0) {
                return $rows; // Retorna todas las filas
            }

            return true; // Consulta sin resultados relevantes
        } else {
            // Preparar y ejecutar para otros gestores (PDO)
            $consulta = $this->_db->prepare($sql);
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $consulta->execute($array);

            if ($consulta->errorCode() !== "00000") {
                // Manejo de errores específicos de PDO
                $errorInfo = $consulta->errorInfo();
                throw new PDOException($errorInfo[2] ?? "Error desconocido");
            }

            if ($fila == 1) {
                $row = $consulta->fetch();
                return $row ?: true; // Retorna la fila o `true` si no hay resultados
            } elseif ($fila == 2) {
                $rows = $consulta->fetchAll();
                return $rows ?: true; // Retorna todas las filas o `true` si no hay resultados
            }

            return true; // Consulta sin resultados relevantes
        }
    } catch (PDOException $e) {
        // Manejo unificado de errores
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'sql' => $sql
        ];
    } catch (Exception $e) {
        // Manejo de excepciones generales
        return [
            'error' => true,
            'message' => $e->getMessage(),
            'sql' => $sql
        ];
    }
}



    /*
    public function ssql($sql, $array = array(), $fila = 2)
    {


        if (DB[$this->_origen]['MANAGER'] == "oracle") {

            try {
                $rows = $this->_db->prepare($sql)->execute2($array);


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

    */

    public function getLimitSQL($num = 1)
    {
        $num = (int)$num;
        if (DB['local']['MANAGER'] == "oracle")
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