  				<div class="input-group">
  				<input  class="form-control" type="text" name="{$f.campo}" id="{$f.campo}" placeholder="{$f.holder}" value="{$d[$f.campo]|default:""}" {$detalles|default:""} onchange="load_infosearch('{$BASE_URL}{$controlador}/infosearch/{$f.campo}/{$f.numero|default:"no"}/','{$f.campo}')" 



			{if isset($f.readonly) && $f.readonly=="true"} readonly {/if}
			{if isset($f.disabled) && $f.disabled== "true"} disabled {/if}
			/>


        <div class="input-group-append" data-toggle="modal" data-target="#{$f.campo}Modal" data-whatever="@mdo">
                      <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>




<!-- ******************************** -->
<form id="form_{$f.campo}">


<div class="modal fade" id="{$f.campo}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Buscar {$f.label}</h4>
      </div>
      <div class="modal-body">


          <div class="form-group">
              <label for="plantilla">Buscar:</label>
                 

                <div class="row">
                  <div class="col-md-12" >
                  	<input type="text" class="form-control" name="palabra_{$f.campo}" id="palabra_{$f.campo}" placeholder="{$f.label}">
                  </div>


                </div>

           </div>
           <div id="busqueda_{$f.campo}" style="height:300px;overflow:auto">.</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnbuscar_{$f.campo}">Buscar</button>
      </div>
    </div>
  </div>
</div>

</form>

<script type="text/javascript">

  $("#palabra_{$f.campo}").on('keyup', function (e) {
    if (e.keyCode == 13) {
        buscar_{$f.campo}();
    }
  });


  $("#btnbuscar_{$f.campo}").click(function() {
      buscar_{$f.campo}();
  });

  function buscar_{$f.campo}(){

//alert($( "#palabra_{$f.campo}" ).val());
    $.ajax({
            //type        : 'POST', 
            url         : '{$BASE_URL}{$controlador}/examinar/{$f.campo}/', 
           // data        :  $( "#form_{$f.campo}" ).serialize(),
           data:  'palabra='+$( "#palabra_{$f.campo}" ).val(), 
            type:  'post',
            scriptCharset:"utf-8",
            //dataType: "json",


            beforeSend: function () {
                 $("#busqueda_{$f.campo}").html("Buscando...");
             }
        })

        .done(function(data) {

              $("#busqueda_{$f.campo}").html(data);

        })

  }

  function sel_{$f.campo}(id,campo){ 
    $("#{$f.campo}").val(id);
    $("#camposearch_{$f.campo}").html(campo);
    $('#{$f.campo}Modal').modal('toggle');
    //infoempl(numempl);
  }

</script>

<!-- ******************************** -->


 

			</div>
			<div id="camposearch_{$f.campo}">----</div>

			<script type="text/javascript">
				$(function() { load_infosearch('{$BASE_URL}{$controlador}/infosearch/{$f.campo}/{$f.numero|default:"no"}/','{$f.campo}'); }); 


		    </script>