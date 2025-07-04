<?php


class aclModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function guardar_seccion_rol($post)
    {
        $idRole = $post["idrole"];
        $role = $this->_db->query("DELETE FROM secciones_role_edicion WHERE fk_id_role = {$idRole}");
        $role = $this->_db->query("DELETE FROM secciones_role_prev WHERE fk_id_role = {$idRole}");
        if(isset($post["secceditar"])){
            foreach($post["secceditar"] AS $i){

                $pag = $this->_db->prepare("INSERT INTO secciones_role_edicion VALUES(:idrole,:idseccion)");
                 $res = $pag->execute(
                            array(
                               ':idrole' =>$idRole,
                               ':idseccion' => $i
                            ));
            }
        }
        if(isset($post["seccvisualiza"])){
            foreach($post["seccvisualiza"] AS $i){

                $pag = $this->_db->prepare("INSERT INTO secciones_role_prev VALUES(:idrole,:idseccion)");
                 $res = $pag->execute(
                            array(
                               ':idrole' =>$idRole,
                               ':idseccion' => $i
                            ));
            }
        }

	}
    public function getRole($roleID)
    {
        $roleID = (int) $roleID;
        
        $role = $this->_db->query("SELECT * FROM ".PREFIJO_TABLAS."roles WHERE id_role = {$roleID}");
        $res = $role->fetch();
        $res = array_change_key_case($res, CASE_LOWER ); //convierte a minusculas 
        return $res;
    }
    public function getSeccionesRoleEdicion($roleID){
	
	    $roleID = (int) $roleID;
        $role = $this->_db->query("SELECT fk_id_seccion FROM secciones_role_edicion WHERE fk_id_role = {$roleID}");


        
        return $role->fetchAll();
	
	}
	public function getSeccionesRoleVisualiza($roleID){
	
	    $roleID = (int) $roleID;
        
        $role = $this->_db->query("SELECT fk_id_seccion FROM secciones_role_prev WHERE fk_id_role = {$roleID}");
        return $role->fetchAll();
	
	}
    public function getRoles()
    {
        $roles = $this->_db->query("SELECT * FROM ".PREFIJO_TABLAS."roles");
        
        return $roles->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSecciones()
    {
        $roles = $this->_db->query("SELECT * FROM secciones");
        
        return $roles->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSeccionesAsOptions($rowSelected)
    {
        $roles = $this->_db->query("SELECT * FROM secciones");

        $res =  $roles->fetchAll();
        $c="";
		/*
		echo "<pre style='margin:50px;'>";
		print_r($rowSelected);
		echo "</pre>";
        */
		
		
        foreach($res AS $i){
			$sel = "";

			if(!empty($rowSelected)){


				if ($this->in_array_r($i["id"], $rowSelected)) {
					$sel = 'selected="selected"';
				}


			}


		
           $c .= "<option ".$sel." value=\"".$i["id"]."\">".$i["denominacion"]."</option>";
        }
        return($c);
    }



public function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
    
    public function getPermisosRole($roleID)
    {
        $data = array();
        
        $permisos = $this->_db->query(
        "SELECT * FROM ".PREFIJO_TABLAS."permisos_role WHERE role = {$roleID}"
        );
                
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);

        $permisos = array_map(array($this, 'convierteArrayIndicesMinusculas'), $permisos);       
        
        for($i = 0; $i < count($permisos); $i++){
            $key = $this->getPermisoKey($permisos[$i]['permiso']);
            
            if($key == ''){continue;}
            if($permisos[$i]['valor'] == 1){
                $v = true;
            }
            else{
                $v = false;
            }
            $data[$key] = array(
                'key' => $key,
                'valor' => $v,
                'nombre' => $this->getPermisoNombre($permisos[$i]['permiso']),
                'id' => $permisos[$i]['permiso']
            );
        }
        
        $todos = $this->getPermisosAll();
        $data = array_merge($todos, $data);
        
        
        return $data;
    }
    
    public function getPermisoKey($permisoID)
    {
        $permisoID = (int) $permisoID;
        
        $key = $this->_db->query(
                "SELECT key  as \"key\" FROM ".PREFIJO_TABLAS."permisos WHERE id_permiso = $permisoID"
                );
        
        $key = $key->fetch();
        return $key['key'];
    }
    
    public function getPermisoNombre($permisoID)
    {
        $permisoID = (int) $permisoID;
        
        $key = $this->_db->query(
                "SELECT permiso as \"permiso\" FROM ".PREFIJO_TABLAS."permisos WHERE id_permiso = $permisoID"
                );
        
        $key = $key->fetch();
        return $key['permiso'];
    }
    
    public function getPermisosAll()
    {
        $permisos = $this->_db->query(
            "SELECT * FROM ".PREFIJO_TABLAS."permisos"
        );
                
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        $permisos = array_map(array($this, 'convierteArrayIndicesMinusculas'), $permisos);
        
        for($i = 0; $i < count($permisos); $i++){
            $data[$permisos[$i]['key']] = array(
                'key' => $permisos[$i]['key'],
                'valor' => 'x',
                'nombre' => $permisos[$i]['permiso'],
                'id' => $permisos[$i]['id_permiso']
            );
        }

        return $data;
    }
    public function eliminar_seccion($post){

              try{
                         $pag = $this->_db->prepare("DELETE FROM secciones WHERE id=:id LIMIT 1");
			 $res = $pag->execute(
						array(

						   ':id' => $post["id"]
						   
						   
						));
					if (!$pag) {
						echo "no:".$pag->errorCode(); print_r($pag->errorInfo());
					}else{
						echo $post["id"];
					}
				}catch( PDOException $Exception ) {
					echo $Exception->getMessage( );
					throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
				}


    }
    public function insertarRole($role)
    {
        $this->_db->query("INSERT INTO ".PREFIJO_TABLAS."roles VALUES(null, '{$role}')");
    }
    public function nexIdSeccion(){
		$paginas = $this->_db->query("SELECT max(id) AS id FROM secciones LIMIT 1");
		$row = $paginas->fetch();
		$id = $row["id"] + 1;
                 return $id;
		
	}
    public function putSeccion($post){

           if(!isset($post["pag_rama"])){ $post["pag_rama"]=0; }

        if($post["idseccion"]!=0 and $post["idseccion"]!="" ){


                   try {
			$pag = $this->_db->prepare("UPDATE secciones SET denominacion=:denominacion, descripcion=:descripcion, idpagina=:idpagina, pag_rama=:pag_rama, pathdir=:pathdir WHERE id=:id LIMIT 1");
			 $res = $pag->execute(
						array(
						   ':denominacion' => $post["denominacion"],
						   ':descripcion' => $post["descripcion"],
						   ':idpagina' => $post["idpagina"],
						   ':pag_rama' => $post["pag_rama"],
						   ':pathdir' => $post["pathdir"],
						   ':id' => $post["idseccion"]
						   
						   
						));
					if (!$pag) {
						echo "no:".$pag->errorCode(); print_r($pag->errorInfo());
					}else{
						echo $post["idseccion"];
					}
				}catch( PDOException $Exception ) {
					echo $Exception->getMessage( );
					throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
				}	
          
        }else{
                        try {
                        $idSeccion = $this->nexIdSeccion();

			$pag = $this->_db->prepare("INSERT INTO secciones VALUES(:id,:denominacion,:descripcion, :idpagina, :pag_rama,:pathdir,0)");
			 $res = $pag->execute(
						array(
						   ':denominacion' => $post["denominacion"],
						   ':descripcion' => $post["descripcion"],
						   ':idpagina' => $post["idpagina"],
						   ':pag_rama' => $post["pag_rama"],
						   ':pathdir' => $post["pathdir"],
						   
						   ':id' => $idSeccion
						));
					if (!$pag) {
						echo "no:".$pag->errorCode(); print_r($pag->errorInfo());
					}else{
						echo $idSeccion;
					}
				}catch( PDOException $Exception ) {
					echo $Exception->getMessage( );
					throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
				}

        }


    }
    
    public function getPermisos()
    {
        $permisos = $this->_db->query("SELECT * FROM ".PREFIJO_TABLAS."permisos");
        
        return $permisos->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function eliminarPermisoRole($roleID, $permisoID)
    {
        $sql = "DELETE FROM ".PREFIJO_TABLAS."permisos_role " . 
                "WHERE permiso = {$permisoID} " .
                "AND role = {$roleID}";
        $res = $this->ssql($sql,NULL, null);
    }

    public function editarPermisoRole($roleID, $permisoID, $valor)
    {
        //no funciona en oracle sql
        /*$this->_db->query(
            "replace into ".PREFIJO_TABLAS."permisos_role set role = {$roleID}, permiso = {$permisoID}, valor = '{$valor}'"
        );*/

        if($this->existePermisoRole($roleID,$permisoID))
        {       
            $limit = $this->getLimitSQL();
            $sql = "UPDATE ".PREFIJO_TABLAS."permisos_role SET valor = :valor WHERE role = :roleID AND permiso = :permisoID " . $limit;
            $array = array(     
                            ':roleID' => $roleID,
                            ':permisoID' => $permisoID,
                            ':valor' => $valor,                        
                        );
            $respuesta = $this->ssql($sql,$array);
        }
        else
        {            
            $sql = "INSERT INTO ".PREFIJO_TABLAS."permisos_role (role, permiso, valor) VALUES (:roleID, :permisoID, :valor)";
            $array = array(
                            ':roleID' => $roleID,
                            ':permisoID' => $permisoID,
                            ':valor' => $valor,                                                  
                        );
            $respuesta = $this->ssql($sql,$array);
        }
    }

    public function existePermisoRole($roleID,$permisoID){
        $limit = $this->getLimitSQL();

        $id = $this->_db->query("SELECT * FROM ".PREFIJO_TABLAS."permisos_role WHERE permiso = $permisoID AND role = $roleID" . $limit);
        
        $row = $id->fetch();
        if($row)
            return(true);
        else 
            return(false);  
    }

    public function insertarPermiso($permiso, $llave)
    {
        $this->_db->query(
                "INSERT INTO ".PREFIJO_TABLAS."permisos VALUES" .
                "(null, '{$permiso}', '{$llave}')"
                );
    }

   function getListPadres($idIdioma, $idPaginaSelec){	
		$idPaginaSelec = (int) $idPaginaSelec;	
		if($idPaginaSelec==0)
			$idPaginaSelec = 1;
		
		$paginas= $this->_db->prepare("
            SELECT dominio, paginas.id AS id,nombre,URI 
            FROM paginas
            LEFT JOIN sitios
            ON paginas.fk_id_sitio = sitios.id
            WHERE fk_id_idioma = $idIdioma ORDER BY dominio,URI");
		$paginas->execute();
		$row = $paginas->fetchAll();
		$cadena="";
		foreach($row as $i) { 
			if($i["id"]==$idPaginaSelec){
				$cadena=$cadena."<option selected='selected' value='".$i["id"]."'>"
			        .$i["dominio"].$i["URI"]." (".$i["nombre"].")</option>";
			}else{
				$cadena=$cadena."<option value='".$i["id"]."'>"
			        .$i["dominio"].$i["URI"]." (".$i["nombre"].") </option>";
			}
		}		
		//$cadena = "<option value='0'>0. NINGUNO</option>" . $cadena;
		return($cadena);
   }
   function getInfoSeccion($id=0){

       $paginas= $this->_db->prepare("SELECT * FROM secciones WHERE id = $id LIMIT 1");
       $paginas->execute();
       $row = $paginas->fetch();
       return($row);
   }


public function DeleteRole($post)
    {
		try 
		{
			$menu = $this->_db->prepare("DELETE FROM ".PREFIJO_TABLAS."roles WHERE id_role = :id");
			$res = $menu->execute(array(
				':id' => $post["id"],
			));
			if($menu->errorCode() == 0) 
			{
				echo $post["id"];
			} else {
				$errors = $menu->errorInfo();
				echo($errors[2]);
			}
		}
		catch( PDOException $Exception ) 
		{
			echo $Exception->getMessage( );
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}	
    }

    //Función que recibe un array y convierte los indices en minusculas 
    public function convierteArrayIndicesMinusculas($array = ""){
        $res = array_change_key_case($array, CASE_LOWER ); //convierte a minusculas        
        return $res;
    }

    public function getPermisosGenerators()
    {
        $permisosGenerators = $this->_db->query("SELECT * FROM permisos_generator");                
        $permisosGenerators = $permisosGenerators->fetchAll(PDO::FETCH_ASSOC);
        $permisos = array_map(array($this, 'convierteArrayIndicesMinusculas'), $permisosGenerators); 
        return $permisos;
    }

    public function getPermisosGeneratorRole($roleID)
    {
        $lista_generators = $this->getListaGenerators();
        $permisosGenerators = $this->getPermisosGenerators();

        $data = array();
        
        foreach ($lista_generators as $generators) {
            foreach ($permisosGenerators as $permiso) {
                $id_permiso = $permiso['id_permiso'];
                $limit = $this->getLimitSQL();
                $permisos = $this->_db->query("SELECT * FROM ".PREFIJO_TABLAS."permisos_generator_role WHERE role = {$roleID} AND generator = '{$generators}' AND permiso = {$id_permiso} ".$limit);                
                $row = $permisos->fetch();
                if($row)
                    $valor = 1;
                else 
                    $valor = 0;
                $data[$generators][$id_permiso] = $valor;
            }
        }
        //print_r($data);
        return $data;
    }

    public function getListaGenerators()
    {
        $directorio = 'generators';
        $lista_generators  = scandir($directorio);
        $nombres_generators = array();
        foreach ($lista_generators as $nom_archivo) {
            $pos = strpos($nom_archivo, 'Generator.php');
            if ($pos !== false) {
                $nombres_generators[] = substr($nom_archivo, 0, $pos );
            } else {
                    //no es un archivo generator valido 
            }
            
        }
        natcasesort($nombres_generators); //Hago un ordenamiento (insensible a maý-mín) de los nombres 
        return $nombres_generators;
    }

}


/*
class aclModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getRole($roleID)
    {
        $roleID = (int) $roleID;
        
        $role = $this->_db->query("SELECT * FROM roles WHERE id_role = {$roleID}");
        return $role->fetch();
    }
    
    public function getRoles()
    {
        $roles = $this->_db->query("SELECT * FROM roles");
        
        return $roles->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPermisosRole($roleID)
    {
        $data = array();
        
        $permisos = $this->_db->query(
                "SELECT * FROM permisos_role WHERE role = {$roleID}"
                );
                
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        
        for($i = 0; $i < count($permisos); $i++){
            $key = $this->getPermisoKey($permisos[$i]['permiso']);
            
            if($key == ''){continue;}
            if($permisos[$i]['valor'] == 1){
                $v = true;
            }
            else{
                $v = false;
            }
            
            $data[$key] = array(
                'key' => $key,
                'valor' => $v,
                'nombre' => $this->getPermisoNombre($permisos[$i]['permiso']),
                'id' => $permisos[$i]['permiso']
            );
        }
        
        $todos = $this->getPermisosAll();
        $data = array_merge($todos, $data);
        
        return $data;
    }
    
    public function getPermisoKey($permisoID)
    {
        $permisoID = (int) $permisoID;
        
        $key = $this->_db->query(
                "SELECT `key` FROM permisos WHERE id_permiso = $permisoID"
                );
        
        $key = $key->fetch();
        return $key['key'];
    }
    
    public function getPermisoNombre($permisoID)
    {
        $permisoID = (int) $permisoID;
        
        $key = $this->_db->query(
                "SELECT permiso FROM permisos WHERE id_permiso = $permisoID"
                );
        
        $key = $key->fetch();
        return $key['permiso'];
    }
    
    public function getPermisosAll()
    {
        $permisos = $this->_db->query(
                "SELECT * FROM permisos"
                );
                
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        
        for($i = 0; $i < count($permisos); $i++){
            $data[$permisos[$i]['key']] = array(
                'key' => $permisos[$i]['key'],
                'valor' => 'x',
                'nombre' => $permisos[$i]['permiso'],
                'id' => $permisos[$i]['id_permiso']
            );
        }
        
        return $data;
    }
    
    public function insertarRole($role)
    {
        $this->_db->query("INSERT INTO roles VALUES(null, '{$role}')");
    }
    
    public function getPermisos()
    {
        $permisos = $this->_db->query("SELECT * FROM permisos");
        
        return $permisos->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function eliminarPermisoRole($roleID, $permisoID)
    {
        $this->_db->query(
                "DELETE FROM permisos_role " . 
                "WHERE permiso = {$permisoID} " .
                "AND role = {$roleID}"
                );
    }

    public function editarPermisoRole($roleID, $permisoID, $valor)
    {
        $this->_db->query(
                "replace into permisos_role set role = {$roleID}, permiso = {$permisoID}, valor = '{$valor}'"
                );
    }

    public function insertarPermiso($permiso, $llave)
    {
        $this->_db->query(
                "INSERT INTO permisos VALUES" .
                "(null, '{$permiso}', '{$llave}')"
                );
    }
	
	public function DeleteRole($post)
    {
		try 
		{
			$menu = $this->_db->prepare("DELETE FROM roles WHERE id_role = :id");
			$res = $menu->execute(array(
				':id' => $post["id"],
			));
			if($menu->errorCode() == 0) 
			{
				echo $post["id"];
			} else {
				$errors = $menu->errorInfo();
				echo($errors[2]);
			}
		}
		catch( PDOException $Exception ) 
		{
			echo $Exception->getMessage( );
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}	
    }
}
*/

?>
