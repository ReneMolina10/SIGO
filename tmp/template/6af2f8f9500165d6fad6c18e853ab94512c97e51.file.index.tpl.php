<?php /* Smarty version Smarty-3.1.8, created on 2025-08-21 00:04:42
         compiled from "C:\xampp\htdocs\SIGO\views\generators\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49717983968a6467a46fe56-30633148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6af2f8f9500165d6fad6c18e853ab94512c97e51' => 
    array (
      0 => 'C:\\xampp\\htdocs\\SIGO\\views\\generators\\index.tpl',
      1 => 1752446948,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49717983968a6467a46fe56-30633148',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'csseditar' => 0,
    'nomplural' => 0,
    'bd' => 0,
    'urlbarra' => 0,
    '_layoutParams' => 0,
    'graficas' => 0,
    'key' => 0,
    'fila' => 0,
    'reports' => 0,
    'controlador' => 0,
    'filtro' => 0,
    'template' => 0,
    'nomsingular' => 0,
    'ididioma' => 0,
    'idgrupo' => 0,
    'columnas' => 0,
    'tablaResponsiva' => 0,
    'tablaScrollX' => 0,
    'checkbox_column' => 0,
    'btn' => 0,
    'nombreMenu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68a6467a4bb5f5_82174222',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68a6467a4bb5f5_82174222')) {function content_68a6467a4bb5f5_82174222($_smarty_tpl) {?><style type="text/css">

  <?php echo (($tmp = @$_smarty_tpl->tpl_vars['csseditar']->value)===null||$tmp==='' ? '' : $tmp);?>


  @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
    .btn-group {
      display: none !important;
    }
}

/*#grid th{
  width: auto !important;
}*/

/*table.dataTable.order-column.stripe tbody tr.odd > .sorting_1 , 

table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
  background-color: aliceblue;

  }*/





  #grid_processing{
    z-index: 1000 !important;
    
  }
 /* table.dataTable tbody th, table.dataTable tbody td {
    padding: 2px 10px;
  }
  table.dataTable tfoot th {
      text-align: center;
  }*/
  th {
    border-top: 1px solid #dddddd;
    border-bottom: 1px solid #dddddd;
    border-right: 1px solid #dddddd; 
  }

  th:first-child {
    border-left: 1px solid #dddddd;
  }

  .dataTables_processing{
    font-size: 30px !important;
    color: orange !important;
  }
  table input {   width: 100% !important; }
  .content{
        padding-top: 15px!important;
  }
  ol{
    margin:0;
    padding:0;
    list-style-type:none;
  }
  .card-title{
    font-size: 1.75rem;
  }
</style>

<div class="card">
  <div class="card-header">
    <h3 style="margin:0px;  text-transform: uppercase;" class="card-title"> <?php echo $_smarty_tpl->tpl_vars['nomplural']->value;?>
</h3>  
    <div class="card-tools no-print"> 

        <div class="btn-group" role="group">
            <?php echo (($tmp = @$_smarty_tpl->tpl_vars['bd']->value['htmlSup'])===null||$tmp==='' ? '' : $tmp);?>

        </div>


      <?php if ((($tmp = @$_GET['ocultar'])===null||$tmp==='' ? '' : $tmp)!=1){?>
        <a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php $_tmp1=ob_get_clean();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['urlbarra']->value)===null||$tmp==='' ? $_tmp1 : $tmp);?>
