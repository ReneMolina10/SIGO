<?php /* Smarty version Smarty-3.1.8, created on 2025-07-03 14:08:50
         compiled from "/opt/sitios/sigo/views/contrato/editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16018617596866c73282f851-05775880%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bd346bc8d140df50ad39546b1d114d84322883d' => 
    array (
      0 => '/opt/sitios/sigo/views/contrato/editar.tpl',
      1 => 1746638124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16018617596866c73282f851-05775880',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_layoutParams' => 0,
    'id' => 0,
    'dc' => 0,
    'clave' => 0,
    'clavenum' => 0,
    'anio' => 0,
    'numc' => 0,
    'tc' => 0,
    'cc' => 0,
    'ua' => 0,
    'uf' => 0,
    'ures' => 0,
    'infofechas' => 0,
    'numempl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6866c732853427_93794907',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6866c732853427_93794907')) {function content_6866c732853427_93794907($_smarty_tpl) {?><style type="text/css">
  input, select, .select2 {
    width: 100% !important;
  }

  .form-group {
    margin: 0 0 5px 0 !important;
  }
  #infoempl:empty {
    display: none;
  }
  #infoempl {
    margin-top: 15px;
  }
  
  /* Estado normal */
  .btn_orange {
    background-color: #ff8c00;  /* DarkOrange puro */
    border-color:     #e67e22;  /* Un poco más profundo */
    color:             #fff;
  }

  /* Hover y focus */
  .btn_orange:hover,
  .btn_orange:focus {
    background-color: #e67e22;
    border-color:     #d35400;
    color:            #fff;
    outline: none;
    box-shadow: none;
  }

  /* Pulsado (click) */
  .btn_orange:active,
  .btn_orange.active,
  .open > .dropdown-toggle.btn_orange {
    background-color: #d35400;  /* aún más oscuro para el “press” */
    border-color:     #c0392b;
    color:            #fff;
  }

  /* Evitar outline en focus/active si no quieres sombra */
  .btn_orange:focus,
  .btn_orange:active:focus {
    outline: none;
    box-shadow: none;
  }


</style>


<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edición del contrato</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
" >Salir</a></li>
              <!--<li class="breadcrumb-item active">General Form</li>-->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


<form id="form">

  <section style="clear: both;">
  <div class="row">
    <div class="col-md-8">
      <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
      <textarea id="contenido" name="contenido"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['TEXTO'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
    </div>

    <div class="col-md-4">
      <div class="card card-outline card-success">
        <div class="card-body pad">
          <div>
            <button type="button" class="btn btn-sm btn_orange" id="btn_crea" data-toggle="modal" data-target="#crearModal">
              <i class="fas fa-magic"></i> Plantilla
            </button>
            <button type="button" class="btn btn-info btn-sm" id="btn_prev">
              <i class="fas fa-eye"></i> Previsualizar
            </button>
            <button type="submit" class="btn btn-success btn-sm">
              <i class="fas fa-save"></i> Guardar
            </button>
            <span id="mensaje">.</span>
          </div>
        </div>
      </div>


      <div class="card card-outline card-success card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">
                General
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="tab" href="#tab_2" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
                Trabajador
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="tab" href="#tab_3" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">
                Montos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="tab" href="#tab_4" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">
                Funciones
              </a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">

            <!--======================================= tab_1 =========================================-->
            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
              <input type="hidden" name="clave" id="clave" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['clave']->value)===null||$tmp==='' ? '' : $tmp);?>
">
              <input type="hidden" name="clavenum" id="clavenum" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['clavenum']->value)===null||$tmp==='' ? '' : $tmp);?>
">
              <input type="hidden" name="anio" id="anio" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['anio']->value)===null||$tmp==='' ? '' : $tmp);?>
">
              <input type="hidden" name="numc" id="numc" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['numc']->value)===null||$tmp==='' ? '' : $tmp);?>
