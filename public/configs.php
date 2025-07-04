<?php
$config = array();

//URL donde se encuentrar los archivos de la plantilla (Imágenes)
$config["path_files_plantilla"] = "http://biblioteca.uqroo.mx/";


//CSS's de la plantilla
$config["css"][0]["url"] = "https://".$_SERVER['SERVER_NAME']."/admin/public/css/bootstrap.min.css";
$config["css"][1]["url"] = "https://".$_SERVER['SERVER_NAME']."/admin/public/css/style.css";
$config["css"][2]["url"] = "https://".$_SERVER['SERVER_NAME']."/admin/public/css/colors.css";
$config["css"][3]["url"] = "https://".$_SERVER['SERVER_NAME']."/admin/public/css/main.css";
$config["css"][4]["url"] = "https://".$_SERVER['SERVER_NAME']."/admin/public/css/weather-icons.min.css";



/* BLOQUE DE VISTAS */

$config["vista"][0]["id"] = 1;
$config["vista"][0]["denomina"] = "Principal";
$config["vista"][0]["path"] = "index.tpl"; //Si el archivo está en un subdirectorio se deberá indicar: subdirectorio/segundario.tpl

$config["vista"][1]["id"] = 2; 
$config["vista"][1]["denomina"] = "Secundario";
$config["vista"][1]["path"] = "segundario.tpl";


//Página no encontrada
$config["404"] = "404.tpl";
//Página de usuario sin acceso
$config["noaccess"] = "sinacceso.tpl";
//Página de autenticación
$config["login"] = "login.tpl";
//Página de búsqueda
$config["search"] = "busqueda.tpl";
//Página de búsqueda
$config["editprofile"] = "editar_perfil.tpl";





//Menú aside (Menú local)
$config["menu"]["aside"]["id"] = "0";
$config["menu"]["aside"]["var_tpl"] = "menu_aside";
/*
$config["menu"]["aside"]["ul_bloque_hijo"] = 'class="treeview-menu" style="display: none;"';
$config["menu"]["aside"]["li_item_padre"] = 'class="treeview"';
$config["menu"]["aside"]["a_item_padre"] = ''; */
$config["menu"]["aside"]["a_item_padre"] = 'class="btn btn-default"';


//Menú(s) global que está(n) presente(s) en todo el sitio (Ej. Menú superior)
$config["menu"]["global"][1]["id"] = "3";
$config["menu"]["global"][1]["var_tpl"] = "menu_global_1";
$config["menu"]["global"][1]["li_item_padre"] = 'class="dropdown"';
$config["menu"]["global"][1]["a_item_padre"] = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"';
$config["menu"]["global"][1]["ul_bloque_hijo"] = 'class="dropdown-menu"';






?>


