<input name="{$f.campo}" id="{$f.campo}" class="file" type="file" data-min-file-count="1" data-theme="fas" 
{if isset($f.required) && $f.required== "true"} required="required" {/if}
{if isset($f.disabled) && $f.disabled== "true"} readonly {/if} 
>





<script type="text/javascript">
	$("#{$f.campo}").fileinput({
        theme: 'fas',
        uploadUrl: '#',
        language: "es",
        //uploadUrl: "/file-upload-batch/2",
        allowedFileExtensions: ["{'", "'|implode:$f.format}"],
        maxFileSize: {$f.size}, // en KB
        rtl: true,
        {if isset($f.disabled) && $f.disabled== "true"}
          showBrowse: false, //Oculta el botón Examinar 
          showCaption: false, //Oculta el cuadro de texto 
        {/if}         
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
          {if isset($d[$f.campo]['ruta_archivo'])}
            {if $d[$f.campo]['ext'] == "pdf"}
              "{$d[$f.campo]['ruta_archivo']}",
            {else}
              '<img src="{$d[$f.campo]['ruta_archivo']}" class="kv-preview-data file-preview-image">',
            {/if}
          {/if}          
        ],
        initialPreviewConfig: [
          {if isset($d[$f.campo]['ruta_archivo'])}
            {literal}{{/literal} 
              type: "pdf",               
              //size: 100, 
              downloadUrl: "{$d[$f.campo]['ruta_archivo']}",
              caption: "{$d[$f.campo]['file_name_full']}", 
              width: "120px",
              url: "{$d[$f.campo]['ruta_func_delete_file']}", 
              key: 1,
              
              {if $d[$f.campo]['ext'] != "pdf"}
                previewAsData: false,
              {/if} 
              {if isset($f.disabled) && $f.disabled== "true"}
                showRemove: false,
              {/if} 
            }, 
          {/if}
          
        ],
        fileActionSettings: { //Acciones para la imagen miniatura 
          {if isset($f.disabled) && $f.disabled== "true"}
            showZoom: false,
          {/if} 
          showUpload: false,
          //showZoom: true,
          showDownload: true,
          showDrag: true,
          showRemove: true,
        }
    });

	banderaSelectGenerator = true; 
</script>