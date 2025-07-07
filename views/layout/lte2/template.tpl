<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{$_layoutParams.configs.app_name}</title>
  <link rel="icon" type="image/x-icon" href="{$_layoutParams.root}public/img/ico.png">
  <meta name="robots" content="noindex">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- JQVMap -->
  <!--<link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/jqvmap/jqvmap.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/toastr/toastr.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/datatables_1.10.21/datatables.css">
  <!--<link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/datatables_1.10.21/plugins/Buttons-1.7.0/css/buttons.dataTables.min.css">  -->
  <!-- bootstrap dialog -->
  <link rel="stylesheet" href="{$_layoutParams.root}public/css/bootstrap-dialog.min.css">
  <!-- Bootstrap Toggle -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css">
  <!-- div para la animacion de carga (loader) -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}dist/css/loader.css">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/jquery-ui/jquery-ui.min.css">

     <!-- estilos para listas arrastrablesr -->
    <link rel="stylesheet" href="{$_layoutParams.ruta_view}../../../public/css/etiquetas_nestable.css">

<script>
   var banderaSelectGenerator = false;        
</script>
<!-- jQuery -->
<script src="{$_layoutParams.ruta_view}plugins/jquery/jquery.min.js"></script>

<script type="text/javascript" src="{$_layoutParams.root}public/js/jquery.dragsort.js"></script> 


<!-- Bootstrap4 Duallistbox -->
<script src="{$_layoutParams.ruta_view}plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- Bootstrap File Input -->
<link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/fileinput/css/fileinput.min.css">
<!--<link rel="stylesheet" href="{$_layoutParams.ruta_view}plugins/fontawesome-free/css/all.min.css">-->

<script src="{$_layoutParams.ruta_view}plugins/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>

<script src="{$_layoutParams.ruta_view}plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="{$_layoutParams.ruta_view}plugins/fileinput/js/locales/es.js" type="text/javascript"></script>
<script src="{$_layoutParams.ruta_view}plugins/fileinput/themes/fas/theme.js" type="text/javascript"></script>
<!-- DataTables -->
<script src="{$_layoutParams.ruta_view}plugins/datatables_1.10.21/datatables.min.js"></script>
<script src="{$_layoutParams.ruta_view}plugins/datatables_1.10.21/plugins/filtering/accent-neutralise.js"></script>
<!--<script src="{$_layoutParams.ruta_view}plugins/datatables_1.10.21/plugins/Buttons-1.7.0/js/dataTables.buttons.min.js"></script>
<script src="{$_layoutParams.ruta_view}plugins/datatables_1.10.21/plugins/Buttons-1.7.0/js/buttons.html5.min.js"></script>-->

<!-- app.js generatork-->
<script src="{$_layoutParams.root}public/js/app.js?param1=7" type="text/javascript"></script>
<!-- funciones genericas franwork-->
<script src="{$_layoutParams.root}public/js/generic_functions.js" type="text/javascript"></script>

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
{if $smarty.get.ocultar|default:'' != 1}
<body class="hold-transition sidebar-mini layout-fixed dark-mode layout-navbar-fixed layout-footer-fixed" {$ifobody|default:''}>
  {else}
<body class="hold-transition sidebar-mini layout-fixed" {$ifobody|default:''}>
{/if}





{*MODAL PARA IFRAMES*}
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
{if $smarty.get.ocultar|default:'' != 1}
  <!-- Navbar -->

  <nav id="TOP_MENU" class="main-header navbar navbar-expand navbar-white navbar-light" >
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto"> <!-- Utiliza la clase 'mr-auto' para alinear a la izquierda -->
      <li class="nav-item">
        <a id="ASIDE_MENU" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{$_layoutParams.root}" class="nav-link"><i class="fa fa-home"></i> Inicio </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><i class="fa-solid fa-envelopes-bulk"></i> X </a>
      </li>
    
    </ul>

    <div id="titulobarra" class="navbar-text text-bold" style="color: grey; font-size: 1.1rem">
      <span class="titulo_corto">{$_layoutParams.configs.app_name_short|default:""}</span>  <span class="titulo_largo"> | {$_layoutParams.configs.app_name|default:""}</span> 
    </div>
   
    <ul class="navbar-nav ml-auto"> <!-- Utiliza la clase 'ml-auto' para alinear a la derecha -->

      <div id="OPTION_MENU">
        <!-- Puedes agregar contenido adicional aquí si es necesario -->
      </div>

      <li class="nav-item dropdown">
        <a href="{$_layoutParams.root}usuarios/login/cerrar" class="nav-link">Cerrar sesión</a>
      </li>
 
    </ul>
