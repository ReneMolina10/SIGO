<?php /* Smarty version Smarty-3.1.8, created on 2025-07-24 13:19:01
         compiled from "C:\xampp\htdocs\SIGO\views\index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189602913968803ee925bf82-98014478%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92da6b0187572523c05bacd7129ea552217bd92a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\SIGO\\views\\index\\index.tpl',
      1 => 1753381140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189602913968803ee925bf82-98014478',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68803ee9271ba4_91857603',
  'variables' => 
  array (
    'minutasPendientes' => 0,
    '_layoutParams' => 0,
    'minuta' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68803ee9271ba4_91857603')) {function content_68803ee9271ba4_91857603($_smarty_tpl) {?><div class="content pt-4">
  <div class="container">

    <div class="row text-center">
      

        <div class="col-12 col-sm-6 col-md-3 card-modulo">
          <div class="card card-outline card-dark " style="position: relative;">
            <div style="position: absolute; top: 12px; right: 18px; z-index: 2;">
              <?php if (count($_smarty_tpl->tpl_vars['minutasPendientes']->value)>0){?>
                <span class="vibrando-noti" style="
                  display: inline-block;
                  min-width: 28px;
                  height: 28px;
                  background: #dc3545;
                  color: #fff;
                  border-radius: 50%;
                  text-align: center;
                  line-height: 28px;
                  font-weight: bold;
                  font-size: 1rem;
                  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
                  ">
                  <?php echo count($_smarty_tpl->tpl_vars['minutasPendientes']->value);?>

                </span>
              <?php }?>
            </div>
            <a title="Ingresar" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
minutas/">
              <img class="card-img-top" src="https://sigo.uqroo.mx/public/img/index/minuta.jpg" alt="Card image cap ">
            </a>
            <div class="card-body">
              <h5 class="card-title text-left">
                <b>Minutas</b>
              </h5>
              <p class="card-text text-left">Panel de administración de oficios de minutas.</p>
            </div>
            <div class="card-body div-boton">
              <a role="button" class="btn btn-outline-dark btn-block" title="" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
minutas/">Ingresar</a>
            </div>
          </div>
        </div>



        
        <div class="col-12 col-sm-6 col-md-3   card-modulo">
          <div class="card card-outline card-dark " style="width: ;">
            <a title="Ingresar" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
docgenericos/">
              <!--<img class="card-img-top" src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/autoeval2.jpg" alt="Card image cap">-->
              <img class="card-img-top" src="https://sigo.uqroo.mx/public/img/index/genericos.jpg" alt="Card image cap ">
            </a>
            <div class="card-body">
              <h5 class="card-title text-left">
                <b>Documentos Genéricos</b>
              </h5>
              <p class="card-text text-left">Generación de documentos genéricos.</p>
            </div>
            <div class="card-body div-boton">
              <a role="button" class="btn btn-outline-dark  btn-block" title="" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
docgenericos/">Ingresar</a>
            </div>
          </div>
        </div>


        <!--DICTAMENES TECNICOS-->
        <div class="col-12 col-sm-6 col-md-3   card-modulo">
          <div class="card card-outline card-dark ">
            <a title="Ingresar" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
dictamenes_tecnicos/">
              <!--<img class="card-img-top" src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/autoeval2.jpg" alt="Card image cap">-->
              <img class="card-img-top" src="https://sigo.uqroo.mx/public/img/index/dictamenes_tecnicos.jpg" alt="Card image cap ">
            </a>
            <div class="card-body">
              <h5 class="card-title text-left">
                <b>Dictámenes Técnicos</b>
              </h5>
              <p class="card-text text-left">Dictámenes técnicos de cómputo, redes y comunicaciones.</p>
            </div>
            <div class="card-body div-boton">
              <a role="button" class="btn btn-outline-dark  btn-block" title="" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
dictamenes_tecnicos/">Ingresar</a>
            </div>
          </div>
        </div>

        <!--DOCUMENTOS PROPIOS-->
        <div class="col-12 col-sm-6 col-md-3   card-modulo">
          <div class="card card-outline card-dark ">
            <a title="Ingresar" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
dictamenes_tecnicos/">
              <!--<img class="card-img-top" src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/autoeval2.jpg" alt="Card image cap">-->
              <img class="card-img-top" src="https://sigo.uqroo.mx/public/img/index/subida.jpg" alt="Card image cap ">
            </a>
            <div class="card-body">
              <h5 class="card-title text-left">
                <b>Documentos propios</b>
              </h5>
              <p class="card-text text-left">Firma digital en documentos propios.</p>
            </div>
            <div class="card-body div-boton">
              <a role="button" class="btn btn-outline-dark  btn-block" title="" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
dictamenes_tecnicos/">Ingresar</a>
            </div>
          </div>
        </div>
      
    </div>

    <!-- Modal para ver PDF -->
<div class="modal fade" id="verPdfModal" tabindex="-1" role="dialog" aria-labelledby="verPdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verPdfModalLabel">Vista previa del documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:80vh;">
        <iframe id="iframePdf" src="" width="100%" height="100%" frameborder="0"></iframe>
      </div>
    </div>
  </div>
</div>



    <!-- Tabla de documentos pendientes por firmar-->

    <div class="row mt-4">
  <div class="col-12">
    <div class="card card-outline card-dark shadow rounded">
      <div class="card-header bg-dark text-white" style="cursor:pointer;" data-toggle="collapse" data-target="#cardMinutasPendientes" aria-expanded="false" aria-controls="cardMinutasPendientes">
        <h4 class="mb-0 d-inline"><i class="fas fa-file-signature mr-2"></i> Documentos pendientes por firmar</h4>
        <span class="float-right">
          <i class="fas fa-chevron-down"></i>
        </span>
      </div>
      <div id="cardMinutasPendientes" class="collapse">
        <div class="card-body">
          <div class="d-flex justify-content-end mb-2">
            <div class="input-group" style="max-width: 300px;">
              <input type="text" id="buscadorMinutas" class="form-control form-control-sm border-dark rounded-pill" placeholder="Buscar documento...">
              <div class="input-group-append">
                <span class="input-group-text bg-dark text-white rounded-pill" style="border-left:0;">
                  <i class="fas fa-search"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle mb-0">
              <thead class="thead-dark">
                <tr>
                  <th class="bg-dark text-white text-center" style="width: 15%;">Origen</th>
                  <th class="bg-dark text-white text-center" style="width: 25%;">Documento</th>
                  <th class="bg-dark text-white text-center" style="width: 20%;">Tipo</th>
                  <th class="bg-dark text-white text-center" style="width: 20%;">CLAVE</th>
                  <th class="bg-dark text-white text-center" style="width: 20%;">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($_smarty_tpl->tpl_vars['minutasPendientes']->value)>0){?>
                  <?php  $_smarty_tpl->tpl_vars['minuta'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['minuta']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['minutasPendientes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['minuta']->key => $_smarty_tpl->tpl_vars['minuta']->value){
$_smarty_tpl->tpl_vars['minuta']->_loop = true;
?>
                    <tr>
                      <td class="text-center align-middle"><span class="badge badge-info px-3 py-2">SIGO</span></td>
                      <td class="align-middle"><?php echo $_smarty_tpl->tpl_vars['minuta']->value['MIN_PROCESO'];?>
</td>
                      <td class="align-middle"><?php echo $_smarty_tpl->tpl_vars['minuta']->value['TIPO_DOCUMENTO'];?>
</td>
                      <td class="align-middle text-center"><b class="text-primary"><?php echo $_smarty_tpl->tpl_vars['minuta']->value['MIN_FOLIO'];?>
</b></td>
                      <td class="text-center align-middle">
                        <a href="#" onclick="abrirModalPdf('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
viewminuta/previsualizarpdf/<?php echo $_smarty_tpl->tpl_vars['minuta']->value['HASH_MINUTA'];?>
'); return false;" title="Ver" class="btn btn-sm btn-primary mr-2">
                          <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="https://efirma.uqroo.mx/verify/<?php echo $_smarty_tpl->tpl_vars['minuta']->value['FOLIO_DOC'];?>
" target="_blank" title="Firmar" class="btn btn-sm btn-success">
                          <i class="fas fa-pen-nib"></i> Firmar
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                <?php }else{ ?>
                  <tr>
                    <td colspan="5" class="text-center">No hay documentos pendientes por firmar.</td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



  </div>
</div>


<style>
@keyframes vibrarNoti {
  0% { transform: translate(0, 0); }
  20% { transform: translate(-1px, 1px); }
  40% { transform: translate(1px, -1px); }
  60% { transform: translate(-1px, 1px); }
  80% { transform: translate(1px, -1px); }
  100% { transform: translate(0, 0); }
}
.vibrando-noti {
  animation: vibrarNoti .8s infinite;
}
</style>

<script>
function abrirModalPdf(url) {
  document.getElementById('iframePdf').src = url;
  $('#verPdfModal').modal('show');
}
// Limpia el iframe al cerrar el modal
$('#verPdfModal').on('hidden.bs.modal', function () {
  document.getElementById('iframePdf').src = '';
});



document.getElementById('buscadorMinutas').addEventListener('input', function() {
  var filtro = this.value.toLowerCase();
  var filas = document.querySelectorAll('.table-responsive table tbody tr');
  filas.forEach(function(fila) {
    var texto = fila.textContent.toLowerCase();
    fila.style.display = texto.includes(filtro) ? '' : 'none';
  });
});

  // Al cargar la página, colapsa el card
  $(document).ready(function() {
    $('#cardMinutasPendientes').collapse('hide');
  });
  // Buscador de minutas
  document.getElementById('buscadorMinutas').addEventListener('input', function() {
    var filtro = this.value.toLowerCase();
    var filas = document.querySelectorAll('.table-responsive table tbody tr');
    filas.forEach(function(fila) {
      var texto = fila.textContent.toLowerCase();
      fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
  });
</script>

<?php }} ?>