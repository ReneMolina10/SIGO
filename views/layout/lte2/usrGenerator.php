<?php
$tablas["p"]= array(
    'nom'  =>"USUARIOS",
    'id'   => "ID",
    'getId'=> "SELECT (MAX(ID)+1) AS ID FROM USUARIOS"
);

$bd = array(   
    'sqlDeplegar' => "SELECT USR.ID AS ID, USUARIO, NOMBRE||' '||APPATERNO||' '||APMATERNO AS NOMBRE,ROLE_USR AS ROLE FROM USUARIOS USR
    
    LEFT JOIN (SELECT ID, ROLE AS ROLE_USR FROM ROLES WHERE VISIBLE = 1 ) ROL
    ON ROL.ID = USR.IDROLE
    ",
    'idDeplegar' => "ID",
    'idFiltro' => "ID",
    'busqLike' => 'ID',
    'busqIgual' =>'ID,',
    'nomPlural' => "Usuarios",
    'nomSingular' => "usuario",
    'cssEditar' => '',
);

$template = array(
    'editForm'  => 'modal',
); 

$form =array(
    array('etiq' => '<div class="row">'),
        array(
            'col'      => 'col-md-4',
            'campo'    => 'USUARIO',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Usuario (nickname)',
            'edit'    => 'true',
            'required' => 'true',
            'holder'=>'primera parte del correo'
        ),

        array(
            'col'      => 'col-md-4',
            'campo'    => 'NOMBRE_CORTO',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Nombre corto',
            'edit'    => 'true',
            'required' => 'true',
        ),



        array(
            'col'      => 'col-md-4',
            'campo'    => 'CORREO',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Correo Institucional',
            'edit'    => 'true',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-5',
            'campo'    => 'NOMBRE',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Nombre(s)',
            'edit'    => 'true',
            'required' => 'true',
        ),
        array(
            'col'      => 'col-md-3',
            'campo'    => 'APPATERNO',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Apellido paterno',
            'edit'    => 'true',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-4',
            'campo'    => 'APMATERNO',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Apellido materno',
            'edit'    => 'true',
            'required' => 'true',
        ),



        /*
        array(
            'col'      => 'col-md-5',
            'campo'    => 'PASS',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'contraseña',
            'required' => 'true',
        ),
        */
        array(
            'col'   =>'col-md-6',
            'campo' =>'IDROLE',
            'tipo'  =>'select',
            'datosSQL' =>'SELECT ID, ROLE AS CAMPO FROM ROLES WHERE VISIBLE = 1 ORDER BY ID DESC',
            'label' =>'Role',
            'holder'=>''
        ),

        array(
            'col'      => 'col-md-4',
            'campo'    => 'NUMEMPL',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'No. Empleado',
            'edit'    => 'true',
            'required' => 'true',
        ),


        array(
            'col'   =>'col-md-12',
            'campo' =>'ACCESOS_REPORTE',
            'tipo'  =>'dual_listbox',
            'class' => 'select2',
            'datosSQL' =>"SELECT URESH AS ID, URESH||' - '||NURESH || DECODE(ACTIVO,1,'','(Cerrado)')  AS CAMPO FROM SISRH.VP_URES WHERE ACTIVO = 1  ORDER BY URESH ASC ",
            'label' =>'Accesos ',
            'holder'=>'',
            'tabla_g' =>'USR_GLOBAL_ACCESO',
            'id_tabla_g' =>'ID_USR',
            'valor_tabla_g' =>'ID_URE',
        ),



/*
         //IMAGEN
        array( 
            'col'   =>'col-sm-12',
            'campo' =>'img',
            'tipo'  =>'uploadfile', // Para subida de archivo
            'format'=>["jpg", "jpeg", "gif", "png"], //Formatos que se aceptan subir
            //'multiple'=>'true',
            'size'  =>'10000', //En KB
            'path'  => RUTA_IMG_PERFIL, //Ruta para guardar
            'label' =>'Imagen',
            'file_name' =>'img', //Nombre del archivo para guardar
        ),

*/
        //Array para ocultar un dato
        array(
            'campo' => 'ID',
            'tipo' => 'oculto'
        ),

    array(
        'etiq'  =>'</div>'
    ),  

);



?>