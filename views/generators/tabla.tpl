  {* views/generators/components/tabla.tpl *}
  {*
    Variables recibidas (todas opcionales salvo `columnas`):
    - tableId          : ID del <table> (string)
    - columnas         : array de definición de columnas
    - rutaBuscar       : URL AJAX para buscar (string)
    - name_crud_table  : clave del sub-Generator (string)
    - parentId         : ID del registro padre (string o número)
    - tablaResponsiva  : booleano para responsive (default: true)
    - tablaScrollX     : booleano para scrollX     (default: false)
  *}

  {assign var="tableId"         value=$tableId|default:''}
  {assign var="columnas"        value=$columnas|default:[]}
  {assign var="rutaBuscar"      value=$rutaBuscar|default:''}
  {assign var="name_crud_table" value=$name_crud_table|default:''}
  {assign var="parentId"        value=$parentId|default:''}
  {assign var="tablaResponsiva" value=$tablaResponsiva|default:true}
  {assign var="tablaScrollX"    value=$tablaScrollX|default:false}
  {assign var="checkbox_column" value=$checkbox_column|default:'false'}
  {assign var="bPaginate"       value=$bPaginate|default:true}
  {assign var="bFilter"         value=$bFilter|default:true}
  {assign var="bInfo"           value=$bInfo|default:true}


  {if count($columnas)>0 } 

    {if !$tableId || !$columnas}
      <div class="alert alert-warning">
        Error en tabla.tpl: faltan <code>tableId</code> o <code>columnas</code>.
      </div>
    {else}

    <form class="bs-example bs-example-form" enctype="multipart/form-data" id="form_principal" name="form_principal" action="" method="post"> 
      <table id="{$tableId}" class="stripe hover order-column table-sm cell-border compact" style="width:100%">
        <thead>
          <tr>
            {foreach from=$columnas item=c}
              <th>{$c.titulo}</th>
            {/foreach}
          </tr>
        </thead>
        <tbody></tbody>
        {if $mostrarTfoot}
        <tfoot>
          <tr>
              {foreach key=key item=c from=$columnas}
                  {if $c.tipo eq 'checkbox_column' }  
                      <th id="thfoot_{$key}"></th>
                  {else}
                      <th id="thfoot_{$key}">{$c.titulo}</th>
                  {/if}                    
              {/foreach}
          </tr>
        </tfoot>
        {/if}
      </table>
    </form>


    <script>
    (function($){
      
      // Variables con valores por defecto si no se pasan en el include
        var tableId          = '{$tableId|default:"tbl_default"}',
            rutaBuscar       = '{$rutaBuscar|default:""}',
            name_crud_table  = '{$name_crud_table|default:""}',
            tablaResponsiva  = {$tablaResponsiva|default:true},
            tablaScrollX     = {$tablaScrollX|default:false},
            checkbox_column  = {$checkbox_column|default:false};
          

      function traer_conceptos(){
        //document.getElementById("formf").innerHTML = "";
        var el = document.getElementById("formf");
        if (el) el.innerHTML = "";
        $('#' + tableId).dataTable().fnDestroy();
        $('#' + tableId + '-select-all').prop("checked", false);

        var table = $('#' + tableId).DataTable({
          "bPaginate":        {if $bPaginate === false || $bPaginate === 'false'}false{else}true{/if},
          "bLengthChange":    true,
          "bFilter":          {if $bFilter === false || $bFilter === 'false'}false{else}true{/if},
          "bSort":            true,
          "bInfo":            {if $bInfo === false || $bInfo === 'false'}false{else}true{/if},
          "bAutoWidth":       true,
          "processing":       true,
          "autoWidth":        true,
          "serverSide":       true,
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
            {foreach key=key item=c from=$columnas}
              { "data": "{$c.campo}" },
            {/foreach}
          ],
          "columnDefs": [
            {foreach item=c key=key from=$columnas}
            {
              "name":      "{$c.campo}",
              "targets":   {$key},
              "className": "{$c.class|default:''}",
              "search":    false,
              {if $c.tipo eq 'data'}
                {if isset($c.width) && $c.width != ''}"width": "{$c.width}",{/if}
                "orderable": true
              {elseif $c.tipo eq 'checkbox_column'}
                "width":      "5%",
                "searchable": false,
                "orderable":  false,
                "className":  "dt-body-center",
                "render": function(data){
                  return '<input type="checkbox" name="id[]" value="'+$('<div/>').text(data).html()+'">';
                }
              {elseif $c.tipo eq 'opciones'}
                "width":     "5%",
                "orderable": false,
                "className": "text-center"
              {/if}
            },
            {/foreach}
          ],
          "language": {
            "url": "{$_layoutParams.ruta_view}/plugins/datatables_1.10.21/language/Spanish.json"
          },
          "responsive": {$tablaResponsiva|default:true},
          "scrollX":    {$tablaScrollX|default:false},
          "initComplete": function(settings,json){
            $('#' + tableId + '_filter input').unbind().bind('keyup', function(e){
              if (e.keyCode == 13) table.search(this.value).draw();
            });
          },
          "fixedHeader": true,
          "lengthMenu":  [[10,25,50,100,-1],[10,25,50,100,"Todos"]]
        });

        table
          {if $checkbox_column eq true}
            .order([1,'desc']);
          {else}
            .order([0,'desc']);
          {/if}

        set_search_boxes();

        $('#btnf').off('click').on('click', function(){
          table.draw();
        });
        $('#btnDescRes').off('click').on('click', function(){
          var params = table.ajax.params();
          window.location.href = '{$_layoutParams.root}{$controlador}/descargar_resultados?datos='+JSON.stringify(params);
        });
        $('#btnDescResScv').off('click').on('click', function(){
          var params = table.ajax.params();
          window.location.href = '{$_layoutParams.root}{$controlador}/descargar_resultados_csv?datos='+JSON.stringify(params);
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
          searchCols = [{foreach key=key item=c from=$columnas}{if $c.tipo eq 'data' }true, {else}false, {/if}{/foreach}];
          nameCols = [{foreach key=key item=c from=$columnas}"{$c.campo}", {/foreach}];
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
            message: '¿Está seguro de eliminar los(las) {$nomplural} con los siguientes ID? <br>'+cadena_ids,
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
                    url:   "{$_layoutParams.root}{$controlador}/eliminar_multiples_filas",
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
                //window.location="{$_layoutParams.root}menu/eliminar/" + id;
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
              url:   "{$_layoutParams.root}{$controlador}/cambiar_estatus_multiples_filas",
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
        {if isset($checkbox_column.buttons)} 
          {foreach key=key item=btn from=$checkbox_column.buttons}
            {if is_array($btn) }
              {if !empty($btn.url) }
                document.getElementById("{$btn.id}").addEventListener("click", function_{$btn.id});

                function function_{$btn.id}(){
                  //alert("elele {$btn.id}")
                  form=document.getElementById('form_principal');
                  form.target='_blank';
                  form.action="{$btn.url}";
                  form.submit();
                }
              {/if}

              {if !empty($btn.onclick) }
                document.getElementById("{$btn.id}").addEventListener("click", function() {
                  {$btn.onclick}("{$btn.id}");
                });
              {/if}
            {/if}
          {/foreach}
        {/if}

      } ); // fin de $(document).ready

      //////////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////////////////////////////////////////////////////////////
      //////////////////////////////////////////////////////////////////////////////////////////

      


    </script>
    {/if}
  {else}
    <table    class="table-sm" style="width:100%; color: #757575;"> 
      <tbody> 
        <tr>            
          <th>No hay registros </th>
        </tr>         
      </tbody>
    </table>
  {/if}