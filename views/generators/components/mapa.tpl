
<style>
.map {
    margin-left: auto;
    margin-right: auto;
    display: block;
    height: 50vh;
    width:  100%;
}  
.padding{
    padding-bottom: 30px;            
}
</style>

    <div class="row">


        <input  class="form-control" type="{$f.tipo}" name="{$f.campo}" id="{$f.campo}"  value="{$d[$f.campo]|default:''}" placeholder="Escriba latitud" {$detalles|default:""}  maxlength="{$f.max}" 
        {if isset($f.pattern) } pattern="{$f.pattern}" {/if}
        
        {if isset($f.readonly) && $f.readonly=="true"} readonly {/if}
        {if isset($f.disabled) && $f.disabled== "true"} disabled {/if}
        /> 
        
        

    </div>

    <div id="map" class="map">  </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7-5gK8LoMGQp5BwwgF1MXacElbcFwzQQ&callback=initMap" async defer></script>
    <script>
    //AIzaSyC7-5gK8LoMGQp5BwwgF1MXacElbcFwzQQ
    //AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k
        var map;

        var marker = null;

        function initMap() {  

            var coord_default =  "{$d[$f.campo]|default:'12,11'}"; 

            var coord = coord_default.split(',');

            console.log(coord );
            console.log({$d[$f.campo]|default:'12,11'} );
            

            map = new google.maps.Map(document.getElementById('map'), {
                    {literal}
                    center: {lat: parseFloat(coord[0].trim() )  ,lng: parseFloat(coord[1].trim() ) }, 
                    {/literal}
                    zoom: 13,
                    });

                   // placeMarker(parseFloat(coord[0].trim() )+","+parseFloat(coord[1].trim() ) );

            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
            });



            }

            function placeMarker(location) {

             // Eliminar marcador anterior si existe
             if (marker !== null && marker !== undefined) {
                marker.setMap(null);
            }

              marker = new google.maps.Marker({
                position: location,
                map: map
            });

            // Actualizar el campo de texto con las coordenadas
           // document.getElementById('coordenadas').value = location.lat() + ', ' + location.lng();

            $("#{$f.campo}").val(location.lat() + ', ' + location.lng());
            

        }


    </script>