" class="btn btn-sm btn-link">Regresar</a>
      <?php }?>

      <?php if (isset($_smarty_tpl->tpl_vars['graficas']->value)&&$_smarty_tpl->tpl_vars['graficas']->value!=''){?>
        <?php if (count($_smarty_tpl->tpl_vars['graficas']->value)>0){?>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary bg-purple dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chart-pie"></i> Graficas</button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
              <?php  $_smarty_tpl->tpl_vars['fila'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fila']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['graficas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->key => $_smarty_tpl->tpl_vars['fila']->value){
$_smarty_tpl->tpl_vars['fila']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['fila']->key;
?>
                <a class="dropdown-item " href="javascript:open_modal_graficas(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
, '<?php echo $_smarty_tpl->tpl_vars['fila']->value['titulo'];?>
')" alt="" text="" target="_self"><?php echo $_smarty_tpl->tpl_vars['fila']->value['titulo'];?>
</a>
              <?php } ?>
            </div>
          </div>            
        <?php }?>
      <?php }?>

      <?php if (isset($_smarty_tpl->tpl_vars['reports']->value)&&$_smarty_tpl->tpl_vars['reports']->value!=''){?>
        <?php if (count($_smarty_tpl->tpl_vars['reports']->value)>0){?>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <?php  $_smarty_tpl->tpl_vars['fila'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fila']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['reports']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->key => $_smarty_tpl->tpl_vars['fila']->value){
$_smarty_tpl->tpl_vars['fila']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['fila']->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['fila']->value['sql']){?>
                  <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/reporte/<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
/" target="_blank"><?php echo $_smarty_tpl->tpl_vars['fila']->value['name'];?>
</a>
                <?php }elseif($_smarty_tpl->tpl_vars['fila']->value['url']){?>
                  <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['fila']->value['url'];?>
<?php if ($_smarty_tpl->tpl_vars['fila']->value['idfiltro']){?><?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
<?php }?>" target="_self"><?php echo $_smarty_tpl->tpl_vars['fila']->value['name'];?>
</a>
                <?php }?>
              <?php } ?>
            </div>
          </div>
        
        <?php }?>
      <?php }?> 


      <?php if (isset($_smarty_tpl->tpl_vars['template']->value['btnsExtras'])&&$_smarty_tpl->tpl_vars['template']->value['btnsExtras']!=''){?>
        <?php if (count($_smarty_tpl->tpl_vars['template']->value['btnsExtras'])>0){?>
          <?php  $_smarty_tpl->tpl_vars['fila'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fila']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['template']->value['btnsExtras']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->key => $_smarty_tpl->tpl_vars['fila']->value){
$_smarty_tpl->tpl_vars['fila']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['fila']->key;
?>
            <a class="btn btn-sm <?php echo (($tmp = @$_smarty_tpl->tpl_vars['fila']->value['class'])===null||$tmp==='' ? 'btn-default' : $tmp);?>
" href="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['fila']->value['href'])===null||$tmp==='' ? '#' : $tmp);?>
" target="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['fila']->value['target'])===null||$tmp==='' ? '_self' : $tmp);?>
"> <?php echo $_smarty_tpl->tpl_vars['fila']->value['label'];?>
 </a>
          <?php } ?>
        <?php }?>
      <?php }?> 


      <?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['filtro']->value)===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("views/generators/btn_registrar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('urlAgregar'=>($_smarty_tpl->tpl_vars['_layoutParams']->value['root']).($_smarty_tpl->tpl_vars['controlador']->value)."/editar/0/0/0/".$_tmp2,'esModal'=>($_smarty_tpl->tpl_vars['template']->value['editForm']=='modal'),'nSingular'=>$_smarty_tpl->tpl_vars['nomsingular']->value,'ocultarAgregar'=>(($tmp = @$_smarty_tpl->tpl_vars['bd']->value['ocultarBtnAgregar'])===null||$tmp==='' ? 'false' : $tmp)), 0);?>






    </div>                               
  </div>

  <div class="card-body ">


 <?php if ((($tmp = @$_smarty_tpl->tpl_vars['template']->value['displayInfo']['mode'])===null||$tmp==='' ? '' : $tmp)=="sortlist"){?>


  
    <div id="sort_content">
      



       <form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formlista" name="formlista" action="javascript:guardar()" method="post">

<!-- Listas arrastrables  -->
        <div class="dd" id="nestable">
            <ol class="dd-list"  id="contenido_list">
            x
            </ol>           
        </div>
        
        <p>
            <input type="hidden" id="ididioma" name="ididioma" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['ididioma']->value)===null||$tmp==='' ? '' : $tmp);?>
"/>
            <input type="hidden" id="idgrupo" name="idgrupo" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['idgrupo']->value)===null||$tmp==='' ? '' : $tmp);?>
