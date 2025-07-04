// JS PERSONALIZADO
openLoader = function(texto='Cargando') {

    var loader=document.createElement("div")
        loader.setAttribute("id","_loader")
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
        $("#_loader").modal('show')
    }
    closeLoader = function() {
        $("#_loader").modal('hide')
        $("#_loader").remove()
    }
  
  $(document).on('hidden', '.modal-backdrop', function () {
      $(this).remove();
  });