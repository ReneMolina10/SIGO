<?php /* Smarty version Smarty-3.1.8, created on 2025-07-08 08:15:41
         compiled from "views\generators\tabla.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1532245450686c2e8537a956-81620274%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5053473b3a0cb98ade7fa36f8431900b4225662' => 
    array (
      0 => 'views\\generators\\tabla.tpl',
      1 => 1751955339,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1532245450686c2e8537a956-81620274',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_686c2e853a4844_60591503',
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
    'bPaginate' => 0,
    'bFilter' => 0,
    'bInfo' => 0,
    'c' => 0,
    'mostrarTfoot' => 0,
    'key' => 0,
    '_layoutParams' => 0,
    'controlador' => 0,
    'nomplural' => 0,
    'btn' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_686c2e853a4844_60591503')) {function content_686c2e853a4844_60591503($_smarty_tpl) {?>  
  

  <?php $_smarty_tpl->tpl_vars["tableId"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tableId']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["columnas"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['columnas']->value)===null||$tmp==='' ? array() : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["rutaBuscar"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['rutaBuscar']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["name_crud_table"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['name_crud_table']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["parentId"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['parentId']->value)===null||$tmp==='' ? '' : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["tablaResponsiva"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tablaResponsiva']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["tablaScrollX"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tablaScrollX']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["checkbox_column"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['checkbox_column']->value)===null||$tmp==='' ? 'false' : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["bPaginate"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['bPaginate']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["bFilter"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['bFilter']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["bInfo"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['bInfo']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>


  <?php if (count($_smarty_tpl->tpl_vars['columnas']->value)>0){?> 

    <?php if (!$_smarty_tpl->tpl_vars['tableId']->value||!$_smarty_tpl->tpl_vars['columnas']->value){?>
      <div class="alert alert-warning">
        Error en tabla.tpl: faltan <code>tableId</code> o <code>columnas</code>.
      </div>
    <?php }else{ ?>

    <form class="bs-example bs-example-form" enctype="multipart/form-data" id="form_principal" name="form_principal" action="" method="post"> 
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
        <?php if ($_smarty_tpl->tpl_vars['mostrarTfoot']->value){?>
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
        <?php }?>
      </table>
    </form>


    <script>
    (function($){
      
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
        //document.getElementById("formf").innerHTML = "";
        var el = document.getElementById("formf");
        if (el) el.innerHTML = "";
        $('#' + tableId).dataTable().fnDestroy();
        $('#' + tableId + '-select-all').prop("checked", false);

        var table = $('#' + tableId).DataTable({
          "bPaginate": <?php if ($_smarty_tpl->tpl_vars['bPaginate']->value===false||$_smarty_tpl->tpl_vars['bPaginate']->value==='false'){?>false<?php }else{ ?>true<?php }?>,
          "bLengthChange":   true,
          "bFilter":   <?php if ($_smarty_tpl->tpl_vars['bFilter']->value===false||$_smarty_tpl->tpl_vars['bFilter']->value==='false'){?>false<?php }else{ ?>true<?php }?>,
          "bSort":           true,
          "bInfo":     <?php if ($_smarty_tpl->tpl_vars['bInfo']->value===false||$_smarty_tpl->tpl_vars['bInfo']->value==='false'){?>false<?php }else{ ?>true<?php }?>,
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

      window.traer_conceptos = traer_conceptos;

      // 4) ¡y aquí la llamamos de inmediato!
      traer_conceptos();
    })(jQuery);


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
      //////////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////////////////////////////////////////////////////////////

      


    </script>
    <?php }?>
  <?php }else{ ?>
    <table    class="table-sm" style="width:100%; color: #757575;"> 
      <tbody> 
        <tr>            
          <th>No hay registros </th>
        </tr>         
      </tbody>
    </table>
  <?php }?><?php }} ?>