<?php

$bd = array(   
    'sqlDeplegar' => "SELECT usuarios.id AS ID, usuario AS USR, role FROM usuarios
                      LEFT JOIN roles
                      ON roles.id = usuarios.idRole",
    'idDeplegar' => "ID",
    'busqLike' => 'USR,role',
    'busqIgual' =>'ID,USR',
    'nomPlural' => "Usuarios del sistema",
    'nomSingular' => "Usuario de sistema",
   
    'cssEditar' => '',
);



$template = array(
    'editForm'  => 'modal',
); 


$tablas["p"]= array(
    'nom'  =>"usuarios",
    'id'   => "id",
    'getId'=> "SELECT (MAX(id)+1) AS ID FROM usuarios"
);


$form =array(
    array('etiq' => '<div class="row">'),


        array(
            'col'      => 'col-md-6',
            'campo'    => 'usuario',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'usuario',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-6',
            'campo'    => 'pass',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Contraseña',
            'required' => 'true',
        ),

       
        array(
            'col' => 'col-md-5',
            'label' => 'CAMPUS',
            'campo' => 'idRole',
            'tipo' => 'select',
            'datosSQL' => "SELECT id AS ID, role AS CAMPO FROM roles"
            
        ),

        array(
            'campo' => 'id',
            'tipo' => 'oculto'
        ),
            
        array(
                'etiq'  =>'</div>'
            )

);


