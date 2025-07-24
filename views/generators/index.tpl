<style type="text/css">

  {$csseditar|default:""}

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
    <h3 style="margin:0px;  text-transform: uppercase;" class="card-title"> {$nomplural}</h3>  
    <div class="card-tools no-print"> 

        <div class="btn-group" role="group">
            {$bd.htmlSup|default:''}
        </div>


      {if $smarty.get.ocultar|default:'' != 1}
        <a href="{$urlbarra|default:{$_layoutParams.root}}" class="btn btn-sm btn-link">Regresar</a>
      {/if}

      {if isset($graficas) && $graficas != '' }
        {if count($graficas)>0 }
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary bg-purple dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chart-pie"></i> Graficas</button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
              {foreach key=key item=fila from=$graficas}
                <a class="dropdown-item " href="javascript:open_modal_graficas({$key}, '{$fila.titulo}')" alt="" text="" target="_self">{$fila.titulo}</a>
              {/foreach}
            </div>
          </div>            
        {/if}
      {/if}

      {if isset($reports) && $reports != '' }
        {if count($reports)>0 }
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              {foreach key=key item=fila from=$reports}
                {if $fila.sql}
                  <a class="dropdown-item" href="{$_layoutParams.root}{$controlador}/reporte/{$key}/" target="_blank">{$fila.name}</a>
                {elseif $fila.url }
                  <a class="dropdown-item" href="{$fila.url}{if $fila.idfiltro}{$filtro}{/if}" target="_self">{$fila.name}</a>
                {/if}
              {/foreach}
            </div>
          </div>
        
        {/if}
      {/if} 


      {if isset($template.btnsExtras) && $template.btnsExtras != '' }
        {if count($template.btnsExtras)>0 }
          {foreach key=key item=fila from=$template.btnsExtras}
            <a class="btn btn-sm {$fila.class|default:'btn-default'}" href="{$fila.href|default:'#'}" target="{$fila.target|default:'_self'}"> {$fila.label} </a>
          {/foreach}
        {/if}
      {/if} 


      {include file="views/generators/btn_registrar.tpl"
        urlAgregar     = "{$_layoutParams.root}{$controlador}/editar/0/0/0/{$filtro|default:''}"
        esModal        = ($template.editForm == 'modal')
        nSingular      = $nomsingular
        ocultarAgregar = $bd.ocultarBtnAgregar|default:'false'
      }





    </div>                               
  </div>

  <div class="card-body ">


 {if $template.displayInfo.mode|default:'' == "sortlist"  }


  
    <div id="sort_content">
      



       <form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formlista" name="formlista" action="javascript:guardar()" method="post">

<!-- Listas arrastrables  -->
        <div class="dd" id="nestable">
            <ol class="dd-list"  id="contenido_list">
            x
            </ol>           
        </div>
        
        <p>
            <input type="hidden" id="ididioma" name="ididioma" value="{$ididioma|default:""}"/>
            <input type="hidden" id="idgrupo" name="idgrupo" value="{$idgrupo|default:""}"/>

      <a href="https://virtual.uqroo.mx/miportal/ovas/" type="button" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
                Regresar al listado
            </a>

            <button type="submit" class="btn btn-primary">Guardar ordenamiento</button> 
<!--
            <a href="{$_layoutParams.root}unidades" type="submit"  id="guardarsalir" class="btn btn-success">Guardar y salir *</a>

        --> 
      
        </p>

    <input type="hidden" id="nestable-output" name="nestable-output" />
        </form>





    </div>

  
  {else}



       
        {include file="views/generators/tabla.tpl"
          tableId         = "tbl_grid"
          columnas        = $columnas
          rutaBuscar      = "{$_layoutParams.root}{$controlador}/buscar/{$filtro}"
          name_crud_table = 'grid'
          parentId        = $filtro
          tablaResponsiva = "{$tablaResponsiva|default:true}"
          tablaScrollX    = "{$tablaScrollX|default:false}" 
          checkbox_column = "{$bd.checkbox_column|default:false}"
        }
      
      

      {if $smarty.get.ocultar|default:'' != 1}
          <div class="row no-print">              
              <div class="col-md-12">
                
                  <div style="text-align: center;" class="mt-2">
                  {if isset($checkbox_column.buttons)} 
                    {foreach key=key item=btn from=$checkbox_column.buttons}                    
                      {if is_array($btn) }
                        <button type="button" id="{$btn.id}" class="btn checkbox_buttons {$btn.class|default:'btn-default'}" disabled>{$btn.label}</button>
                      {/if}
                    {/foreach}
                  {/if}
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
        {/if}


      {/if}
      
  </div>
</div>
{literal}
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
{/literal}


<div class="col-sm-8 col-md-6">

</div>


<!-- ================================ MODALES ========================= -->
{include file="views/generators/ventanas_modal.tpl"}


<div id="divLoading"> </div> 


<script>

  



 {if $template.displayInfo.mode|default:'' == "sortlist"  }

      // alert("Ok");

          $.ajax({
            data:  'id_reg='+id_reg,
            url:   "{$_layoutParams.root}{$controlador}/infosort/{$filtro}",
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




   {else}
 
        

  {/if}


 
  

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
    eliminar_reg_generator('{$_layoutParams.root}{$controlador}',id,'{$nomsingular} ');
  }*/
   
  /*$("#txtbuscar").on('keyup', function (e) {
    if (e.keyCode == 13) {
      buscar('{$_layoutParams.root}{$controlador}')
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
    $("#tit_modal_edit").html('<i class="fas fa-pencil-alt"></i> Registrar {$nomsingular}');
    $("#btnguardar").show();
    //var id_reg_modal = $("#modal_formulario").val(); 
    //if(id_reg_modal != id_reg){
      //limpiar_campos_modal();
      $.ajax({
              data:  'id_reg='+id_reg+'&id_idioima='+id_idioima+'&duplicar='+duplicar,
              url:   "{$_layoutParams.root}{$controlador}/editar_modal/{$filtro|default:''}",
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
    $("#tit_modal_edit").html('<i class="fas fa-file-alt"></i> Detalle de {$nomsingular}');   
    $("#btnguardar").hide();                     
    //var id_reg_modal = $("#modal_formulario").val(); 
    //if(id_reg_modal != id_reg){
    //limpiar_campos_modal();
    $.ajax({
            data:  'id_reg='+id_reg,
            url:   "{$_layoutParams.root}{$controlador}/detalles_modal",
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
            url:   "{$_layoutParams.root}{$controlador}/grafica_modal",
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
    return colors.map(color => opacity ? `{literal}${color + opacity}`{/literal} : color)
  }

  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////



</script>

<!--<script  src="{$_layoutParams.root}public/js/app.js" type="text/javascript"></script>-->

 {if $template.displayInfo.mode|default:'' == "sortlist"  }
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
                url:   '{$_layoutParams.root}{$controlador}/guardarStatus/',
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
                url:   '{$_layoutParams.root}{$controlador}/guardarOrdenEtiquetas/',
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
              message: "El ordenamiento de items del menú {$nombreMenu} se ha actualizado. ",
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
                              window.location="{$_layoutParams.root}{$controlador}/listar/";
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
            url:   '{$_layoutParams.root}{$controlador}/eliminar/',
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

 {/if}
