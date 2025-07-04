

<form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formp" name="formp" action="javascript:guardar()" method="post" >
<div class="col-sm-9" style="padding:2px;"> 

     <div class="box box-primary"> 
			<div class="box-header with-border">
              <h2 class="box-title"> Registrar secci&oacute;n</h2>
            </div>

	<div class="box-footer">
    
            <p>
                <label>Denominaci&oacute;n: </label>
                <input class="form-control" type="text" name="denominacion" id="denominacion" value="{$denominacion|default:""}" required>
            </p>

 <p>
                <label>Descripci&oacute;n: </label>
                <textarea class="form-control" type="text" name="descripcion" id="descripcion" >{$descripcion|default:""}</textarea>
            </p>


            	<label class="pagina">P&aacute;gina: </label>
                <div class=" pagina" >
                    <select class="form-control select2" style="width: 100%;" id="idpagina" name="idpagina">       
                    	{$listPaginas}
                	</select>
                        
            	</div>

                <div class="checkbox">
                  <label>
                    <input id="pag_rama" name="pag_rama" type="checkbox" {if $subpagina==1} checked="checked" {/if} value="1"> Incluir subp&aacute;ginas
                  </label>
                </div>

 <label> Directorio:</label>
           <div class="input-group input-group-sm">

                <input type="text" id="pathdir" name="pathdir" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">...</button>
                    </span>
              </div>


 <br>                  

            <input type="hidden" id="idseccion" name="idseccion" value="{$idseccion|default:"0"}"/>
    
            <p>
                <a class="btn" href="{$_layoutParams.root}acl/secciones/">Salir</a>
                <button type="submit" id="guardar" name="guardar" value="1" class="btn btn-primary">Guardar</button>
                <!---
                <button type="button" onClick="guardarSalir();" class="btn btn-primary">Guardar y salir</button>
                -->
                <button type="submit" id="guardarsalir" name="guardarsalir" value="1" class="btn btn-primary">Guardar y salir</button>
            </p>
        </form>
    </div>
               <div class="box-footer">
                    <div style="color:green;" id="mensaje"></div>
               </div>
    
    </div> 


 </div> 

 
 <!-- jQuery 2.1.4 -->
<script src="{$_layoutParams.ruta_view}plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
    

    
var salir = false;
$( "#guardarsalir" ).click(function() {
  salir = true;
});


function guardar(){
//document.formp.submit();


    $.ajax({
                /*data:  $('#formp').serialize(),*/
                 data:  $('#formp').serialize(),
                url:   '{$_layoutParams.root}acl/guardar_seccion/',
                type:  'post',
                /*scriptCharset: "ISO-8859-1",*/
                scriptCharset:"utf-8",
                beforeSend: function () {
                    $("#mensaje").html('Guardando...');
                },
                success:  function (response) {
                    $("#mensaje").html('');
                    $("#idseccion").val(response);
                    if(!isNaN(response)){
                       //$("#mensaje").html("Configuraci&oacute;n guardada:"+response);
                        BootstrapDialog.show({
                            title: 'Mensaje de salida',
                            message: 'Secci&oacute;n guardada',
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
                                        window.location="{$_layoutParams.root}acl/secciones/";
                                    }

                                }
                            }]
                        });
                    }else{
                        //$("#mensaje").html("Error: "+response);
                        BootstrapDialog.show({
                            title: 'Mensaje de salida',
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
        
}
</script>
