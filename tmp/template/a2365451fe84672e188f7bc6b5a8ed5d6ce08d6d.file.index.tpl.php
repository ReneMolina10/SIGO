<?php /* Smarty version Smarty-3.1.8, created on 2025-07-21 20:40:50
         compiled from "C:\xampp\htdocs\sigo\views\index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1361281441687e89b25814d1-18366439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2365451fe84672e188f7bc6b5a8ed5d6ce08d6d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sigo\\views\\index\\index.tpl',
      1 => 1752859376,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1361281441687e89b25814d1-18366439',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_layoutParams' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687e89b25d9d56_32204173',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687e89b25d9d56_32204173')) {function content_687e89b25d9d56_32204173($_smarty_tpl) {?><div class="content pt-4">
  <div class="container">

    <div class="row text-center">
      

        <div class="col-12 col-sm-6 col-md-3   card-modulo">
          <div class="card card-outline card-dark ">
            <a title="Ingresar" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
minutas/">
              <!--<img class="card-img-top" src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/img/autoeval2.jpg" alt="Card image cap">-->
              <img class="card-img-top" src="https://sigo.uqroo.mx/public/img/index/minuta.jpg" alt="Card image cap ">
            </a>
            <div class="card-body">
              <h5 class="card-title text-left">
                <b>Minutas</b>
              </h5>
              <p class="card-text text-left">Panel de administración de oficios de minutas.</p>
            </div>
            <div class="card-body div-boton">
              <a role="button" class="btn btn-outline-dark  btn-block" title="" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
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

    <!-- Tabla de documentos -->
    <div class="row mt-4">
      <div class="col-12">
      <h4 class="mb-3"><i class="fas fa-file-signature mr-2"></i>Documentos pendientes por firmar</h4>
      <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-hover table-striped align-middle mb-0">
        <thead class="thead-dark">
          <tr>
          <th class="bg-dark text-white text-center" style="width: 15%;">Origen</th>
          <th class="bg-dark text-white text-center" style="width: 40%;">Documento</th>
          <th class="bg-dark text-white text-center" style="width: 20%;">CLAVE</th>
          <th class="bg-dark text-white text-center" style="width: 25%;">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td class="text-center align-middle"><span class="badge badge-info px-3 py-2">SIGO</span></td>
          <td class="align-middle">Solicitud de contrato</td>
          <td class="align-middle text-center"><b class="text-primary">DGTI/003/2025</b></td>
          <td class="text-center align-middle">
            <a href="#" onclick="abrirModalPdf('https://sigo.uqroo.mx/viewminuta/previsualizarpdf/8BDD7134A4C649B48D5F9C81AFF4AE38'); return false;" title="Ver" class="btn btn-sm btn-primary mr-2">
            <i class="fas fa-eye"></i> Ver
            </a>
            <a href="#" title="Firmar" class="btn btn-sm btn-success">
            <i class="fas fa-pen-nib"></i> Firmar
            </a>
          </td>
          </tr>
          <tr>
          <td class="text-center align-middle"><span class="badge badge-secondary px-3 py-2">SUGA</span></td>
          <td class="align-middle">Comprobación de Viáticos</td>
          <td class="align-middle text-center"><b class="text-primary">DGTI/008/2025</b></td>
          <td class="text-center align-middle">
            <a href="#" title="Ver" class="btn btn-sm btn-primary mr-2">
            <i class="fas fa-eye"></i> Ver
            </a>
            <a href="#" title="Firmar" class="btn btn-sm btn-success">
            <i class="fas fa-pen-nib"></i> Firmar
            </a>
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>
    </div>
         



  </div>
</div>

<script>
function abrirModalPdf(url) {
  document.getElementById('iframePdf').src = url;
  $('#verPdfModal').modal('show');
}
// Limpia el iframe al cerrar el modal
$('#verPdfModal').on('hidden.bs.modal', function () {
  document.getElementById('iframePdf').src = '';
});
</script>

<?php }} ?>