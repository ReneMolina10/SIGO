<?php

class aclController extends Controller
{
    private $_aclm;
    
    public function __construct() 
    {
        parent::__construct();
		$this->forzarLogin();
        $this->_aclm = $this->loadModel('acl');

        $this->_acl->acceso('add_permissions');
    }
    
    public function index()
    {
        $this->_view->assign('titulo', 'Listas de acceso');
        $this->_view->renderizar('index', 'acl');
    }
    
    public function roles()
    {
        $this->_view->assign('titulo', 'Administracion de roles');
        $roles = $this->_aclm->getRoles();
        if(is_array($roles))
            $roles = array_map(array($this, 'convierteArrayIndicesMinusculas'), $roles);
        
        $this->_view->assign('roles', $roles);
        $this->_view->renderizar('roles', 'acl');
    }

    //Función que recibe un array y convierte los indices en minusculas 
    public function convierteArrayIndicesMinusculas($array = ""){
        $res = array_change_key_case($array, CASE_LOWER ); //convierte a minusculas        
        return $res;
    }

    public function secciones()
    {
        $this->_view->assign('titulo', 'Administracion de secciones');
        $this->_view->assign('secciones', $this->_aclm->getSecciones());
        $this->_view->renderizar('secciones', 'acl');
    }

    

    public function eliminar_seccion(){
         $res = $this->_aclm->eliminar_seccion($_POST);

    }


    public function guardar_seccion(){

        $res = $this->_aclm->putSeccion($_POST);

    }
    public function guardar_seccion_rol(){

        $res = $this->_aclm->guardar_seccion_rol($_POST);

    }



    public function secciones_role($roleID)
    {
        //$this->_view->assign('role', $row);
        // $this->_view->assign('roles', $this->_aclm->getPermisosRole($id));

        $rowSeccionesEdicion = $this->_aclm->getSeccionesRoleEdicion($roleID);

        //print_r($rowSeccionesEdicion);


        $rowSeccionesPrev = $this->_aclm->getSeccionesRoleVisualiza($roleID);

        $rowRole = $this->_aclm->getRole($roleID);


        $this->_view->assign('roles_edicion', $this->_aclm->getSeccionesAsOptions($rowSeccionesEdicion));
        $this->_view->assign('roles_prev', $this->_aclm->getSeccionesAsOptions($rowSeccionesPrev));



        $this->_view->assign('rol', $rowRole["role"]);
        $this->_view->assign('id', $roleID);

        $this->_view->renderizar('secciones_role');

        }
    public function editar_seccion($id=0)
    {
        $idIdioma = 1;

        if($id==0){
          $idPaginaSelec = 1;
          $this->_view->assign('subpagina',0);

        }else{
           $res = $this->_aclm->getInfoSeccion($id);

           $this->_view->assign('denominacion',$res["denominacion"]);
           $this->_view->assign('descripcion',$res["descripcion"]);
           $idPaginaSelec = $res["idpagina"];

           $this->_view->assign('subpagina',$res["pag_rama"]);

           $this->_view->assign('pathdir',$res["pathdir"]);

    }
    

     $listPaginas = $this->_aclm->getListPadres($idIdioma, $idPaginaSelec);

     $this->_view->assign('idseccion',$id);
     $this->_view->assign('listPaginas',$listPaginas);

     $this->_view->renderizar('editar_seccion');
    }



    public function permisos_role($roleID)
    {        
        $idRol = $this->filtrarInt($roleID);        
        if(!$idRol){
            $this->redireccionar('acl/roles');
        }    

        $row = $this->_aclm->getRole($idRol);        
        if(!$row){
            $this->redireccionar('acl/roles');
        }

        $this->_view->assign('titulo', 'Administracion de permisos role');
        $this->_view->assign('role', $row);
        $this->_view->assign('permisos', $this->_aclm->getPermisosRole($idRol));
        $this->_view->assign('permisosGenerators', $this->_aclm->getPermisosGenerators());
        $this->_view->assign('permisos_generators_rol', $this->_aclm->getPermisosGeneratorRole($idRol));
        $this->_view->renderizar('permisos_role');
    }
    
