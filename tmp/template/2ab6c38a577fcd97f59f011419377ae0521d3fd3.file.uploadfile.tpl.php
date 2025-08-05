<?php /* Smarty version Smarty-3.1.8, created on 2025-07-24 16:57:25
         compiled from "views\generators\components\uploadfile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19132156686882965d296db7-36263506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ab6c38a577fcd97f59f011419377ae0521d3fd3' => 
    array (
      0 => 'views\\generators\\components\\uploadfile.tpl',
      1 => 1753394235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19132156686882965d296db7-36263506',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6882965d340468_11053173',
  'variables' => 
  array (
    'f' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6882965d340468_11053173')) {function content_6882965d340468_11053173($_smarty_tpl) {?><input name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" class="file" type="file" data-min-file-count="1" data-theme="fas" 
<?php if (isset($_smarty_tpl->tpl_vars['f']->value['required'])&&$_smarty_tpl->tpl_vars['f']->value['required']=="true"){?> required="required" <?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['f']->value['disabled'])&&$_smarty_tpl->tpl_vars['f']->value['disabled']=="true"){?> readonly <?php }?> 
>





<script type="text/javascript">
	$("#<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
").fileinput({
        theme: 'fas',
        uploadUrl: '#',
        language: "es",
        //uploadUrl: "/file-upload-batch/2",
        allowedFileExtensions: ["<?php echo implode('", "',$_smarty_tpl->tpl_vars['f']->value['format']);?>
"],
        maxFileSize: <?php echo $_smarty_tpl->tpl_vars['f']->value['size'];?>
, // en KB
        rtl: true,
        <?php if (isset($_smarty_tpl->tpl_vars['f']->value['disabled'])&&$_smarty_tpl->tpl_vars['f']->value['disabled']=="true"){?>
          showBrowse: false, //Oculta el botón Examinar 
          showCaption: false, //Oculta el cuadro de texto 
        <?php }?>         
        showUpload: false,
        showRemove: false,
        dropZoneEnabled: false,
        initialPreviewAsData: true,
        //initialPreview: false,
        //previewFileIcon: '<i class="fa fa-file"></i>',
        //showPreview: false, //Muestra el área de arrastre
        //allowedPreviewTypes: false, // Muestra el contenido del archivo 
        /*previewFileIconSettings: {
            'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>'
        }*/
        initialPreview: [
          <?php if (isset($_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ruta_archivo'])){?>
            <?php if ($_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ext']=="pdf"){?>
              "<?php echo $_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ruta_archivo'];?>
",
            <?php }else{ ?>
              '<img src="<?php echo $_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ruta_archivo'];?>
" class="kv-preview-data file-preview-image">',
            <?php }?>
          <?php }?>          
        ],
        initialPreviewConfig: [
          <?php if (isset($_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ruta_archivo'])){?>
            { 
              type: "pdf",               
              //size: 100, 
              downloadUrl: "<?php echo $_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ruta_archivo'];?>
",
              caption: "<?php echo $_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['file_name_full'];?>
", 
              width: "120px",
              url: "<?php echo $_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ruta_func_delete_file'];?>
", 
              key: 1,
              
              <?php if ($_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']]['ext']!="pdf"){?>
                previewAsData: false,
              <?php }?> 
              <?php if (isset($_smarty_tpl->tpl_vars['f']->value['disabled'])&&$_smarty_tpl->tpl_vars['f']->value['disabled']=="true"){?>
                showRemove: false,
              <?php }?> 
            }, 
          <?php }?>
          
        ],
        fileActionSettings: { //Acciones para la imagen miniatura 
          <?php if (isset($_smarty_tpl->tpl_vars['f']->value['disabled'])&&$_smarty_tpl->tpl_vars['f']->value['disabled']=="true"){?>
            showZoom: false,
          <?php }?> 
          showUpload: false,
          //showZoom: true,
          showDownload: true,
          showDrag: true,
          showRemove: true,
        }
    });

	banderaSelectGenerator = true; 
</script><?php }} ?>