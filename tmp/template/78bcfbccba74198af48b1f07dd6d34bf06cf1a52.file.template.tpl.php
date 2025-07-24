<?php /* Smarty version Smarty-3.1.8, created on 2025-07-14 11:46:32
         compiled from "/opt/sitios/sigo/views/layout/lte2/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5745386606875265832ebc3-20932759%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78bcfbccba74198af48b1f07dd6d34bf06cf1a52' => 
    array (
      0 => '/opt/sitios/sigo/views/layout/lte2/template.tpl',
      1 => 1752185911,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5745386606875265832ebc3-20932759',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_layoutParams' => 0,
    'ifobody' => 0,
    'widgets' => 0,
    '_error' => 0,
    '_mensaje' => 0,
    '_contenido' => 0,
    'wd' => 0,
    'plg' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687526583c8410_60066217',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687526583c8410_60066217')) {function content_687526583c8410_60066217($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_name'];?>
</title>
  <link rel="icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/ico.png">
  <meta name="robots" content="noindex">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- JQVMap -->
  <!--<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/jqvmap/jqvmap.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/toastr/toastr.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/datatables_1.10.21/datatables.css">
  <!--<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/datatables_1.10.21/plugins/Buttons-1.7.0/css/buttons.dataTables.min.css">  -->
  <!-- bootstrap dialog -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/css/bootstrap-dialog.min.css">
  <!-- Bootstrap Toggle -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css">
  <!-- div para la animacion de carga (loader) -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
dist/css/loader.css">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/jquery-ui/jquery-ui.min.css">

     <!-- estilos para listas arrastrablesr -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
../../../public/css/etiquetas_nestable.css">

<script>
   var banderaSelectGenerator = false;        
</script>
<!-- jQuery -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/jquery/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/jquery.dragsort.js"></script> 
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/jquery-ui/jquery-ui.min.js"></script>


<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- Bootstrap File Input -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/fileinput/css/fileinput.min.css">
<!--<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/fontawesome-free/css/all.min.css">-->

<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>

<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/fileinput/js/locales/es.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/fileinput/themes/fas/theme.js" type="text/javascript"></script>
<!-- DataTables -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/datatables_1.10.21/datatables.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/datatables_1.10.21/plugins/filtering/accent-neutralise.js"></script>
<!--<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/datatables_1.10.21/plugins/Buttons-1.7.0/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/datatables_1.10.21/plugins/Buttons-1.7.0/js/buttons.html5.min.js"></script>-->

<!-- app.js generatork-->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/app.js?param1=<?php echo rand(time(),100000);?>
" type="text/javascript"></script>
<!-- funciones genericas franwork-->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/generic_functions.js" type="text/javascript"></script>

  <style type="text/css">
    body{ 
      font-size: 1 rem;
        line-height: 1.3 !important;
     }

    table.dataTable.compact tbody td {
        padding: 7px !important;
    }

    .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,0.03);
    }

    .select2-container--default .select2-selection--single {

      height: calc(2.25rem + 2px) !important;
    }

    /*.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #28a745;
      color: #fff;
    }*/
    .modal { overflow: auto !important; }

    .modal-xl{ 
      max-width: 1140px !important;
    }
    
   .container{ 
      max-width: 1140px !important;
    }

    .cke_editable {

  zoom: 2;
}
         
  </style>


<style>

  .ck-editor__editable_inline {
      min-height: 150px;
    }
   
    .required-data::after {
      content: "*";
      color: red;
    }
    .fichaarea{
      padding: 0.9rem !important;
    }
    #contpricipal{
      padding: 2rem !important;
    }
    .btn-info:disabled{
      background-color: gray !important;
      border-color: lightgrey !important;
    }
  
  
    @media (max-width: 770px) {
    .bs-stepper .step-trigger {
      font-size: 12px !important;
      padding: 2px !important;
    }
    .titulo_largo{
      display: none;
    }

    .file-drop-zone-title
    {
      padding: 2px 10px;
    }
    .file-drop-zone
    {
      min-height: 20px !important;
    }
    

  }

  @media (max-width: 570px) {

    .container, .container-fluid{
      padding: 0px;
    }
    .img-card-serv{
      width:35%;
      float: left;
    }
    .fichaarea{
      width:65%;
      float: right;
    }
    .card-contend-serv{
      position: relative;
      display: block;
    }

  }
  
  
   
    
  </style>

  

    <script>
       var banderaListas = false; 
    </script>


<script>
  function noatras(){
      window.location.hash="no-back-button";
      window.location.hash="Again-No-back-button"
      window.onhashchange=function(){
          window.location.hash="no-back-button";
          //alert("Nooo");
          stepper1.previous();

      }
  }

</script>