    public function nuevo_role()
    {
        $this->_view->assign('titulo', 'Nuevo Role');
        
        if($this->getInt('guardar') == 1){
            $this->_view->assign('datos', $_POST);
            
            if(!$this->getSql('role')){
                $this->_view->assign('_error', 'Debe introducir el nombre del role');
                $this->_view->renderizar('nuevo_role', 'acl');
                exit;
            }
            
            $this->_aclm->insertarRole($this->getSql('role'));
            $this->redireccionar('acl/roles');
        }
        
        $this->_view->renderizar('nuevo_role', 'acl');
    }
    
    public function permisos()
    {
        $this->_view->assign('titulo', 'Administracion de permisos');
        $this->_view->assign('permisos', $this->_aclm->getPermisos());
        $this->_view->renderizar('permisos', 'acl');
    }
    
    public function nuevo_permiso()
    {
        $this->_view->assign('titulo', 'Nuevo Permiso');
        
        if($this->getInt('guardar') == 1){
            $this->_view->assign('datos', $_POST);
            
            if(!$this->getSql('permiso')){
                $this->_view->assign('_error', 'Debe introducir el nombre del permiso');
                $this->_view->renderizar('nuevo_permiso', 'acl');
                exit;
            }
            
            if(!$this->getAlphaNum('key')){
                $this->_view->assign('_error', 'Debe introducir el key del permiso');
                $this->_view->renderizar('nuevo_permiso', 'acl');
                exit;
            }
            
            $this->_aclm->insertarPermiso(
                    $this->getSql('permiso'), 
                    $this->getAlphaNum('key')
                    );
            
            $this->redireccionar('acl/permisos');
        }
        
        $this->_view->renderizar('nuevo_permiso', 'acl');
    }
	
		public function eliminar(){
		//$this->_acl->acceso('');	
		$this->_aclm->DeleteRole($_POST);
	}

    public function guardar_permisos_generators()
    {       
        $idCampo_validar = 0;
        
        /*if(empty($_POST['nombre'])){
            $mensaje =  "Escriba el nombre del alumno";
            $idCampo_validar = "nombre";
        }elseif(empty($_POST['ap_pat'])){
            $mensaje =  "Escriba el apellido paterno";
            $idCampo_validar = "ap_pat";
        }*/
        
        if($idCampo_validar){
            $jsondata = array();                                
            $jsondata['respuesta'] = "aviso";
            $jsondata['mensajeValidacion'] = $mensaje; 
            //$jsondata['idCampo'] = $idCampo_validar;                             
            echo json_encode($jsondata);
        }else{
            //$datosValidados = array();
            $res = $this->_aclm->put_permisos_generators(); 
            echo json_encode($res);
        }        
    }

    public function guardar_permisos_modulos()
    {           
        $idRole = $this->filtrarInt($_POST['rol']);
        $values = array_keys($_POST);
        
        $replace = array();
        $eliminar = array();
        
        for($i = 0; $i < count($values); $i++){
            if(substr($values[$i],0,5) == 'perm_'){
                $permiso = (strlen($values[$i]) - 5);
                
                if($_POST[$values[$i]] == 'x'){
                    $eliminar[] = array(
                        'role' => $idRole,
                        'permiso' => substr($values[$i], -$permiso)
                    );
                }else{
                    if($_POST[$values[$i]] == 1){
                        $v = 1;
                    }
                    else{
                        $v = '0';
                    }
                    
                    $replace[] = array(
                        'role' => $idRole,
                        'permiso' => substr($values[$i], -$permiso),
                        'valor' => $v
                    );
                }
            }
        }

        for($i = 0; $i < count($eliminar); $i++){
            $this->_aclm->eliminarPermisoRole(
                    $eliminar[$i]['role'],
                    $eliminar[$i]['permiso']);
        }
        
        for($i = 0; $i < count($replace); $i++){
            $this->_aclm->editarPermisoRole(
                    $replace[$i]['role'],
                    $replace[$i]['permiso'],
                    $replace[$i]['valor']
            );
        }
        
        $res['id'] = "insertado";
        echo json_encode($res); 
    }

    
}



