<script src="{$BASE_URL}ckeditor4/ckeditor.js"></script>
<script>

    //CKEditor 5 variables
    CKEditorInit('{$f.campo}');

    //CKEditor 5 function
    function CKEditorInit(name){
        CKEDITOR.replace(name, {
			height: "100",
			allowedContent:true,
			toolbar: [
                { name: "tools1", items: [ "Maximize", "-", "Source", "ShowBlocks", "-", "NewPage", "ExportPdf", "Preview", "Print", "Templates"] },
				{ name: "tools2", items: [ "Cut", "Copy", "Paste", "PasteText", "PasteFromWord", "-", "Undo", "Redo" ] },
                { name: "tools3", items: [ "Find", "Replace", "SelectAll"] },
				{ name: "tools4", items: [ "TextColor", "Bold", "Italic", "Underline", "Strike", "Subscript", "Superscript", "-", "CopyFormatting", "RemoveFormat"] },
				{ name: "tools5", items: [ "NumberedList", "BulletedList", "-", "Outdent", "Indent", "-", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock", "-", "TextLeft", "TextRight"] },
                { name: "tools6", items: [ "Link", "Unlink", "Anchor"] },
                { name: "tools7", items: [ "Image", "Table", "Smiley", "PageBreak", "Iframe"] },
                { name: "tools8", items: [ "Styles", "Format", "Font", "FontSize"] }
				
			]
		})
    };

    openLoader = function(texto) {

        var loader=document.createElement("div")
            loader.setAttribute("id","loader")
            loader.setAttribute("class","modal bd-example-modal-sm")
            loader.setAttribute("data-backdrop","static")
            loader.setAttribute("role","dialog")
            loader.setAttribute("aria-hidden","true")
                var modal= document.createElement("div")
                    modal.setAttribute("class","modal-dialog modal-sm text-center")
                    modal.setAttribute("style","position:absolute; top:50%; left:50%;")
                        var spinner=document.createElement("div")
                            spinner.setAttribute("class","spinner-border text-light")
                            spinner.setAttribute("role","status")
                                var span=document.createElement("span")
                                    span.setAttribute("class","sr-only")
                            spinner.appendChild(span)
                                var txt=document.createElement("h5")
                                    txt.setAttribute("style","color:white;")
                                    txt.innerHTML=texto
                    modal.appendChild(spinner)
                    modal.appendChild(txt)
            loader.appendChild(modal)

        document.body.appendChild(loader);
        $("#loader").modal('show')
    }
    closeLoader = function() {
        $("#loader").modal('hide')
        document.getElementById("loader").remove()
    }

    getFecha = function() {
        var d = new Date();
        var fecha = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + " " +
            d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
        return (fecha);
    }

    


</script>