</head>
<?php if ((($tmp = @$_GET['ocultar'])===null||$tmp==='' ? '' : $tmp)!=1){?>
<body class="hold-transition sidebar-mini layout-fixed dark-mode layout-navbar-fixed layout-footer-fixed" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['ifobody']->value)===null||$tmp==='' ? '' : $tmp);?>
>
  <?php }else{ ?>
<body class="hold-transition sidebar-mini layout-fixed" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['ifobody']->value)===null||$tmp==='' ? '' : $tmp);?>
>
<?php }?>






<div class="modal fade" id="_modal_iframe" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" style="min-width:calc(95%);">
    <div class="modal-content">
        <div class="modal-header">  
            <h5 id="_titulo_modal_iframe" class="modal-title"><i class="fas fa-edit"></i>Título</h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body text-center" id="_body_modal_iframe">
          Contenido
        </div>
        <div id="_footer_modal_iframe" class="modal-footer justify-content-between">
          footer
        </div>
    </div>                          
  </div>
</div>

<div class="wrapper">
<?php if ((($tmp = @$_GET['ocultar'])===null||$tmp==='' ? '' : $tmp)!=1){?>
  <!-- Navbar -->

  <nav id="TOP_MENU" class="main-header navbar navbar-expand navbar-white navbar-light" >
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto"> <!-- Utiliza la clase 'mr-auto' para alinear a la izquierda -->
      <li class="nav-item">
        <a id="ASIDE_MENU" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
" class="nav-link"><i class="fa fa-home"></i> Inicio </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><i class="fa-solid fa-envelopes-bulk"></i> X </a>
      </li>
    
    </ul>

    <div id="titulobarra" class="navbar-text text-bold" style="color: grey; font-size: 1.1rem">
      <span class="titulo_corto"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_name_short'])===null||$tmp==='' ? '' : $tmp);?>
</span>  <span class="titulo_largo"> | <?php echo (($tmp = @$_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_name'])===null||$tmp==='' ? '' : $tmp);?>
</span> 
    </div>
   
    <ul class="navbar-nav ml-auto"> <!-- Utiliza la clase 'ml-auto' para alinear a la derecha -->

      <div id="OPTION_MENU">
        <!-- Puedes agregar contenido adicional aquí si es necesario -->
      </div>

      <li class="nav-item dropdown">
        <a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
usuarios/login/cerrar" class="nav-link">Cerrar sesión</a>
      </li>
 
    </ul>
</nav>


  <!-- /.navbar -->


<?php echo $_smarty_tpl->getSubTemplate ("aside.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php }?>

  <!-- Content Wrapper. Contains page content -->
  <?php if ((($tmp = @$_GET['ocultar'])===null||$tmp==='' ? '' : $tmp)!=1){?>
  <div class="content-wrapper p-0">
  <?php }else{ ?>
<div class="content p-0">
  <?php }?>


    <!-- Main content -->
    <section class="content p-0">

      <div class="container-fluid">

        <div <?php if (isset($_smarty_tpl->tpl_vars['widgets']->value['sidebar'][0])){?> class="col-md-10" <?php }?>>
            <noscript><p>Para el correcto funcionamiento debe tener el soporte para javascript habilitado</p></noscript>
               <!-- 
            <?php if (isset($_smarty_tpl->tpl_vars['_error']->value)){?>
                <div id="_errl" class="alert alert-error">
                    <a class="close" data-dismiss="alert">x</a>
                    <?php echo $_smarty_tpl->tpl_vars['_error']->value;?>

                </div>
            <?php }?> 
            -->

            <?php if (isset($_smarty_tpl->tpl_vars['_mensaje']->value)){?>
                <div id="_msgl" class="alert alert-success">
                    <a class="close" data-dismiss="alert">x</a>
                    <?php echo $_smarty_tpl->tpl_vars['_mensaje']->value;?>

                </div>
            <?php }?>
            <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['_contenido']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

          </div>                            
          <?php if (isset($_smarty_tpl->tpl_vars['widgets']->value['sidebar'][0])){?>
          <div class="col-md-2">
            <?php  $_smarty_tpl->tpl_vars['wd'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wd']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['widgets']->value['sidebar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wd']->key => $_smarty_tpl->tpl_vars['wd']->value){
$_smarty_tpl->tpl_vars['wd']->_loop = true;
?>
                <?php echo $_smarty_tpl->tpl_vars['wd']->value;?>

            <?php } ?>
          </div>
          <?php }?>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->





      </div>
    </section>
    <!-- /.content -->
  </div>





  
  
  <!-- /.content-wrapper -->
  <?php if ((($tmp = @$_GET['ocultar'])===null||$tmp==='' ? '' : $tmp)!=1){?>
  <footer class="main-footer">
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_name'];?>
 </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versión</b> <?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['configs']['app_version'];?>


    </div>
  </footer>
<?php }?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- InputMask -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/moment/moment.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!--<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/chart.js/Chart.min.js"></script>-->
<!-- Sparkline -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!--<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
<!-- jQuery Knob Chart -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
dist/js/adminlte.js"></script>
<!--Loader-->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
dist/js/loader.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<!--<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
dist/js/demo.js"></script>-->
<!-- Select2 -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/select2/js/i18n/es.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Toggle -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/toastr/toastr.min.js"></script>

<!-- bootstrap dialog -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/bootstrap-dialog.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/chart.js/Chart.js"></script>
<!-- PartyJS -->
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/party.js/party.min.js"></script>









    <script type="text/javascript">

    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });

      /*
    if(banderaListas == true)
    {
      etiquetasArrastlables();
    }
    */
    if(banderaSelectGenerator == false){
      $(function () {
          //Initialize Select2 Elements
          $('.select2').select2();
          //Initialize Select2 Elements
          $('.select2bs4').select2({            
            theme: 'bootstrap4',
            placeholder: "Seleccione...",
          });
      });
    }

    function abrirURL(url,titulo="",footer="")
    { 
      $("#_body_modal_iframe").html('<iframe src="'+url+'/?ocultar=1" style="height: calc(90vh - 150px);border: solid 1px gray;" width="95%"></iframe>');
      $("#_titulo_modal_iframe").html(titulo);
      $("#_footer_modal_iframe").html(footer);
      $("#_modal_iframe").modal("show");
      //alert(url);
    }
    


    </script>   
      

    <?php if (isset($_smarty_tpl->tpl_vars['_layoutParams']->value['js_plugin'])&&count($_smarty_tpl->tpl_vars['_layoutParams']->value['js_plugin'])){?>
        <?php  $_smarty_tpl->tpl_vars['plg'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['plg']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_layoutParams']->value['js_plugin']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['plg']->key => $_smarty_tpl->tpl_vars['plg']->value){
$_smarty_tpl->tpl_vars['plg']->_loop = true;
?>
            <script src="<?php echo $_smarty_tpl->tpl_vars['plg']->value;?>
" type="text/javascript"></script>
        <?php } ?>
    <?php }?>
    
    <?php if (isset($_smarty_tpl->tpl_vars['_layoutParams']->value['js'])&&count($_smarty_tpl->tpl_vars['_layoutParams']->value['js'])){?>
        <?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_layoutParams']->value['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value){
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
            <script src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
" type="text/javascript"></script>
        <?php } ?>
    <?php }?>   


<script type="text/javascript">
  

  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------
    // Get context with jQuery - using jQuery's .get() method.

    if ( document.getElementById('areaChart') != null) {
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    
    

      var areaChartData = {
        labels  : ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul','Ago','Sep','Ago','Sep','Oct','Nov','Dic'],
        datasets: [
          {
            label               : 'Digital Goods',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [1, 2, 40, 19, 86, 27, 90]
          },
          {
            label               : 'Electronics',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [1065, 1059, 1080, 1081, 1056, 1055, 1040]
          },
        ]
      }

      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : false,
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        }
      }

      // This will get the first returned node in the jQuery collection.
      var areaChart       = new Chart(areaChartCanvas, { 
        type: 'line',
        data: areaChartData, 
        options: areaChartOptions
      })
    }


    //-------------
    //- BAR CHART -
    //-------------
    if ( document.getElementById('barChart') != null) {
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = jQuery.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      var barChart = new Chart(barChartCanvas, {
        type: 'bar', 
        data: barChartData,
        options: barChartOptions
      })

      //---------------------
      //- STACKED BAR CHART -
      //---------------------
      var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
      var stackedBarChartData = jQuery.extend(true, {}, barChartData)

      var stackedBarChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
      }

      var stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar', 
        data: stackedBarChartData,
        options: stackedBarChartOptions
      })
    }
  })

  const milisegundos = 300000; //900000 //1 s == 1000 miliseg
  setInterval(function(){
      // No esperamos la respuesta de la petición porque no nos importa
      fetch('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
index/refresh_session/');
  },milisegundos);


</script>


<!-- Nestable jQuery Plugin -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/jquery.nestable.js"></script>
    <script type="text/javascript">
    if(banderaListas == true)
    {
      etiquetasArrastlables();
    }
    $(function () {
      //Initialize Select2 Elements
      //$(".select2").select2();
    });


    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })



    $(".bootstrap-switch-handle-on").html("SI"); 
    $(".bootstrap-switch-handle-off").html("NO"); 
    
  </script>   

</body>
</html>
<?php }} ?>