/*
class aclController extends Controller
{
    private $_aclm;
    
    public function __construct() 
    {
        parent::__construct();
		$this->forzarLogin();
        $this->_aclm = $this->loadModel('acl');
    }
    
    public function index()
    {
		$this->_acl->acceso('seeuser');
        $this->_view->assign('titulo', 'Listas de acceso');
        $this->_view->renderizar('index', 'acl');
    }
    
    public function roles()
    {
		$this->_acl->acceso('seeuser');
        $this->_view->assign('titulo', 'Administración de roles');
        $this->_view->assign('roles', $this->_aclm->getRoles());
        $this->_view->renderizar('roles', 'acl');
    }
       
    public function permisos_role($roleID)
    {
		$this->_acl->acceso('addrol');
        $id = $this->filtrarInt($roleID);
        
        if(!$id){
            $this->redireccionar('acl/roles');
        }
        
        $row = $this->_aclm->getRole($id);
        
        if(!$row){
            $this->redireccionar('acl/roles');
        }
        
        $this->_view->assign('titulo', 'Administracion de permisos role');
        
        if($this->getInt('guardar') == 1){
            $values = array_keys($_POST);
            $replace = array();
            $eliminar = array();
            
            for($i = 0; $i < count($values); $i++){
                if(substr($values[$i],0,5) == 'perm_'){
                    $permiso = (strlen($values[$i]) - 5);
                    
                    if($_POST[$values[$i]] == 'x'){
                        $eliminar[] = array(
                            'role' => $id,
                            'permiso' => substr($values[$i], -$permiso)
                        );
                    }
                    else{
                        if($_POST[$values[$i]] == 1){
                            $v = 1;
                        }
                        else{
                            $v = 0;
                        }
                        
                        $replace[] = array(
                            'role' => $id,
                            'permiso' => substr($values[$i], -$permiso),
                            'valor' => $v
                        );
                    }
                }
            }
            
            for($i = 0; $i < count($eliminar); $i++){
                $this->_aclm->eliminarPermisoRole(
                        $eliminar[$i]['role'],
                        $eliminar[$i]['permiso']);
            }
            
            for($i = 0; $i < count($replace); $i++){
                $this->_aclm->editarPermisoRole(
                        $replace[$i]['role'],
                        $replace[$i]['permiso'],
                        $replace[$i]['valor']);
            }
        }
        
        $this->_view->assign('role', $row);
        $this->_view->assign('permisos', $this->_aclm->getPermisosRole($id));
        $this->_view->renderizar('permisos_role');
    }
    
    public function nuevo_role()
    {
		$this->_acl->acceso('addrol');
        $this->_view->assign('titulo', 'Nuevo Role');
        
        if($this->getInt('guardar') == 1){
            $this->_view->assign('datos', $_POST);
            
            if(!$this->getSql('role')){
                $this->_view->assign('_error', 'Debe introducir el nombre del role');
                $this->_view->renderizar('nuevo_role', 'acl');
                exit;
            }
            
            $this->_aclm->insertarRole($this->getSql('role'));
            $this->redireccionar('acl/roles');
        }        
        $this->_view->renderizar('nuevo_role', 'acl');
    }
	
    public function permisos()
    {
		$this->_acl->acceso('seeuser');
        $this->_view->assign('titulo', 'Administracion de permisos');
        $this->_view->assign('permisos', $this->_aclm->getPermisos());
        $this->_view->renderizar('permisos', 'acl');
    }
    
    public function nuevo_permiso()
    {	
		$this->_acl->acceso('add_permissions');
        $this->_view->assign('titulo', 'Nuevo Permiso');
        
        if($this->getInt('guardar') == 1){
            $this->_view->assign('datos', $_POST);
            
            if(!$this->getSql('permiso')){
                $this->_view->assign('_error', 'Debe introducir el nombre del permiso');
                $this->_view->renderizar('nuevo_permiso', 'acl');
                exit;
            }
            
            if(!$this->getAlphaNum('key')){
                $this->_view->assign('_error', 'Debe introducir el key del permiso');
                $this->_view->renderizar('nuevo_permiso', 'acl');
                exit;
            }
            
            $this->_aclm->insertarPermiso(
                    $this->getSql('permiso'), 
                    $this->getAlphaNum('key')
                    );
            
            $this->redireccionar('acl/permisos');
        }
        
        $this->_view->renderizar('nuevo_permiso', 'acl');
    }
	
	public function eliminar(){
		//$this->_acl->acceso('');	
		$this->_aclm->DeleteRole($_POST);
	}
    
}


*/
?>
