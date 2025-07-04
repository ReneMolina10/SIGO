
<script>


</script>

<style type="text/css">
  .card-title {
    font-size: 1.75rem;
  }
 .content{
       padding-top: 15px!important;
 }
</style>


  <div class="card">
    <div class="card-header border-0">
        <h3 class="card-title"> Importar {$nomplural} </h3>
        <div class="card-tools"> 
          <button type="button" class="btn btn-success bg-gradient-success" onclick="ver_resumen()"><i class="far fa-file-excel"></i> Descargar formato</button>
        </div>
        <!--<a class="btn btn-success" href="{$_layoutParams.root}/" target="_blank"><i class="fas fa-file-excel"></i> Descargar plantilla </a>-->
        <!--<button type="button" class="btn btn-danger bg-gradient-danger" onclick="ver_resumen()">Descargar resumen</button>-->      
    </div>
    
    <div class="card-body p-3">

      <form id="formsubir"  enctype="multipart/form-data" >
        <div class="row ">
          <div class="col-12 form-group">
              <input id="reporte" name="reporte" type="file" class="file" data-preview-file-type="text" onchange="leerArchivo();" class="file-loading"  data-show-upload="false">
          </div>
        </div>                
      </form>

      <div class="row ">
        <div class="col-12 form-group">
          <div id="contenido" style="">

            <h5> Vista previa de los datos  </h5>
            <div class="row">
              <div class="col-md-4 mb-3">
              <table  class="table table-bordered table-hover">
                <thead>
                  <tr>
                      <th>Núm. Asistencia</th>
                      <th>Clave Empleado</th>
                      <th>Calendario</th>
                      <th>Entrada</th>
                      <th>Salida</th>
                      <th>Retardo</th>
                      <th>Clave Incidencia A</th>
                  </tr>                  
                </thead>
              </table>
              </div>
            </div>


          </div>
          <div class="col-xs-12 form-group">
            <div id="msj_carga" style=""></div>
          </div>
        </div>
      </div>

    </div> <!--card-body -->

    <div class="card-footer">
      <input type="hidden" id="" name="" value=""/>            
    </div>

  </div>
  <!-- /.card -->

<!-- ================================ MODAL Resultados========================= -->
  <div class="modal fade" id="modal_resultados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">     
              <h5 class="modal-title">Resultados de la autoevaluación </h5>             
              <button type="button" class="close" data-dismiss="modal">&times;</button>                          
          </div>
          <div class="modal-body"> 
              <div class='row'>
                <div class='col-12 ' id="resultados">
                  
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
      </div>                          
    </div>
  </div><!-- /.modal -->



<script type="text/javascript">
  
  function leerArchivo(){
    var formData = new FormData(document.getElementById("formsubir")); 
    //formData.append("accion", accion);
    $.ajax({
        url: '{$_layoutParams.root}asis/leer/',
        type: 'POST',
        data: formData ,
        scriptCharset:"utf-8",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('#contenido').html("Espere un momento por favor, este proceso puede tardar varios minutos.");
        },
        success:  function (response) {
            $("#contenido").html('');
        },
        error: function (request, status, error) {
          alert("Error: ("+xhr.statusText +")");
        }
    })
    .done(function(data) {
      //document.getElementById("formsubir").reset(); 
      $('#contenido ').html(data);
    })
    .fail(function(jqXHR, textStatus ) {
       //$('#contenido').html("Error al crear: " +jqXHR.responseText);
       alert( "La solicitud a fallado: " +  textStatus);
     });
  }

  function subirArchivo(accion = "visualizar"){
    var formData = new FormData(document.getElementById("formsubir")); 
    //formData.append("accion", accion);


    $.ajax({
        url: '{$_layoutParams.root}asis/subir_archivo/',
        type: 'POST',
        data: formData ,
        scriptCharset:"utf-8",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('#msj_carga').html("Espere un momento por favor, este proceso puede tardar varios minutos.");
        },
        success:  function (response) {
            $("#msj_carga").html('');
        },
        error: function (request, status, error) {
          alert("Error: ("+xhr.statusText +")");
        }
    })
    .done(function(data) {
      //document.getElementById("formsubir").reset(); 
      
        //  console.log(data);
      var obj = IsJsonString(data);
      if(obj != false) {   
        var msj_info = obj.msj_info;
        var msj_error = obj.msj_error;
        //var guardados = obj.guardados;

        if(msj_error != "")
          modal_warning("Aviso",msj_error, "Aceptar");
        else  
          modal_success("Guardado","Los registros se han guardado <br>"+msj_info, "Aceptar");
      }else{
        modal_danger("Error",data, "Aceptar");
      }
    })
    .fail(function(jqXHR, textStatus ) {
       //$('#contenido').html("Error al crear: " +jqXHR.responseText);
       alert( "La solicitud a fallado: " +  textStatus);
     });

  }

  function IsJsonString(str) {
     try {
         var obj = JSON.parse(str);
         return obj;
     } catch (e) {
         return false;
     }
  }

  $("#reporte").fileinput({
      uploadUrl: '#',
      language: "es",
      //uploadUrl: "/file-upload-batch/2",
      allowedFileExtensions: ['xls', 'xlsx'],
      //maxFileSize: 2000,
      rtl: true,
      showUpload: false,
      dropZoneEnabled: true,
      previewFileIcon: '<i class="fa fa-file"></i>',
      allowedPreviewTypes: null, // set to empty, null or false to disable preview for all types
      /*previewFileIconSettings: {
          'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>'
      }*/ 
  });

 /* $("#file-0").fileinput({
      theme: 'fas',
      uploadUrl: '#',
      allowedFileExtensions: ['xls', 'xlsx'],
      maxFilesNum: 10,
  }).on('filepreupload', function(event, data, previewId, index) {
      alert('The description entered is:\n\n' + ($('#description').val() || ' NULL'));
  });*/

   
</script>