</nav>


  <!-- /.navbar -->


{include file="aside.tpl"}

{/if}

  <!-- Content Wrapper. Contains page content -->
  {if $smarty.get.ocultar|default:'' != 1}
  <div class="content-wrapper p-0">
  {else}
<div class="content p-0">
  {/if}


    <!-- Main content -->
    <section class="content p-0">

      <div class="container-fluid">

        <div {if isset($widgets.sidebar[0])} class="col-md-10" {/if}>
            <noscript><p>Para el correcto funcionamiento debe tener el soporte para javascript habilitado</p></noscript>
               <!-- 
            {if isset($_error)}
                <div id="_errl" class="alert alert-error">
                    <a class="close" data-dismiss="alert">x</a>
                    {$_error}
                </div>
            {/if} 
            -->

            {if isset($_mensaje)}
                <div id="_msgl" class="alert alert-success">
                    <a class="close" data-dismiss="alert">x</a>
                    {$_mensaje}
                </div>
            {/if}
            {include file=$_contenido}
          </div>                            
          {if isset($widgets.sidebar[0])}
          <div class="col-md-2">
            {foreach from=$widgets.sidebar item=wd}
                {$wd}
            {/foreach}
          </div>
          {/if}
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->





      </div>
    </section>
    <!-- /.content -->
  </div>





  
  
  <!-- /.content-wrapper -->
  {if $smarty.get.ocultar|default:'' != 1}
  <footer class="main-footer">
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> {$_layoutParams.configs.app_name} </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versión</b> {$_layoutParams.configs.app_version}

    </div>
  </footer>
{/if}
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="{$_layoutParams.ruta_view}plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- InputMask -->
<script src="{$_layoutParams.ruta_view}plugins/moment/moment.min.js"></script>
<script src="{$_layoutParams.ruta_view}plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{$_layoutParams.ruta_view}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!--<script src="{$_layoutParams.ruta_view}plugins/chart.js/Chart.min.js"></script>-->
<!-- Sparkline -->
<script src="{$_layoutParams.ruta_view}plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!--<script src="{$_layoutParams.ruta_view}plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{$_layoutParams.ruta_view}plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
<!-- jQuery Knob Chart -->
<script src="{$_layoutParams.ruta_view}plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{$_layoutParams.ruta_view}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{$_layoutParams.ruta_view}plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{$_layoutParams.ruta_view}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{$_layoutParams.ruta_view}dist/js/adminlte.js"></script>
<!--Loader-->
<script src="{$_layoutParams.ruta_view}dist/js/loader.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="{$_layoutParams.ruta_view}dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<!--<script src="{$_layoutParams.ruta_view}dist/js/demo.js"></script>-->
<!-- Select2 -->
<script src="{$_layoutParams.ruta_view}plugins/select2/js/select2.full.min.js"></script>
<script src="{$_layoutParams.ruta_view}plugins/select2/js/i18n/es.js"></script>
<!-- date-range-picker -->
<script src="{$_layoutParams.ruta_view}plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="{$_layoutParams.ruta_view}plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Toggle -->
<script src="{$_layoutParams.ruta_view}plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
<!-- Bootstrap Switch -->
<script src="{$_layoutParams.ruta_view}plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- SweetAlert2 -->
<script src="{$_layoutParams.ruta_view}plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{$_layoutParams.ruta_view}plugins/toastr/toastr.min.js"></script>

<!-- bootstrap dialog -->
<script src="{$_layoutParams.root}public/js/bootstrap-dialog.min.js"></script>
<!-- ChartJS -->
<script src="{$_layoutParams.ruta_view}plugins/chart.js/Chart.js"></script>
<!-- PartyJS -->
<script src="{$_layoutParams.ruta_view}plugins/party.js/party.min.js"></script>









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
      

    {if isset($_layoutParams.js_plugin) && count($_layoutParams.js_plugin)}
        {foreach item=plg from=$_layoutParams.js_plugin}
            <script src="{$plg}" type="text/javascript"></script>
        {/foreach}
    {/if}
    
    {if isset($_layoutParams.js) && count($_layoutParams.js)}
        {foreach item=js from=$_layoutParams.js}
            <script src="{$js}" type="text/javascript"></script>
        {/foreach}
    {/if}   


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
      fetch('{$_layoutParams.root}index/refresh_session/');
  },milisegundos);


</script>


<!-- Nestable jQuery Plugin -->
    <script src="{$_layoutParams.root}public/js/jquery.nestable.js"></script>
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
