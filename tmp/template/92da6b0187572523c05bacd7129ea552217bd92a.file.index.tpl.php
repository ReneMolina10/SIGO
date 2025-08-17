<?php /* Smarty version Smarty-3.1.8, created on 2025-08-17 02:20:05
         compiled from "C:\xampp\htdocs\SIGO\views\index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1594911989689ae6c21ba205-87266001%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92da6b0187572523c05bacd7129ea552217bd92a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\SIGO\\views\\index\\index.tpl',
      1 => 1755415203,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1594911989689ae6c21ba205-87266001',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_689ae6c223dc37_74384058',
  'variables' => 
  array (
    'minutasPendientes' => 0,
    '_layoutParams' => 0,
    'documentosPendientes' => 0,
    'doc' => 0,
    'tipo_parts' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_689ae6c223dc37_74384058')) {function content_689ae6c223dc37_74384058($_smarty_tpl) {?><div class="content pt-4">
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
documentospropios/">Ingresar</a>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3   card-modulo">
          <div class="card card-outline card-dark " style="width: ;">
            <a title="Ingresar" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
doc_firmados/index">
              <!--<img class="card-img-top" src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/autoeval2.jpg" alt="Card image cap">-->
              <img class="card-img-top" src="https://sigo.uqroo.mx/public/img/index/firmados.jpg" alt="Card image cap ">
            </a>
            <div class="card-body">
              <h5 class="card-title text-left">
                <b>Mis documentos firmados</b>
              </h5>
              <p class="card-text text-left">Documentos firmados.</p>
            </div>
            <div class="card-body div-boton">
              <a role="button" class="btn btn-outline-dark  btn-block" title="" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
doc_firmados/index">Ingresar</a>
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



  
    <!-- Tabla de documentos pendientes-->

    <?php if (count($_smarty_tpl->tpl_vars['documentosPendientes']->value)>0){?>
    <div class="row mt-4">
  <div class="col-12">
    <div class="card card-outline card-dark shadow rounded">
      <div class="card-header bg-dark text-white">
        <h4 class="mb-0 d-inline"><i class="fas fa-file-signature mr-2"></i> Documentos pendientes por firmar</h4>
      </div>
      <div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Origen</th>
                  <th>Tipo</th>
                  <th>Folio</th>
                  <th>Denominación</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php  $_smarty_tpl->tpl_vars['doc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['doc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['documentosPendientes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['doc']->key => $_smarty_tpl->tpl_vars['doc']->value){
$_smarty_tpl->tpl_vars['doc']->_loop = true;
?>
                  <?php $_smarty_tpl->tpl_vars['tipo_parts'] = new Smarty_variable(explode("|",$_smarty_tpl->tpl_vars['doc']->value['tipo']), null, 0);?>
                    <tr>
                      <td>
                        <span class="badge badge-info px-3 py-2 text-uppercase">
                          <?php echo trim($_smarty_tpl->tpl_vars['tipo_parts']->value[1]);?>

                        </span>
                      </td>
                      <td>
                        <?php echo trim($_smarty_tpl->tpl_vars['tipo_parts']->value[0]);?>

                      </td>
                    <td class="font-weight-bold text-primary"><?php echo $_smarty_tpl->tpl_vars['doc']->value['folio'];?>
</td>
                    <td class="text-left"><?php echo $_smarty_tpl->tpl_vars['doc']->value['denominacion'];?>
</td>
                    <td>
                      <div class="btn-group" role="group">
                        <!-- Botón dinámico para abrir el modal -->
                        <button 
                            onclick="abrirModalPdf('<?php echo $_smarty_tpl->tpl_vars['doc']->value['base_url'];?>
'); return false;"


                            class="btn btn-primary rounded-circle" 
                          style="width:40px;height:40px;padding:0;display:flex;align-items:center;justify-content:center;"
                          title="Ver">
                          <i class="fas fa-eye"></i>
                        </button>
                        <!-- Botón para firmar -->
                        <a href="<?php echo $_smarty_tpl->tpl_vars['doc']->value['url_firma'];?>
" target="_blank" class="btn btn-success rounded-circle" 
                          style="width:40px;height:40px;padding:0;display:flex;align-items:center;justify-content:center;" 
                          title="Firmar">
                          <i class="fas fa-pen-nib"></i>
                        </a>
                        <!-- Botón para verificar -->
                        <a href="<?php echo $_smarty_tpl->tpl_vars['doc']->value['url_verify'];?>
" target="_blank" class="btn btn-warning rounded-circle" 
                          style="width:40px;height:40px;padding:0;display:flex;align-items:center;justify-content:center;" 
                          title="Verificar">
                          <i class="fas fa-check-circle"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }?>

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

/* Estilo renovado para la tabla */
.table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.table thead {
  background: linear-gradient(135deg, #343a40 0%, #212529 100%);
  color: #fff;
}

.table thead th {
  padding: 12px;
  text-align: center;
  font-weight: bold;
  text-transform: uppercase;
  border-bottom: 2px solid #dee2e6;
}

.table tbody tr {
  transition: all 0.2s ease;
}

.table tbody tr:hover {
  background-color: rgba(0, 123, 255, 0.1);
}

.table tbody td {
  padding: 12px;
  text-align: center;
  vertical-align: middle;
  border-bottom: 1px solid #dee2e6;
}

.table tbody td:first-child {
  border-left: 1px solid #dee2e6;
}

.table tbody td:last-child {
  border-right: 1px solid #dee2e6;
}

.table tbody tr:last-child td {
  border-bottom: none;
}

/* Estilo para celdas vacías */
.table-empty {
  text-align: center;
  color: #6c757d;
  font-style: italic;
  padding: 20px;
}

/* Botones de acción */
.table .btn {
  font-size: 0.85rem;
  padding: 6px 12px;
  border-radius: 5px;
}

.table .btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
}

.table .btn-primary:hover {
  background-color: #0056b3;
  border-color: #004085;
}

.table .btn-success {
  background-color: #28a745;
  border-color: #28a745;
  color: #fff;
}

.table .btn-success:hover {
  background-color: #1e7e34;
  border-color: #1c7430;
}
</style>

<script>
function abrirModalPdf(url) {
  console.log("URL del PDF:", url); // Verifica la URL en la consola del navegador
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