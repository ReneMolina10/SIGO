<?php /* Smarty version Smarty-3.1.8, created on 2025-07-04 23:09:32
         compiled from "C:\xampp\htdocs\SIGO\views\index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108791159068680397173112-35714580%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92da6b0187572523c05bacd7129ea552217bd92a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\SIGO\\views\\index\\index.tpl',
      1 => 1751663338,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108791159068680397173112-35714580',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68680397177ad7_32838185',
  'variables' => 
  array (
    '_layoutParams' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68680397177ad7_32838185')) {function content_68680397177ad7_32838185($_smarty_tpl) {?><div class="content pt-4">
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
                <b>Documentos Genericos</b>
              </h5>
              <p class="card-text text-left">Generación de documentos genericos.</p>
            </div>
            <div class="card-body div-boton">
              <a role="button" class="btn btn-outline-dark  btn-block" title="" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
docgenericos/">Ingresar</a>
            </div>
          </div>
        </div>

      
    </div>
    
  </div>
</div>

<?php }} ?>