">

              <div class="form-group">
                <label for="tipoc">Tipo de contrato:</label>
                <select class="form-control select2bs4" id="tipoc" name="tipoc" onchange="visibles()">
                  <?php echo $_smarty_tpl->tpl_vars['tc']->value;?>

                </select>
              </div>

              <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select class="form-control select2bs4" id="categoria" name="categoria">
                  <?php echo $_smarty_tpl->tpl_vars['cc']->value;?>

                </select>
              </div>

              <div class="form-group">
                <label for="ua">Unidad Académica:</label>
                <select class="form-control select2bs4" id="ua" name="ua">
                  <?php echo $_smarty_tpl->tpl_vars['ua']->value;?>

                </select>
              </div>

              <div class="form-group">
                <label for="uf">Ubicación física:</label>
                <select class="form-control select2bs4" id="uf" name="uf">
                  <?php echo $_smarty_tpl->tpl_vars['uf']->value;?>

                </select>
              </div>

              <div class="form-group">
                <label for="ure">URE:</label>
                <select class="form-control select2bs4" id="ure" name="ure">
                  <?php echo $_smarty_tpl->tpl_vars['ures']->value;?>

                </select>
              </div>

              <div class="form-group">
                <label>Fecha de firma:</label>
                  <input name="fecha_firma" type="date" class="form-control" id="fecha_firma" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_FECHA_FIRMA'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['infofechas']->value['FI'] : $tmp);?>
">
              </div>

              <div class="form-group">
                <label>Inicio de vigencia:</label>
                <div class="input-group date" id="inicio_vigencia">
                  <input value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_FECHA_INICIO'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['infofechas']->value['FI'] : $tmp);?>
" type="date" class="form-control" id="inicio" name="inicio">
                </div>

                <div class="form-group">
                  <label>Fin de vigencia:</label>
                  <div class="input-group date" id="fin_vigencia">
                    <input value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_FECHA_FIN'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['infofechas']->value['FF'] : $tmp);?>
" type="date" class="form-control" id="fin" name="fin">
                  </div>
                </div>

                <div class="form-group">
                  <label>Fecha de Derogación:</label>
                    <input value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_FECHA_DERROGA'])===null||$tmp==='' ? '' : $tmp);?>
" type="date" class="form-control" id="fderoga" name="fderoga">
                </div>
              </div>
            </div>
            <!--======================================= tab_2 =========================================-->
            <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
              <div class="form-group">
                  <label for="numempl">Número de empleado:</label>
                    <select class="form-control " name="numempl" id="numempl" style="width:100%"></select>
                  <!--<div class="input-group input-group-sm">
                      <input type="text" class="form-control" name="numempl" id="numempl" value="<?php echo $_smarty_tpl->tpl_vars['numempl']->value;?>
" onchange="infoempl(this.value)">
                      <div class="input-group-append">  <button type="button" class="btn btn-info" id="btn_buscar_empleado" data-toggle="modal" data-target="#buscarModal">
                              <i class="fas fa-search"></i>  </button>
                      </div>
                  </div>-->
                  <div id="infoempl" class="callout callout-info"></div>
              </div>
            </div>

            <!--======================================= tab_3 =========================================-->
            <div class="tab-pane" id="tab_3">
              <div class="row sae">
                 <div class="col-md-6">
                    <!-- Número de quincenas -->
                    <div class="form-group">
                       <label>Qnas.:</label>
                       <input type="text" class="form-control" name="quincenas" id="quincenas" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_NUM_QUINCENAS'])===null||$tmp==='' ? "8" : $tmp);?>
">
                    </div>
                 </div>
                 <div class="col-md-6 sae">
                    <!-- Número de quincenas -->
                    <div class="form-group">
                       <label>Semanas.:</label>
                       <input type="text" class="form-control" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_NUM_SEMANAS'])===null||$tmp==='' ? "17" : $tmp);?>
" name="semanas" id="semanas">
                    </div>
                 </div>
              </div>
              <div class="row">
                 <div class="col-md-6 sae">
                    <label for="horas_semana ">Horas semana:</label>
                    <input type="text" class="form-control" name="horas_semana" id="horas_semana"  value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_NUM_HORAS_SEM'])===null||$tmp==='' ? '' : $tmp);?>
">
                 </div>
                 <div class="col-md-6 sae">
                    <label for="horas_semana ">Monto por hora:</label>
                    <input type="text" class="form-control" name="monto_hora" id="monto_hora"  value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_MONTO_HORA'])===null||$tmp==='' ? "0" : $tmp);?>
">
                 </div>
              </div>
              <div class="row">
                 <div class="col-md-12 sae" style="text-align: center;">
                    <a href="javascript:calcular()" style="    width: 100%; margin-top: 25px;" class="btn btn-success">Calcular</a>
                 </div>
              </div>
              <div style="    border-top: 1px solid #CCC;
                 margin-top: 21px;
                 margin-bottom: 15px;"></div>
              <div class="sae" >
                <label for="monto">Horas totales:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                  </div>
                  <input type="number" class="form-control" name="horas" id="horas"  value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_NUM_HORAS'])===null||$tmp==='' ? '' : $tmp);?>