"/>

      <a href="https://virtual.uqroo.mx/miportal/ovas/" type="button" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
                Regresar al listado
            </a>

            <button type="submit" class="btn btn-primary">Guardar ordenamiento</button> 
<!--
            <a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
unidades" type="submit"  id="guardarsalir" class="btn btn-success">Guardar y salir *</a>

        --> 
      
        </p>

    <input type="hidden" id="nestable-output" name="nestable-output" />
        </form>





    </div>

  
  <?php }else{ ?>



       
        <?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tablaResponsiva']->value)===null||$tmp==='' ? true : $tmp);?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['tablaScrollX']->value)===null||$tmp==='' ? false : $tmp);?>
<?php $_tmp4=ob_get_clean();?><?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['bd']->value['checkbox_column'])===null||$tmp==='' ? false : $tmp);?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("views/generators/tabla.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('tableId'=>"tbl_grid",'columnas'=>$_smarty_tpl->tpl_vars['columnas']->value,'rutaBuscar'=>($_smarty_tpl->tpl_vars['_layoutParams']->value['root']).($_smarty_tpl->tpl_vars['controlador']->value)."/buscar/".($_smarty_tpl->tpl_vars['filtro']->value),'name_crud_table'=>'grid','parentId'=>$_smarty_tpl->tpl_vars['filtro']->value,'tablaResponsiva'=>$_tmp3,'tablaScrollX'=>$_tmp4,'checkbox_column'=>$_tmp5), 0);?>

      
      

      <?php if ((($tmp = @$_GET['ocultar'])===null||$tmp==='' ? '' : $tmp)!=1){?>
          <div class="row no-print">              
              <div class="col-md-12">
                
                  <div style="text-align: center;" class="mt-2">
                  <?php if (isset($_smarty_tpl->tpl_vars['checkbox_column']->value['buttons'])){?> 
                    <?php  $_smarty_tpl->tpl_vars['btn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['btn']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checkbox_column']->value['buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['btn']->key => $_smarty_tpl->tpl_vars['btn']->value){
$_smarty_tpl->tpl_vars['btn']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['btn']->key;
?>                    
                      <?php if (is_array($_smarty_tpl->tpl_vars['btn']->value)){?>
                        <button type="button" id="<?php echo $_smarty_tpl->tpl_vars['btn']->value['id'];?>
" class="btn checkbox_buttons <?php echo (($tmp = @$_smarty_tpl->tpl_vars['btn']->value['class'])===null||$tmp==='' ? 'btn-default' : $tmp);?>
" disabled><?php echo $_smarty_tpl->tpl_vars['btn']->value['label'];?>
</button>
                      <?php }?>
                    <?php } ?>
                  <?php }?>
                  <input type="button" id="btnf"  class=" btn btn-info ml-1" value="Filtrar">
                  <button  type="button" class="btn btn-secondary ml-1" data-toggle="modal" data-target="#modal_busqueda"><i class="fas fa-sliders-h"></i> Búsqueda avanzada </button>
                  
                  </div>
                  <div style="text-align: center;">
                      <br/>
                      <a href="javascript:window.print();" id="">Imprimir pantalla</a> |
                  <a href="#" id="btnDescRes">Descargar en Excel </a> |
                  <a href="#" id="btnDescResScv">Descargar en CSV</a> 
                  </div>

              </div>
              <div class="col-md-4"> </div>
          </div>
        <?php }?>


      <?php }?>
      
  </div>
</div>

<!--
<table class="stripe hover order-column table-sm cell-border compact dataTable" style="    max-width: 674px;">
  <thead>
  <tr>
      <th>Operador</th>
      <th>Descripción</th>
      <th>Ejemplo</th>
  </tr>
  </thead>
  <tbody>
    <tr>
      <td>{valor}</td>
      <td>Sin operador, si la columna contiene el valor</td>
      <td>8</td>
    </tr>
     <tr>
      <td>={valor}</td>
      <td>Igual (búsqueda exacta)</td>
      <td>=8</td>
    </tr>
     <tr>
      <td>>{valor}</td>
      <td>Mayor que</td>
      <td>>8  </td>
    </tr>
     <tr>
      <td><{valor}</td>
      <td>Menor que</td>
      <td><8</td>
    </tr>
     <tr>
      <td><>{valor}</td>
      <td>Diferente</td>
      <td><>8</td>
    </tr>
     <tr>
      <td>{varlor_fecha}|{valor_fecha}</td>
      <td>Entre dos valores</td>
      <td>01/01/2021|05/02/2021</td>
    </tr>
     <tr>
      <td>IN({valor},{valor},{valor},...)</td>
      <td>Tiene los valores</td>
      <td>IN(8,10,15)</td>
    </tr>

  </tbody>
  
