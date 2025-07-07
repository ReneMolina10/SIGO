<?php /* Smarty version Smarty-3.1.8, created on 2025-07-06 14:55:29
         compiled from "/opt/sitios/sigo/views/generators/tabla.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1147931491686ac6a1127cd9-46844578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b97f36136dcb6d9653c06a172ed1438dbbee7242' => 
    array (
      0 => '/opt/sitios/sigo/views/generators/tabla.tpl',
      1 => 1751828072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1147931491686ac6a1127cd9-46844578',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tableId' => 0,
    'columnas' => 0,
    'rutaBuscar' => 0,
    'name_crud_table' => 0,
    'parentId' => 0,
    'tablaResponsiva' => 0,
    'tablaScrollX' => 0,
    'checkbox_column' => 0,
    'c' => 0,
    'key' => 0,
    '_layoutParams' => 0,
    'controlador' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_686ac6a1156030_44071578',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_686ac6a1156030_44071578')) {function content_686ac6a1156030_44071578($_smarty_tpl) {?>


<?php $_smarty_tpl->tpl_vars["tableId"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tableId']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["columnas"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['columnas']->value)===null||$tmp==='' ? array() : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["rutaBuscar"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['rutaBuscar']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["name_crud_table"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['name_crud_table']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["parentId"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['parentId']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["tablaResponsiva"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tablaResponsiva']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["tablaScrollX"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tablaScrollX']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["checkbox_column"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['checkbox_column']->value)===null||$tmp==='' ? 'false' : $tmp), null, 0);?>


<?php if (!$_smarty_tpl->tpl_vars['tableId']->value||!$_smarty_tpl->tpl_vars['columnas']->value){?>
  <div class="alert alert-warning">
    Error en tabla.tpl: faltan <code>tableId</code> o <code>columnas</code>.
  </div>
<?php }else{ ?>
<p>esowi djowie fwiof o</p>

<table id="<?php echo $_smarty_tpl->tpl_vars['tableId']->value;?>
" class="stripe hover order-column table-sm cell-border compact" style="width:100%">
  <thead>
    <tr>
      <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columnas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
        <th><?php echo $_smarty_tpl->tpl_vars['c']->value['titulo'];?>
</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody></tbody>
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


<script>
(function($){
   console.log('>> tabla.tpl IIFE ejecutado para', tableId);
   // Variables con valores por defecto si no se pasan en el include
    var tableId          = '<?php echo (($tmp = @$_smarty_tpl->tpl_vars['tableId']->value)===null||$tmp==='' ? "tbl_default" : $tmp);?>
',
        rutaBuscar       = '<?php echo (($tmp = @$_smarty_tpl->tpl_vars['rutaBuscar']->value)===null||$tmp==='' ? '' : $tmp);?>
',
        name_crud_table  = '<?php echo (($tmp = @$_smarty_tpl->tpl_vars['name_crud_table']->value)===null||$tmp==='' ? '' : $tmp);?>
',
        tablaResponsiva  = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['tablaResponsiva']->value)===null||$tmp==='' ? true : $tmp);?>
,
        tablaScrollX     = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['tablaScrollX']->value)===null||$tmp==='' ? false : $tmp);?>
,
        checkbox_column  = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['checkbox_column']->value)===null||$tmp==='' ? false : $tmp);?>
;
      
     

  function traer_conceptos(){
    document.getElementById("formf").innerHTML = "";
    $('#' + tableId).dataTable().fnDestroy();
    $('#' + tableId + '-select-all').prop("checked", false);

    var table = $('#' + tableId).DataTable({
      "bPaginate":       true,
      "bLengthChange":   true,
      "bFilter":         true,
      "bSort":           true,
      "bInfo":           true,
      "bAutoWidth":      true,
      "processing":      true,
      "autoWidth":       true,
      "serverSide":      true,
      "serverMethod":    'post',
      "ajax": {
        'type': 'POST',
        "url": rutaBuscar,
        data: function(d) {
          //d.nivel = nivel;
          d.name_crud_table = name_crud_table; 
        },
        beforeSend: function(){
          $("div#divLoading").addClass('show');
          $("#btnf").prop("disabled", true).val('Espere un momento por favor...');
        },
        complete: function(){
          $("div#divLoading").removeClass('show');
          $("#btnf").prop("disabled", false).val('Filtrar');
          mostrar_botones_opciones_checkboxes();
          $('input:checkbox[name="id[]"]').click(mostrar_botones_opciones_checkboxes);
          $('input:checkbox[name=select_all]').click(mostrar_botones_opciones_checkboxes);
        },
        error: function(){
          $("div#divLoading").removeClass('show');
          modal_danger("Error","Ha ocurrido un error","Aceptar");
        }
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
          "name":      "<?php echo $_smarty_tpl->tpl_vars['c']->value['campo'];?>
",
          "targets":   <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
,
          "className": "<?php echo (($tmp = @$_smarty_tpl->tpl_vars['c']->value['class'])===null||$tmp==='' ? '' : $tmp);?>
",
          "search":    false,
          <?php if ($_smarty_tpl->tpl_vars['c']->value['tipo']=='data'){?>
            <?php if (isset($_smarty_tpl->tpl_vars['c']->value['width'])&&$_smarty_tpl->tpl_vars['c']->value['width']!=''){?>"width": "<?php echo $_smarty_tpl->tpl_vars['c']->value['width'];?>
",<?php }?>
            "orderable": true
          <?php }elseif($_smarty_tpl->tpl_vars['c']->value['tipo']=='checkbox_column'){?>
            "width":      "5%",
            "searchable": false,
            "orderable":  false,
            "className":  "dt-body-center",
            "render": function(data){
              return '<input type="checkbox" name="id[]" value="'+$('<div/>').text(data).html()+'">';
            }
          <?php }elseif($_smarty_tpl->tpl_vars['c']->value['tipo']=='opciones'){?>
            "width":     "5%",
            "orderable": false,
            "className": "text-center"
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
      "scrollX":    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['tablaScrollX']->value)===null||$tmp==='' ? false : $tmp);?>
,
      "initComplete": function(settings,json){
        $('#' + tableId + '_filter input').unbind().bind('keyup', function(e){
          if (e.keyCode == 13) table.search(this.value).draw();
        });
      },
      "fixedHeader": true,
      "lengthMenu":  [[10,25,50,100,-1],[10,25,50,100,"Todos"]]
    });

    table
      <?php if ($_smarty_tpl->tpl_vars['checkbox_column']->value==true){?>
        .order([1,'desc']);
      <?php }else{ ?>
        .order([0,'desc']);
      <?php }?>

    set_search_boxes();

    $('#btnf').off('click').on('click', function(){
      table.draw();
    });
    $('#btnDescRes').off('click').on('click', function(){
      var params = table.ajax.params();
      window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/descargar_resultados?datos='+JSON.stringify(params);
    });
    $('#btnDescResScv').off('click').on('click', function(){
      var params = table.ajax.params();
      window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/descargar_resultados_csv?datos='+JSON.stringify(params);
    });
  }

  // Exponemos al global para que puedas llamarlo manualmente
  window.traer_conceptos = traer_conceptos;

  // **Este** es el disparador que sí funciona tanto en carga normal
  // como cuando se inyecta por AJAX y evalúas el <script> con $.globalEval:
  $(function(){
    traer_conceptos();
  });
})(jQuery);


</script>
<?php }?>
<?php }} ?>