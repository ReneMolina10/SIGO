<?php

class myPDO
{
    private $resultParse;
    private $sql;
    private $LinkOrc;

    function setLink($LinkOrc)
    {
        $this->LinkOrc = $LinkOrc;
    }

    function execute($array = null)
    {
        try {
            $stid = @oci_parse($this->LinkOrc, $this->sql);

            if (!$stid) {
                $e = @oci_error($this->LinkOrc);
                $this->close();
                return "Error: " . $e['message'] . "<br/> SQL:" . $e['sqltext'];
            }

            if ($array != null) {
                foreach ($array as $clave => $valor) {
                    oci_bind_by_name($stid, $clave, $array[$clave]);
                }
            }

            $ejecuta = @oci_execute($stid);

            if (!$ejecuta) {
                $this->close();
                return "Error: " . $e['message'] . "<br/> SQL:" . $e['sqltext'];
            } else {
                $row = @oci_fetch_array($stid, OCI_ASSOC);
                return $row;
            }

            @oci_free_statement($stid);
            return 1;
        } catch (Exception $e) {
            return "Excepción: " . $e->getMessage();
        }
    }



//,

/* 

                if (!$printError) {
                    $e['execute_status'] = 500;
                    return $e;
                }
*/

function execute2($array = null, $printError = true)
{
    try {
        // Preparar la consulta
        $stid = oci_parse($this->LinkOrc, $this->sql);
        if (!$stid) {
            $error = oci_error($this->LinkOrc);
            echo "Error al preparar la consulta: " . htmlspecialchars($error['message']) . "<br/>";
            echo "SQL: " . htmlspecialchars($error['sqltext']) . "<br/>";
            return false;
        }

        // Vincular parámetros
        if ($array !== null) {
            foreach ($array as $clave => $valor) {
                if (!oci_bind_by_name($stid, $clave, $array[$clave])) {
                    echo "Error al vincular el parámetro: $clave<br/>";
                    return false;
                }
            }
        }

        // Ejecutar la consulta
        $ejecuta = oci_execute($stid);
        if (!$ejecuta) {
            $error = oci_error($stid);
            //echo "Error al ejecutar la consulta: " . htmlspecialchars($error['message']) . "<br/>";
           // echo "SQL: " . htmlspecialchars($error['sqltext']) . "<br/>";

           $this->close();

                if (!$printError) {
                    $e['execute_status'] = 500;
                    return $e;
                }
                

            if ($e['code'] >= 20000 && $e['code'] < 30000) {
                // Imprime solo el mensaje del error si el código está en el rango especificado
                $lines = explode("\n", $e['message']);
                echo "Error: " . $lines[0];
              }else{
                  echo "<pre>";
                  print_r($e);
                  echo "</pre>";

                  echo "<pre>";
                  print_r($array);
                  echo "</pre>";
                }


            return false;
        }

        // Obtener resultados
        $data = [];
        if (oci_num_fields($stid) > 0) {
            while ($row = @oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $data[] = $row;
            }
        } else {
            // Consulta INSERT, UPDATE o DELETE: devolver filas afectadas
           // $data = oci_num_rows($stid); // Devuelve el número de filas afectadas
        }

        // Liberar recursos
        oci_free_statement($stid);

        return $data;
    } catch (Exception $e) {
        echo "Excepción capturada: " . htmlspecialchars($e->getMessage()) . "<br/>";
        return false;
    }
}




/*
    function execute2($array = null)
    {
        try {
            $stid = @oci_parse($this->LinkOrc, $this->sql);

            if (!$stid) {
                $e = @oci_error($this->LinkOrc);
                $this->close();
                return "Error: " . $e['message'] . "<br/> SQL:" . $e['sqltext'];
            }

            if ($array != null) {
                foreach ($array as $clave => $valor) {
                    oci_bind_by_name($stid, $clave, $array[$clave]);
                }
            }

            $ejecuta = @oci_execute($stid);

            if (!$ejecuta) {
                $e = @oci_error($stid);
                $this->close();


               // echo "-  Error: " . $e->getMessage(); 

                
               if ($e['code'] >= 20000 && $e['code'] < 30000) {
                // Imprime solo el mensaje del error si el código está en el rango especificado
                $lines = explode("\n", $e['message']);
                echo "Error: " . $lines[0];
              }else{
                  echo "<pre>";
                  print_r($e);
                  echo "</pre>";

                  echo "<pre>";
                  print_r($array);
                  echo "</pre>";
                }


                exit();
            } else {
                $data = [];
                while ($res = @oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $data[] = $res;
                }
                return $data;
            }

            @oci_free_statement($stid);
            return 1;
        } catch (Exception $e) {
            return "Excepción: " . $e->getMessage();
        }
    }
    
*/



    function setSQL($sql)
    {
        $this->sql = $sql;
    }

    function fetch()
    {
        $row = @oci_fetch_array($this->resultParse, OCI_ASSOC);
        @oci_free_statement($this->resultParse);
        return $row;
    }

    function fetchAll()
    {
        $data = [];
        while ($res = @oci_fetch_array($this->resultParse, OCI_ASSOC)) {
            $data[] = $res;
        }
        @oci_free_statement($this->resultParse);
        return $data;
    }

    function setArray($a)
    {
        $this->resultParse = $a;
    }

    function close()
    {
        @oci_close($this->LinkOrc);
    }
}

class Databaseoci extends myPDO
{
    private $LinkOrc;
    private $objMyPDO;

    public function __construct($host, $dbname, $user, $pass, $char)
    {
        $this->objMyPDO = new MyPDO();

        $tns = "
        (DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = 1521)) )  (CONNECT_DATA =  (SERVER = DEDICATED)  (SERVICE_NAME = $dbname) ) )";

        $db_username = $user;
        $db_password = $pass;

        try {
            $LinkOrc = oci_connect($db_username, $db_password, $tns);
            $this->objMyPDO->setLink($LinkOrc);

            
            if (!$LinkOrc) {
                $e = oci_error(); // Obtiene el error de Oracle
                $error_message = "Error al conectar con la base de datos: $host, $dbname, $user, $char.  Error de Oracle: " . $e['message'];
                throw new ErrorException($error_message);
            }

            $this->LinkOrc = $LinkOrc;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function prepare($sql)
    {
        $this->objMyPDO->setSQL($sql);
        return $this->objMyPDO;
    }

    function del($sql)
    {
        try {
            $resultParse = @oci_parse($this->LinkOrc, $sql);
            $objExecute = oci_execute($resultParse, OCI_DEFAULT);

            if ($objExecute) {
                oci_commit($this->LinkOrc);
            } else {
                oci_rollback($this->LinkOrc);
                $e = oci_error($resultParse);
                echo "Error Delete [" . $e['message'] . "]";
            }
        } catch (Exception $e) {
            echo "Excepción: ", $e->getMessage(), "\n";
        }
    }

    function query($sql)
    {
        try {
            $resultParse = @oci_parse($this->LinkOrc, $sql);

            if (!$resultParse) {
                $this->close();
            }

            $ejecuta = @oci_execute($resultParse, OCI_DEFAULT);

            if (!$ejecuta) {
                $e = @oci_error($resultParse);
                echo "-->" . $e['message'] . ": " . $sql . "<-----";
                $this->close();
            }

            $this->objMyPDO->setArray($resultParse);
            return $this->objMyPDO;
        } catch (Exception $e) {
            echo "Excepción: ", $e->getMessage(), "\n";
        }
    }

    function close()
    {
        @oci_close($this->LinkOrc);
    }
}

?>