">
                </div>
              </div>
              <div class="sae" >
                 <label for="monto">Monto quincenal:</label>
                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                  </div>
                  <input type="number" class="form-control" name="monto_quincenal" id="monto_quincenal" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_MONTO_QUINCENA'])===null||$tmp==='' ? '' : $tmp);?>
">
                 </div>
              </div>
              <div>
                 <label for="monto">Monto mensual:</label>
                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                  </div>
                  <input type="number" class="form-control" name="monto_mensual" id="monto_mensual" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_MONTO_MENSUAL'])===null||$tmp==='' ? '' : $tmp);?>
">
                 </div>
                 <label for="monto">Monto final:</label>
                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                  </div>
                  <input type="number" class="form-control" name="monto_final" id="monto_final" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_MONTO_FINAL'])===null||$tmp==='' ? '' : $tmp);?>
">
                 </div>
              </div>
              <div class=" sae">
                 <label for="monto">Monto total:</label>
                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                  </div>
                  <input type="number" class="form-control" name="monto" id="monto"  value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_MONTO_TOTAL'])===null||$tmp==='' ? '' : $tmp);?>
">
                 </div>
              </div>
            </div>

            <!--======================================= tab_4 =========================================-->
            <div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
              <div class="form-group">
                <label for="funciones">Funciones o materias que imparte:</label>
                <textarea style="height: 300px;" name="funciones" class="form-control"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['dc']->value['CNT_FUNCIONES'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!--======================================= MODAL PLANTILLA =========================================-->
<div class="modal fade" id="crearModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-orange" >
        <h5 class="modal-title  text-white">Crear cuerpo del contrato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="plantilla">Plantilla:</label>
            <select class="form-group form-control" id="plantilla" name="plantilla"></select>  
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="confirm_crea" class="btn btn_orange">Usar plantilla</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</form>

<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/ckeditor/ckeditor.js"></script>


<script>

  $(document).ready(function(){

    
    visibles();
    //var numEmpleado = $('#numempl').val() || '';
    var numEmpleado = '<?php echo $_smarty_tpl->tpl_vars['numempl']->value;?>
' || '';    
    infoempl(numEmpleado);
    obtener_empleado(numEmpleado); 

    $("#numempl").select2({
        language: 'es',
        theme: 'bootstrap4',
        placeholder: "Seleccione...",
        minimumInputLength: 1,
        ajax: { 
            url: '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
contrato/get_empleados/',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    palabra: params.term // Envía el término de búsqueda
                };
            },
            processResults: function (data) {
                // Asegúrate de que el servidor retorne los datos en el formato esperado, por ejemplo:
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $("#numempl").on("change", function(){
      var numEmpleado = $(this).val();
      // Llamas a la función deseada y le pasas el valor seleccionado
      infoempl(numEmpleado);
    });

    //Acción crear
    $("#confirm_crea").click(function() {
    //guardar();
    //$(this).close();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
contrato/crear/', // the url where we want to POST
            data        :  $( "form" ).serialize(), // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true,
            beforeSend: function () {
              $("#confirm_crea").html("Creando...");
              $( "#confirm_crea" ).prop( "disabled", true );
            }
        })
        .done(function(data) {
          //alert(data);
          CKEDITOR.instances["contenido"].setData(data.texto);
          $("#clave").val(data.uat);
          $("#clavenum").val(data.ua);
          $("#anio").val(data.anio);
          $("#numc").val(data.id);
          alert("Contrato creado");
          // log data to the console so we can see
          // console.log(data); 
        })
        .fail(function(jqXHR, textStatus ) {
          alert( "Error al crear: " +jqXHR.responseText);
        })
        .always(function() {
          $("#confirm_crea").html("Crear");
          $("#confirm_crea" ).prop( "disabled", false );
          $(function () {
             $('#crearModal').modal('toggle');
          });
        });
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

    $('#form').on('submit', function(e){
      e.preventDefault();   // evita que el formulario se envíe de verdad
      guardar();            // tu función JS
    });

    //Acción prisualizar
    $("#btn_prev").click(function() {
      window.open('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
contrato/pdf/' + $("#clave").val() + '-'+ $("#anio").val() +'-'+ $("#numc").val() +'/' ,'_blank');
    });

       

  });
  banderaSelectGenerator = true;

  /*function miFuncion(valor) {
    console.log("Se ha seleccionado la opción con valor: " + valor);
    // Aquí puedes colocar la lógica que necesites ejecutar
  }*/

  function infoempl(numempl){
    //console.log(numempl);
    $.ajax({
      type: 'POST',
      url: '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
contrato/infoempl/',
      data: { numempl: numempl },
      dataType: 'html',
      cache: false
    })
    .done(function(data){
      var $panel = $('#infoempl');
      if ($.trim(data)) {
        $panel.fadeOut(200)    // oculta con animación
              .html(data)      // actualiza contenido mientras está oculto
              .fadeIn(200);    // vuelve a mostrar con animación
      } else {
        $panel.hide();
      }
    })
    .fail(function(xhr, status, err){
      console.error("Error AJAX:", status, err);
    });
  }

  function getPlantillas(){
        $.ajax({
            type        : 'POST', 
            url         : '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
contrato/getPlantillas/'+ $("#tipoc").val(), 
            encode          : true
        })
      .done(function(data) {  
            $("#plantilla").html(data);
        })
  }

  function visibles(){
      let tipos_de_contratos = [ '2', '3', '4', '5', '6', '10', '11'],
          tipo_contrato      = $( "#tipoc" ).val();
      $('.sae').hide();
      if( tipos_de_contratos.includes( tipo_contrato ) ) 
        $('.sae').show();
      getPlantillas();
  }

  function guardar()
  {
          $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
contrato/guardar/', // the url where we want to POST
            data        :  $("form").serialize()+'&contenido='+encodeURIComponent(CKEDITOR.instances.contenido.getData()), // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true,
            beforeSend: function () {
                       // $("#resultado").html("Procesando, espere por favor...");
            $("#mensaje").show(); 
            $("#mensaje").html("Guardando...");
                }
        })
        .done(function(data) {                          
              $("#mensaje").html("Guardado");
              $("#mensaje").delay( 3000 ).hide(1000);
              $("#clave").val(data.uat);
              $("#clavenum").val(data.ua);
              $("#anio").val(data.anio);
              $("#numc").val(data.id);
                // log data to the console so we can see
                // console.log(data); 
        })
        .fail(function(xhr, status, error) {
            alert("Error al guardar: "+xhr.responseText);
            $("#mensaje").html("");
        })
            /*
        .always(function() {
          alert( "finished" );
        })*/
            ;
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
  }

  function calcular(){
    let totalHoras = $("#horas_semana").val() * $("#semanas").val() ; 
    let montoTotal = totalHoras * $("#monto_hora").val() ; 
    let montoQna = montoTotal / $("#quincenas").val();
    let montoMes = montoQna * 2;
    $("#horas").val( totalHoras );
    $("#monto_quincenal").val( montoQna );
    $("#monto_mensual").val( montoMes );
    $("#monto").val( montoTotal );
    //$("#monto_hora").val()
    alert('Montos calculados');    
  }


  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.

    
    CKEDITOR.replace(
      'contenido', {
        allowedContent:true,
        height: '350',
        toolbar: [
          { name: 'document', items: [ 'Source', '-', 'Save', 'Preview', 'Print', '-', 'Templates' ] },
          { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
          { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
          { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
          { name: 'paragraph', items: [ 'NumberedList', 'BulletedList','-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Language' ] },
          { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
          { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
          { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
          { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        ],
      basicEntities: false,
      
      contentsCss: [ '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
/plugins/ckeditor/document/contents.css', '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
/plugins/ckeditor/document/mystyles.css' ],
      bodyClass: 'document-editor',
    });
    //bootstrap WYSIHTML5 - text editor
    //$(".textarea").wysihtml5();
  });

  function obtener_empleado(numempl){	
    $.ajax({
      data: { numempl: numempl },
      url: '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
contrato/get_empleado/',
      type:  'post',
      scriptCharset:"utf-8",
      dataType: "json",
      beforeSend: function () {
        $("div#divLoading").addClass('show');
      },
      error: function(xhr) {
        //cuadrodialogo("Error en respuesta","No se pudo cargar catÃ¡logo <b>"+catalogo+"</b> <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
        //$("#"+campo).html('Error al buscar lugar:'+xhr.statusText +' ' +xhr.responseText);
        },
      complete: function() {
        $("div#divLoading").removeClass('show');
        },
      success:  function (response) {
          if(response.status==1){
            //var cad = '<option value="0" selected>'+holder+'</option>'+response.info;
          //$("#camposearch_"+campo).html(response.info);

          var newOption = new Option(response.text, response.id, false, false);
          $("#numempl").append(newOption).trigger('change');

          }else{
          //cuadrodialogo(response.id+"Error","No se pudo cargar catÃ¡logo <b>"+catalogo+"</b> Error: "+response.msg, "Aceptar");
          //$("#"+campo).html('Lugar NO encontrado');
        }
      }
    });		
  }
  
  


</script> <?php }} ?>