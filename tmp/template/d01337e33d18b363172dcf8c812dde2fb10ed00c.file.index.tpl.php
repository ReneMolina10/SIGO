<?php /* Smarty version Smarty-3.1.8, created on 2025-07-04 03:58:38
         compiled from "/opt/sitios/sigo/views/generators/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1546607926866a3ff5a8925-05632920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd01337e33d18b363172dcf8c812dde2fb10ed00c' => 
    array (
      0 => '/opt/sitios/sigo/views/generators/index.tpl',
      1 => 1751615872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1546607926866a3ff5a8925-05632920',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6866a3ff609ac8_06249529',
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
    'c' => 0,
    'checkbox_column' => 0,
    'btn' => 0,
    'titulo' => 0,
    'tablaResponsiva' => 0,
    'tablaScrollX' => 0,
    'nombreMenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6866a3ff609ac8_06249529')) {function content_6866a3ff609ac8_06249529($_smarty_tpl) {?><style type="text/css">

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


      <?php if ((($tmp = @$_smarty_tpl->tpl_vars['bd']->value['ocultarBtnAgregar'])===null||$tmp==='' ? 'false' : $tmp)=='false'){?>

        <?php if (isset($_smarty_tpl->tpl_vars['template']->value['editForm'])&&$_smarty_tpl->tpl_vars['template']->value['editForm']=='modal'){?>
          <a class="btn btn-sm btn-success" href="javascript:open_modal_to_edit()"><i class="fas fa-plus"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
</a>
        <?php }else{ ?>
          <a class="btn btn-sm btn-success" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/editar/0/0/0/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['filtro']->value)===null||$tmp==='' ? '' : $tmp);?>
"><i class="fas fa-plus"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
</a>
        <?php }?> 
      <?php }?>

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



    <?php if (count($_smarty_tpl->tpl_vars['columnas']->value)>0){?>    
      <form class="bs-example bs-example-form" enctype="multipart/form-data" id="form_principal" name="form_principal" action="" method="post">  
        <table  id="grid"  class="stripe hover order-column table-sm cell-border compact" style="width:100%"> <!--id = grid--><!--table-bordered-->
          <thead>
            <tr>
              <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columnas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
                <th><?php echo $_smarty_tpl->tpl_vars['c']->value['titulo'];?>
</th>
              <?php } ?>
            </tr>                
          </thead>

          <tbody>          
          </tbody>

          <tfoot>
            <tr>
              <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columnas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['c']->value['tipo']=='checkbox_column'){?>  
                  <th id="thfoot_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"></th>
                <?php }else{ ?>
                  <th id="thfoot_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['titulo'];?>
</th>
                <?php }?>                    
              <?php } ?>
            </tr>
          </tfoot>

        </table>
      
      </form>

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
                  <input type="button" id="btnf"  class=" btn btn-primary ml-1" value="Filtrar">
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


    <?php }else{ ?>
      <table    class="table-sm" style="width:100%; color: #757575;"> 
        <tbody> 
          <tr>            
            <th>No hay registros en la base de datos </th>
          </tr>         
        </tbody>
      </table>
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


<!-- ================================ MODAL PARA BUSQUEDAS ========================= -->
<div class="modal fade" id="modal_busqueda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
      <form class="bs-example bs-example-form" enctype="multipart/form-data" id="form_search" name="busqueda" action="" method="post">
        <div class="modal-header">     
            <h5 class="modal-title"><i class="fas fa-search"></i> Búsqueda avanzada  </h5>             
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body"> 
            <div class='row'>
              <div class='col-sm-12 '>

                <table class="table table-sm table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="30%">Campo</th>
                      <th width="30%">Opción de búsqueda</th>
                      <th width="40%">Valor</th>
                    </tr>
                  </thead>
                  <tbody id="formf"></tbody>
                </table >

              </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="id_oficio" name="id_oficio" value=""/> <!-- ¿? -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>
          <!--<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>-->
        </div>
      </form>
    </div>                          
  </div>
</div><!-- /.modal -->


<!-- ================================ MODAL PARA INSERTAR Y EDITAR ========================= -->
<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
      <form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formp" name="formp" action="javascript:guardar_generator('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
',true)" method="post" enctype="multipart/form-data" >
        <div class="modal-header">  
            <h5 id="tit_modal_edit" class="modal-title"><i class="fas fa-edit"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
  </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="formulario"> 
            <?php echo $_smarty_tpl->getSubTemplate ("views/generators/form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="id_reg" name="id_reg" value=""/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-success" id="btnguardar" type="submit"><i class="fas fa-save"></i> Guardar</button>
          <!--<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>-->
        </div>
      </form>
    </div>                          
  </div>
</div><!-- /.modal -->


<?php if (isset($_smarty_tpl->tpl_vars['graficas']->value)&&$_smarty_tpl->tpl_vars['graficas']->value!=''){?>
<!-- ================================ MODAL PARA VER GRAFICAS  ========================= -->
<div class="modal fade" id="modal_graficas" tabindex="-1" role="dialog" aria-labelledby="ModalGraficas">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    
    <div class="modal-content">
        <div class="modal-header">  
            <h5 class="modal-title"><i class="fas fa-chart-pie"></i> <span id="tit_modal_graficas" > <?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
 </span>  </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="div_grafica"> 
            
        </div>
        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>                          
  </div>
</div><!-- /.modal -->
<?php }?>

<!-- ================================ MODAL PARA IFRAMES  ========================= -->
<div class="modal fade" id="modal_iframe" tabindex="-1" role="dialog" aria-labelledby="myModalLabelIframe">
  <div class="modal-dialog modal-xl" style="min-width:calc(100%);">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header">  
            <h5 id="tit_modal_edit" class="modal-title"><i class="fas fa-edit"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
  </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="formulario_iframe"> 
            +++
        </div>
        <div class="modal-footer justify-content-between">
          
        </div>
      
    </div>                          
  </div>
</div><!-- /.modal -->


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
 
        $(document).ready(function() {
            traer_conceptos();         
        } );

  <?php }?>


 
  function traer_conceptos(){   
    
    document.getElementById("formf").innerHTML="";
    $('#grid').dataTable().fnDestroy();
    $('#grid-select-all').prop("checked", false);

    var table = $('#grid').DataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": true, 
      //"ajax": "objects.txt",
      'processing': true,
      "autoWidth": true,
      'serverSide': true,
      'serverMethod': 'post',
      "ajax": {
          'type': 'POST',
          "url": "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/buscar/<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
",
          data: function ( d ) {
              //d.nivel = nivel;
          },
          beforeSend: function () {
              $("div#divLoading").addClass('show');
              $( "#btnf" ).prop( "disabled", true );
              $( "#btnf" ).val('Espere un momento por favor...');
          }, 
          complete: function ( ) {
              $("div#divLoading").removeClass('show');
              $( "#btnf" ).prop( "disabled", false );
              $( "#btnf" ).val('Filtrar');
              //Valido si muestro los botones relacionados con los checkboxes 
              mostrar_botones_opciones_checkboxes();
              $('input:checkbox[name="id[]"]').click(function(){ mostrar_botones_opciones_checkboxes(); });
              $('input:checkbox[name=select_all]').click(function(){ mostrar_botones_opciones_checkboxes(); });
          },   
          error: function (xhr, error, code)
          {
              $("div#divLoading").removeClass('show');
              //traer_conceptos();
              modal_danger("Error","Ha ocurrido un error", "Aceptar"); //Error: ("+xhr.statusText +")  " + xhr.responseText
          },         
        },    
        "columns": [
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columnas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
              { "data": "<?php echo $_smarty_tpl->tpl_vars['c']->value['campo'];?>
" },
            <?php } ?>
                     
        ],
        "columnDefs": [
        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columnas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
              { 
                "name": "<?php echo $_smarty_tpl->tpl_vars['c']->value['campo'];?>
", 
                "targets": <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
,
                "className": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['c']->value['class'])===null||$tmp==='' ? '' : $tmp);?>
",
                "search": false,  

                <?php if ($_smarty_tpl->tpl_vars['c']->value['tipo']=='data'){?>
                  <?php if (isset($_smarty_tpl->tpl_vars['c']->value['width'])&&$_smarty_tpl->tpl_vars['c']->value['width']!=''){?> "width": "<?php echo $_smarty_tpl->tpl_vars['c']->value['width'];?>
",<?php }?>
                  "orderable": true,                                 
                <?php }elseif($_smarty_tpl->tpl_vars['c']->value['tipo']=='checkbox_column'){?>  
                  //'targets': 0,
                  "width": "5%", 
                  'searchable':false,
                  'orderable':false,
                  'className': 'dt-body-center',
                  'render': function (data, type, full, meta){
                      return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                  }
                <?php }elseif($_smarty_tpl->tpl_vars['c']->value['tipo']=='opciones'){?>  
                  "width": "5%", 
                  "orderable": false, 
                  "className": "text-center", 
                <?php }?>
                                 
              }, 
            <?php } ?>      
        ],
        "language": {
                "url": "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
/plugins/datatables_1.10.21/language/Spanish.json"
        },
        "responsive": <?php echo (($tmp = @$_smarty_tpl->tpl_vars['tablaResponsiva']->value)===null||$tmp==='' ? true : $tmp);?>
, 
        "scrollX": <?php echo (($tmp = @$_smarty_tpl->tpl_vars['tablaScrollX']->value)===null||$tmp==='' ? false : $tmp);?>
,
        "initComplete": function(settings, json) {
          $('#grid_filter input').unbind();
          $('#grid_filter input').bind('keyup', function(e) {
              if(e.keyCode == 13) {
                table.search( this.value ).draw();
              }
          });
        },
        //orderCellsTop: true,
        fixedHeader: true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        //"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]]
        /*initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;
    
                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }*/
    });
    table
      <?php if ($_smarty_tpl->tpl_vars['checkbox_column']->value==true){?> 
        .order( [ 1, 'desc' ] );
      <?php }else{ ?>
        .order( [ 0, 'desc' ] );
      <?php }?>
        // .clear()
        //.draw();
       

    //Establecer cuadros de búsqueda 
    set_search_boxes();
      

    

    //Botón Filtrar
    $('#btnf').on( 'click', function (e) {
      table.draw();
    } );
    
    //Descargar resultados en Excel
    $('#btnDescRes').on( 'click', function (e) {
      var params = table.ajax.params();
      params['filtro'] =  '<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
' ;
      //console.log(params);
      window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/descargar_resultados?datos='+JSON.stringify( params );
    } );

    //Descargar resultados en SCV
    $('#btnDescResScv').on( 'click', function (e) {
      var params = table.ajax.params();
      params['filtro'] =  '<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
' ;
      window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/descargar_resultados_csv?datos='+JSON.stringify( params );
    } );

    




      /*
      $('#test input').unbind();
      $('#test input').bind('keyup', function(e) {
      if(e.keyCode == 13) {
      oTable.fnFilter(this.value);
      }
      });
      */

      /*
      $('#grid_filter input').on( 'keyup', function () {
         // table.search( this.value ).draw();
         alert("dfs");
      } );

      */

  }


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




  function eliminaregistro(id){
    eliminar_reg_generator('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
',id,'<?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
 ');
  }
   
  /*$("#txtbuscar").on('keyup', function (e) {
    if (e.keyCode == 13) {
      buscar('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
')
    }
  });*/



  //////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////// Funciones para la búsqueda en la ventana modal /////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////

  function set_search_boxes(){
      var table = $('#grid').DataTable();

      //Creo un array para definir que columnas van a tener el cuadro de búsqueda 
      var cols = [];
      searchCols = [<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columnas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?><?php if ($_smarty_tpl->tpl_vars['c']->value['tipo']=='data'){?>true, <?php }else{ ?>false, <?php }?><?php } ?>];
      nameCols = [<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columnas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>"<?php echo $_smarty_tpl->tpl_vars['c']->value['campo'];?>
", <?php } ?>];
      //


      //establecer el cuadros de busqueda por columna
      searchCols.forEach( function(valor, i, array) {
        //console.log();
      
        if(valor){ //si es true le pongo el cuadro de busqueda a la columna 
          //var title = $('#thfoot_'+i).text();  
          var title = nameCols[i];
          //Inserto los campos de búsqueda en el pie de la tabla
          $('#thfoot_'+i).html( '<input type="text" placeholder="'+title+'" />' );


          //Inserto los campos de búsqueda en la ventana modal para búsqueda avanzada 
          $('#formf').append('<tr><td><label>'+title+'</label></td> \
                            <td><div class="input-group-sm"> <select name="operadores'+i+'" id="operadores'+i+'" class="form-control" onchange="cambiar_opcion_busqueda(\''+i+'\',\''+title+'\',this)">'+operadores+'</select></div></td> \
                            <td id="celda_valores'+i+'"><div class="input-group-sm">  <input id="valor_'+i+'" type="text" placeholder="'+title+'" class="form-control"/> </div></td></tr> <br/> ' ); 

          $( 'input', '#thfoot_'+i ).on( 'keyup', function (e) {
                  if(e.keyCode == 13) {
                      table.column(i).search( this.value ).draw();
                  }
          } );
          //guardo el valor del campo pero no se hace la busqueda 
          $( 'input','#thfoot_'+i ).on( 'change', function (e) {
              table.column(i).search( this.value );   
          } );
        }
      });
      

      //establecer el comportamiento de los cuadros de búsqueda en ventana modal
      set_actions_all_inputs();
  } 

  var operadores = '<option value="0"></option> \
                    <option value="=">Igual a "=": (búsqueda exacta)</option> \
                    <option value=">">Mayor que ">":</option> \
                    <option value=">=">Mayor o igual que ">=":</option> \
                    <option value="<">Menor que "<":</option> \
                    <option value="<=">Menor o igual que "<=":</option> \
                    <option value="<>">Diferente a "<>":</option> \
                    <option value="|">Entre dos valores: (solo fechas)</option> \
                    <option value="IN">Tiene los valores: (Números separados por comas)</option>';

  $(function () {
     $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['es']);
  })
   

  //$(".operador").on('change', function(){
  function cambiar_opcion_busqueda(i,title, select) {
    //var op = $( this ).val();
    var op = select.value;
    var id = select.id;
    id = id.substr(id.length -1)
    if(op == "|"){
      $('#celda_valores'+i).html('<div class="row"> \
                                    <div class="mb-1 mb-sm-0 col-sm-6"> \
                                      <input id="valor_ini_'+i+'" type="text" class="form-control form-control-sm" placeholder="'+title+' inicial" autocomplete="off"> \
                                    </div> \
                                    <div class="col-sm-6"> \
                                      <input id="valor_fin_'+i+'" type="text" class="form-control form-control-sm" placeholder="'+title+' final" autocomplete="off"> \
                                    </div> \
                                </div>');
      set_actions_input(i, 'valor_ini_'+i);
      set_actions_input(i, 'valor_fin_'+i);

      $("#valor_ini_"+i).datepicker({
        changeMonth: true,
        changeYear: true,
        onSelect: function (selected) {
            parts = selected.split('/');        
            y = parseInt(parts[2], 10);
            mm = parseInt(parts[1], 10); // NB: month is zero-based!
            dd = parseInt(parts[0], 10);
            //date = new Date(year, month, day);
            var dtFormatted = dd + '/'+ mm + '/'+ y;
            $("#valor_fin_"+i).datepicker("option", "minDate", dtFormatted);
            //$("#fechaFin_0").datepicker("option", "dateFormat", "dd/mm/yy"); 
            //Ejecuto la función Change en este campo porque no se activa al seleccionar una fecha, por lo tanto no se ejecuta la función que guarda el valor seleccionado en table.column(i).search( valor );
            $(this).change();                        
         }
      });
      $("#valor_fin_"+i).datepicker({
        changeMonth: true,
        changeYear: true
      });
    }else if(op == "IN"){
      $('#celda_valores'+i).html('<input id="valor_'+i+'" type="text" placeholder="Valor 1, valor 2, valor 3…" class="form-control form-control-sm"/>');
      set_actions_input(i, 'valor_'+i);
    }else{
      //$("#TextBoxDiv" + counter).remove();
      $('#celda_valores'+i).html('<input id="valor_'+i+'" type="text" placeholder="'+title+'" class="form-control form-control-sm"/>');
      set_actions_input(i, 'valor_'+i);
    }

  };

  function set_actions_all_inputs(){
      $('#formf tr').each( function (i) { 
        var id_input = $( 'input',  this ).attr('id');
        //console.log(this);
        set_actions_input(i, id_input);
      });
  } 

  //establecer el comportamiento de los cuadros de búsqueda
  function set_actions_input(i, id_input ){
      var table = $('#grid').DataTable();
      table.column(i).search( "" ); 

      //Al presionar Enter hago la busqueda
      $( '#'+id_input ).on( 'keyup', function (e) { //$( 'input', this ).on
          if(e.keyCode == 13) {
              $('#modal_busqueda').modal('hide');
              //var valor = this.value ;
              var valor = formatear_valor_busqueda(i, id_input);        
              table.column(i).search( valor ).draw();
          }
      });

      //guardo el valor del campo pero no se hace la busqueda hasta que se presione el botón Buscar 
      $( '#'+id_input ).on( 'change', function (e) {
          //var valor = this.value ;
          var valor = formatear_valor_busqueda(i, id_input);
          table.column(i).search( valor );   
      } );

  }


  $('#btnBuscar').on( 'click', function (e) {
      var table = $('#grid').DataTable();
      //$('#modal_busqueda').modal('hide');
      table.draw();
  } );

  function formatear_valor_busqueda(i, id_input){
    var op = $( "#operadores"+i ).val();
    var valor = $( '#'+id_input).val();

    if(valor != ''){
      if(op == '=' || op == '>' || op == '<' || op == '<>' || op == '<=' || op == '>=')
        valor =  op + valor;
      else if(op == '|'){
        var val_ini = $( '#valor_ini_'+i).val();
        var val_fin = $( '#valor_fin_'+i).val();
        val_ini = val_ini.trim();
        val_fin = val_fin.trim();
        if(val_ini != "" && val_fin != ""){
          valor = val_ini + "|" + val_fin;
        }else
          valor = "";
      }else if(op == 'IN'){
        valor = "IN("+valor+")";
      }

      return valor;
    }else{
      return "";
    }
    
  }
  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////


  //////////////////////////////////////////////////////////////////////////////////////////
  //////////// Funciones para el funcionamiento del formulario en ventana modal ////////////
  //////////////////////////////////////////////////////////////////////////////////////////

  /*function open_modal_to_add() {
    //limpiar_campos_modal();
    $("#modal_formulario").modal();
  }*/

  
  //Crear función que me traiga el formulario con los datos cada que le de clic en el botón Editar/ duplicar 
  function open_modal_to_edit(id_reg = 0, id_idioima = 0, duplicar = 0) {
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
    $('#id_reg_modal').val(id_reg);
    //$("#modal_formulario").modal("show")
    $('#modal_formulario').modal({
			focus: false
		});
  }

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
  //////////// Funciones para el funcionamiento de la columna de los checboxes  ////////////
  //////////////////////////////////////////////////////////////////////////////////////////
  
  // Handle click on "Select all" control
  $('#grid-select-all').on('click', function(){
      // Get all rows with search applied
      var table = $('#grid').DataTable();
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    // Handle click on checkbox to set state of "Select all" control
    $('#grid tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
          var el = $('#grid-select-all').get(0);
          // If "Select all" control is checked and has 'indeterminate' property
          if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
          }
      }
    });    

    function mostrar_botones_opciones_checkboxes(){
      var cont = 0;
      //Habilito si no hay checkboxes seleccionados
      $("input:checkbox[name='id[]']:checked").each(function() { 
        cont ++;      
        $('.checkbox_buttons').prop("disabled", false);
        return false;
      });

      //Deshabilito si no hay checkboxes seleccionados
      if(cont === 0)
        $('.checkbox_buttons').prop("disabled", true);
    }


    // Handle form submission event
    //$('#form_principal').on('submit', function(e){
    /*$("#delete_multiple").unbind('click').click(function(){
      var cont = 0;
      var cadena_ids = "";
      $("input:checkbox[name='id[]']:checked").each(function() {         
        cadena_ids += "<li>"+$(this).val()+"</li>";
        cont ++;
      });

      if(cont > 0){
        cadena_ids = "<ul>"+cadena_ids+"</ul>";
        eliminar_multiples_filas(cadena_ids);
      }
       
    });*/

    function eliminar_multiples_filas(cadena_ids = ''){

      var cont = 0;
      var cadena_ids = "";
      $("input:checkbox[name='id[]']:checked").each(function() {         
        cadena_ids += "<li>"+$(this).val()+"</li>";
        cont ++;
      });

      if(cont > 0){
        cadena_ids = "<ul>"+cadena_ids+"</ul>";
        //eliminar_multiple_multiples_filas(cadena_ids);

        BootstrapDialog.show({
          title: '¡Advertencia!',
          message: '¿Está seguro de eliminar los(las) <?php echo $_smarty_tpl->tpl_vars['nomplural']->value;?>
 con los siguientes ID? <br>'+cadena_ids,
          type: BootstrapDialog.TYPE_WARNING,
          buttons: [{
            icon: 'glyphicon glyphicon-trash',
            label: ' Eliminar',
            cssClass: 'btn-warning',
            action: function(dialogItself){
              var formData = $('#form_principal').serialize();
              $.ajax({
                  data:  formData,
                  //url:   path+'/eliminar/'+id,
                  url:   "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/eliminar_multiples_filas",
                  type:  'post',
                  scriptCharset:"utf-8",
                  dataType: "json",
                  beforeSend: function () {
                    //$("#mensaje").html('Guardando...');
                  },
                  error: function(xhr) {
                        //alert("Error al eliminar: "+ xhr.statusText +": " + xhr.responseText);
                    modal_danger("Error en respuesta","Ocurrió un error al eliminar <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
                    },
                  complete: function() {
                        //$(placeholder).removeClass('loading');
                        //alert("completo");
                    },
                  success:  function (response) {
                      if(response.status==1){
                        //var oTable = $('#grid').dataTable();
                        //oTable.fnDeleteRow( "#fila_id_"+id);
                        //$("#fila_id_"+id).remove();
                        traer_conceptos();
                        cuadrodialogoExito("Mensaje", '<i class="far fa-check-circle fa-2x pr-2" style="color: #4caf50;"></i> Los registros se eliminaron con éxito ', "Aceptar");
                      }else{
                        modal_danger("Error","Ocurrió un error al eliminar   <br/> Error: ("+response.msg, "Aceptar");
                    }
                  }

              });       
              dialogItself.close();
              //window.location="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
menu/eliminar/" + id;
            }
          }, {
            label: 'Cancelar',
            action: function(dialogItself){
              dialogItself.close();
            }
          }]
        });
      }else{
        alert("Seleccione por lo menos una fila");
      }
    }

    $(document).ready(function() { 

      function cambiar_estatus_multiples_filas(idBtn){

        var formData = $('#form_principal').serialize();
        $.ajax({
            data:  formData + "&idbtn="+idBtn,
            //url:   path+'/eliminar/'+id,
            url:   "<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/cambiar_estatus_multiples_filas",
            type:  'post',
            scriptCharset:"utf-8",
            dataType: "json",
            beforeSend: function () {
              //$("#mensaje").html('Guardando...');
            },
            error: function(xhr) {
                  //alert("Error al eliminar: "+ xhr.statusText +": " + xhr.responseText);
              modal_danger("Error en respuesta","Ocurrió un error al actualizar <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
              },
            complete: function() {
                  //$(placeholder).removeClass('loading');
                  //alert("completo");
              },
            success:  function (response) {
                if(response.status==1){
                  traer_conceptos();
                  cuadrodialogoExito("Mensaje", '<i class="far fa-check-circle fa-2x pr-2" style="color: #4caf50;"></i> El cambio de estatus se realizó correctamente ', "Aceptar");
                }else{
                  modal_danger("Error","Ocurrió un error <br/> Error: ("+response.msg, "Aceptar");
              }
            }
        });       
      
      }
      
      //=========Botones de acciones para los Checkbox=========
      <?php if (isset($_smarty_tpl->tpl_vars['checkbox_column']->value['buttons'])){?> 
        <?php  $_smarty_tpl->tpl_vars['btn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['btn']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checkbox_column']->value['buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['btn']->key => $_smarty_tpl->tpl_vars['btn']->value){
$_smarty_tpl->tpl_vars['btn']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['btn']->key;
?>
          <?php if (is_array($_smarty_tpl->tpl_vars['btn']->value)){?>
            <?php if (!empty($_smarty_tpl->tpl_vars['btn']->value['url'])){?>
              document.getElementById("<?php echo $_smarty_tpl->tpl_vars['btn']->value['id'];?>
").addEventListener("click", function_<?php echo $_smarty_tpl->tpl_vars['btn']->value['id'];?>
);

              function function_<?php echo $_smarty_tpl->tpl_vars['btn']->value['id'];?>
(){
                //alert("elele <?php echo $_smarty_tpl->tpl_vars['btn']->value['id'];?>
")
                form=document.getElementById('form_principal');
                form.target='_blank';
                form.action="<?php echo $_smarty_tpl->tpl_vars['btn']->value['url'];?>
";
                form.submit();
              }
            <?php }?>

            <?php if (!empty($_smarty_tpl->tpl_vars['btn']->value['onclick'])){?>
              document.getElementById("<?php echo $_smarty_tpl->tpl_vars['btn']->value['id'];?>
").addEventListener("click", function() {
                <?php echo $_smarty_tpl->tpl_vars['btn']->value['onclick'];?>
("<?php echo $_smarty_tpl->tpl_vars['btn']->value['id'];?>
");
              });
            <?php }?>
          <?php }?>
        <?php } ?>
      <?php }?>

    } ); // fin de $(document).ready


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