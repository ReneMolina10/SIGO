


<div class="container-fluid"> 
    <div class="box-header" style="height: 50px;">
        <h1 class="box-title"><b>Reporte</b></h1>
        <div class="box-tools">
            <div class="input-group" style="width: 350px;">
                
            </div>
        </div>
    </div><!-- /.box-header -->
<div class="box">
  <div class="row">
  

<div class="col-md-12">
    <table id="myTable2" class="table table-striped table-hover" style="max-width: 100%;">

  <thead class="thead-dark "> 
    <tr >
      <th scope="col">MES</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">ISR TIM</th>
      <th scope="col">ISR PAGADO</th>

      <th scope="col">ISR SAIIES</th>

      <th scope="col">ISR DIF TIM</th>

      <th scope="col">TOTAL</th>
    </tr>
  </thead>
  <tbody>

{foreach item=fila key=key from=$concentrado}
    <tr  class="clickable-row">
      <td>{$key}</td>
        <td>{$fila.CANTIDAD}</td>
        <td>{$fila.ISR|number_format:2}</td>
        <td>{$fila.ISRPAGADO|number_format:2}</td>
        <td>{$fila.ISRSAIIES|number_format:2}</td>
        <td>{$fila.ISRDIF|number_format:2}</td>
        <td>{$fila.TOTAL|number_format:2}</td>
    </tr>
    

{/foreach}

  </tbody>
    </table>


{if count($duplicados)> 0}
<h1>Timbrados duplicados ({$cantidad}) </h1>
    <table id="myTable2" class="table table-striped table-hover" style="max-width: 100%;">

  <thead class="thead-dark "> 
    <tr >
      <th scope="col">NOMINA/POLIZA</th>
      <th scope="col">NOEMPLEADO</th>
      <th scope="col">CATIDAD</th>

    </tr>
  </thead>
  <tbody>



{foreach item=fila key=key from=$duplicados}
    <tr  class="clickable-row">
        <td><a href="http://srh.uqroo.mx/spagos/index/{$fila.NOMPOL}/" target="_blank">{$fila.NOMPOL}</a></td>
        <td>{$fila.NOEMPLEADO}</td>
        <td>{$fila.T}</td>

    </tr>
    

{/foreach}

  </tbody>
    </table>
{/if}


{if count($notimbrados)> 0}
<h1>No timbrados</h1>
    <table id="myTable2" class="table table-striped table-hover" style="max-width: 100%;">

  <thead class="thead-dark "> 
    <tr >
      <th scope="col">NOMINA</th>
<th scope="col">PAGO</th>
      <th scope="col">FECHA</th>
      <th scope="col">NUMEMPL</th>
      <th scope="col">ISR</th>

    </tr>
  </thead>
  <tbody>



{foreach item=fila key=key from=$notimbrados}
    <tr  class="clickable-row">
        <td>{$fila.NOMI_NOMINA}</td>
        <td>{$fila.PAGO_PAGO}</td>
        
        <td>{$fila.NOMI_FECHA}</td>
        <td>{$fila.PAGO_EMPL}</td>
        <td>{$fila.ISR|number_format:2}</td>
    </tr>
    

{/foreach}

  </tbody>
    </table>
{/if}

  </div>


    <div class="col-md-12">
<table id="myTable" class="table table-striped table-hover" style="max-width: 100%;">

  <thead class="thead-dark "> 
    <tr >
      <th scope="col">NÓMINA</th>

      <th scope="col">MES</th>

      <th scope="col">CANTIDAD_NOM</th>

      <th scope="col">ISR_NOM</th>

      <th scope="col">CANTIDAD_TIM</th>
      <th scope="col">ISR_TIM</th>

      <th scope="col">TOTAL</th>


      <th scope="col">DIF_ISR</th>
      <th scope="col">TIMBRAR</th>


    </tr>
  </thead>
  <tbody>

{foreach item=fila from=$datos}
    <tr  class="clickable-row">
        <td>{$fila.ID_NOMINA}</td>
        <td>{$fila.MESN}</td>

        <td>{$fila.CANT_NOMINA}</td>

        <td>{$fila.ISR_NOMINA}</td>

        <td>{$fila.CANTIDAD}</td>
        <td>{$fila.ISR}</td>
        <td>{$fila.TOTAL}</td>

        <td>{$fila.DIF_ISR}</td>
        <td>{$fila.URL}</td>






    </tr>
    

{/foreach}

  </tbody>
    </table>

</div>




  </div>

  
</div>


</div>