</table>
-->



<div class="col-sm-8 col-md-6">

</div>


<!-- ================================ MODALES ========================= -->
<?php echo $_smarty_tpl->getSubTemplate ("views/generators/ventanas_modal.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



<div id="divLoading"> </div> 


<script>

  



 <?php if ((($tmp = @$_smarty_tpl->tpl_vars['template']->value['displayInfo']['mode'])===null||$tmp==='' ? '' : $tmp)=="sortlist"){?>

      // alert("Ok");

          $.ajax({
            data:  'id_reg='+id_reg,
            url:   "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/infosort/<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
",
            type:  'post',
            scriptCharset:"utf-8",
            beforeSend: function () {
              //$("div#divLoading").addClass('show');
              //alert('Antes');
              $('#contenido_list').html("Cargando información");
              
            },
            success:  function (response) {
              //$("#formulario").html(response);
              //alert('Ok'+response);
              $('#contenido_list').html(response);
            },
            complete: function ( ) {
               // $("div#divLoading").removeClass('show');
              // alert('Listo');
            },
            failure: function (response) {
              alert(response.responseText);
            },
            error: function (response) {
              modal_danger("Error en respuesta","Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
            }
        })




   <?php }else{ ?>
 
        

  <?php }?>


 
  

  $(document).ready(function() {
                /*
        var oTable = $('#test').dataTable( {
        } );
        */
        /*
                      $( 'input' ).on( 'keyup', function (e) {
                              alert("Hola");
                      } ); 
        */
  } );




  /*function eliminaregistro(id){
    eliminar_reg_generator('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
',id,'<?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
 ');
  }*/
   
  /*$("#txtbuscar").on('keyup', function (e) {
    if (e.keyCode == 13) {
      buscar('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
')
    }
  });*/



  


  //////////////////////////////////////////////////////////////////////////////////////////
  //////////// Funciones para el funcionamiento del formulario en ventana modal ////////////
  //////////////////////////////////////////////////////////////////////////////////////////

  /*function open_modal_to_add() {
    //limpiar_campos_modal();
    $("#modal_formulario").modal();
  }*/

  
  //Crear función que me traiga el formulario con los datos cada que le de clic en el botón Editar/ duplicar 
  /*function open_modal_to_edit(id_reg = 0, id_idioima = 0, duplicar = 0) {
    $("#tit_modal_edit").html('<i class="fas fa-pencil-alt"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
');
    $("#btnguardar").show();
    //var id_reg_modal = $("#modal_formulario").val(); 
    //if(id_reg_modal != id_reg){
      //limpiar_campos_modal();
      $.ajax({
              data:  'id_reg='+id_reg+'&id_idioima='+id_idioima+'&duplicar='+duplicar,
              url:   "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/editar_modal/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['filtro']->value)===null||$tmp==='' ? '' : $tmp);?>
",
              type:  'post',
              scriptCharset:"utf-8",
              beforeSend: function () {
                $("div#divLoading").addClass('show');
              },
              success:  function (response) {
                $("#formulario").html(response);
              },
              complete: function ( ) {
                  $("div#divLoading").removeClass('show');
              },
              failure: function (response) {
                alert(response.responseText);
              },
              error: function (response) {
                modal_danger("Error en respuesta","Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
              }
          })
          /*.done(function( data, textStatus, jqXHR ) { 
                var obj = IsJsonString(data);
                if(obj != false) { 
                  $('#nombre_ciclo').val(obj.denominacion);
                  $('#fechaInicio').val(obj.fecha_inicio);
                  $("#fechaFin").datepicker("option", "minDate", obj.fecha_inicio);
                  $('#fechaFin').val(obj.fecha_fin);
                  //$("#estatus").bootstrapSwitch('state', obj.activo);

                }else{
                  cuadroDialogoDanger("Error",data, "Aceptar");
                }                             
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                alert( "La solicitud a fallado: " +  textStatus);
                $("div#divLoading").removeClass('show');
            });*/
    //}
  /*  $('#id_reg_modal').val(id_reg);
    //$("#modal_formulario").modal("show")
    $('#modal_formulario').modal({
			focus: false
		});
  }*/

  /*function limpiar_campos_modal() {
    $('#fechaFin').val('');
    $("#fechaFin").datepicker("option", "minDate", "");
    //$("#estatus").bootstrapSwitch('state', false);
  }*/

  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////


  function open_modal_detalles(id_reg = 0) {
    $("#tit_modal_edit").html('<i class="fas fa-file-alt"></i> Detalle de <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
');   
    $("#btnguardar").hide();                     
    //var id_reg_modal = $("#modal_formulario").val(); 
    //if(id_reg_modal != id_reg){
    //limpiar_campos_modal();
    $.ajax({
            data:  'id_reg='+id_reg,
            url:   "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/detalles_modal",
            type:  'post',
            scriptCharset:"utf-8",
            beforeSend: function () {
              $("div#divLoading").addClass('show');
            },
            success:  function (response) {
              $("#formulario").html(response);
              $("[name='switch']").bootstrapSwitch(); 
              $("div#divLoading").removeClass('show');
            },
            complete: function ( ) {
                $("div#divLoading").removeClass('show');
            },
            failure: function (response) {
              $("div#divLoading").removeClass('show');
              alert(response.responseText);
            },
            error: function (response) {
              $("div#divLoading").removeClass('show');
              modal_danger("Error en respuesta","Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
            }
        })
    $('#id_reg_modal').val(id_reg);
    $("#modal_formulario").modal("show")
  }

  

  //////////////////////////////////////////////////////////////////////////////////////////
  /////////////////// Funciones para el funcionamiento de las graficas   ///////////////////
  //////////////////////////////////////////////////////////////////////////////////////////

  function open_modal_graficas(id_grafica = 0, $titulo = "") {
    $("#tit_modal_graficas").html($titulo);                      

    $.ajax({
            data:  'id_grafica='+id_grafica,
            url:   "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/grafica_modal",
            type:  'post',
            scriptCharset:"utf-8",
            beforeSend: function () {
              $("div#divLoading").addClass('show');
            },
            success:  function (response) {
              $("#div_grafica").html(response);
            },
            complete: function ( ) {
                $("div#divLoading").removeClass('show');
            },
            failure: function (response) {
              alert(response.responseText);
            },
            error: function (response) {
              modal_danger("Error en respuesta","Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
            }
        })
    $("#modal_graficas").modal("show")
  }

  const getDataColors = opacity => {
    const colors = ['#7448c2', '#21c0d7', '#d99e2b', '#cd3a81', '#9c99cc', '#e14eca', '#ffffff', '#ff0000', '#d6ff00', '#0038ff']
    return colors.map(color => opacity ? `${color + opacity}` : color)
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////



</script>

<!--<script  src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/app.js" type="text/javascript"></script>-->

 <?php if ((($tmp = @$_smarty_tpl->tpl_vars['template']->value['displayInfo']['mode'])===null||$tmp==='' ? '' : $tmp)=="sortlist"){?>
 <style type="text/css">
   
   #cajon1{
  float:left;
  background:#;
  width:70%;
  margin: 7px 0;
}
#cajon2{
  background:;
}


 </style>

<script>


function etiquetasArrastlables(){
//$(document).ready(function()
//{
    let updateOutput = function(e)
    {
        let list   = e.length ? e : $(e.target);
        let output = list.data('output');
        
        if (window.JSON) {
          try {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
          } catch (error) {}            
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1, maxDepth (Número máximo de submenus)
    $('#nestable').nestable({
        group: 1,maxDepth:2 
    })
    .on('change', updateOutput);

    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    updateOutput($('#nestable2').data('output', $('#nestable2-output')));

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {      
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

    $('#nestable3').nestable();

//});

};







function guardaStatus(status, id){
  $.ajax({
        data:  'status='+status+'&id='+id,
                url:   '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/guardarStatus/',
                type:  'post',
        scriptCharset:"utf-8",
                beforeSend: function () {
                  //$("#mensaje").html('Guardando...');
                },
                success:  function (response) {

          if(!isNaN(response)){

          }else{
            BootstrapDialog.show({
              title: 'Mensaje de salida',
              message: "Error: "+response,
              buttons: [{
                id: 'btn-ok',
                label: 'OK',
                cssClass: 'btn-primary',
                autospin: false,
                action: function(dialogRef)
                {
                  dialogRef.close();
                }
              }]
            });
            
          }
                }
        });   
}


function guardar(){

  $.ajax({
                /*data:  $('#formp').serialize(),*/
         data:  $('#formlista').serialize(),
                url:   '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/guardarOrdenEtiquetas/',
                type:  'post',
        /*scriptCharset: "ISO-8859-1",*/
        scriptCharset:"utf-8",
                beforeSend: function () {
                        $("#mensaje").html('Guardando...');
                },
                success:  function (response) {
          $("#mensaje").html('');
          
          if(!isNaN(response)){
             //$("#mensaje").html("Configuración guardada:"+response);
            BootstrapDialog.show({
              title: 'Mensaje de salida',
              message: "El ordenamiento de items del menú <?php echo $_smarty_tpl->tpl_vars['nombreMenu']->value;?>
 se ha actualizado. ",
              buttons: [{
                id: 'btn-ok',
                //icon: 'glyphicon glyphicon-check',
                label: 'OK',
                cssClass: 'btn-primary',
                autospin: false,
                action: function(dialogRef)
                {
                  dialogRef.close();
                  if(salir){                                                                       
                              window.location="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/listar/";
                            }
                }
              }]
            });
          }else{
            //$("#mensaje").html("Error: "+response);
            BootstrapDialog.show({
              title: 'Mensaje de salida',
              message: "Error: " + response,
              buttons: [{
                id: 'btn-ok',
                //icon: 'glyphicon glyphicon-check',
                label: 'OK',
                cssClass: 'btn-primary',
                autospin: false,
                action: function(dialogRef)
                {
                  dialogRef.close();
                }
              }]
            });
            
          }
                }
        }); 
    
}
function eliminar(id, nombre){
  BootstrapDialog.show({
    title: '¡Advertencia!',
    message: '¿Quiere eliminar la etiqueta <b>' + nombre + '</b>?',
    buttons: [{
       icon: 'bi bi-trash3',
       label: ' Eliminar',
      action: function(dialogItself){
        
        
        $.ajax({
            data:  'id='+id,
            url:   '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/eliminar/',
            type:  'post',
            scriptCharset:"utf-8",
            beforeSend: function () {
              //$("#mensaje").html('Guardando...');
            },
            success:  function (response) {
                if(!isNaN(response)){
                $("#fila_"+id).remove();
                }else{
                BootstrapDialog.show({
                  title: 'Error',
                  message: "Error: "+response,
                  buttons: [{
                    id: 'btn-ok',
                    //icon: 'glyphicon glyphicon-check',
                    label: 'OK',
                    cssClass: 'btn-primary',
                    autospin: false,
                    action: function(dialogRef)
                    {
                      dialogRef.close();
                    }
                  }]
                });
              }
            }
        });       
        dialogItself.close();     
      }
    }, {
      label: 'Cancelar',
      action: function(dialogItself){
        dialogItself.close();
      }
    }]
  });
}


function abrirURL(url)
{ 
  $("#formulario_iframe").html('<iframe src="'+url+'/?ocultar=1" style="height: calc(100vh - 150px);border: solid 1px gray;" width="100%"></iframe>');
  $("#modal_iframe").modal("show");
   //alert(url);
}



var banderaListas = true;



</script>
<script src="http://localhost/bitly/public/js/bootstrap-switch.min.js"></script>
<script></script>

 <?php }?>
<?php }} ?>