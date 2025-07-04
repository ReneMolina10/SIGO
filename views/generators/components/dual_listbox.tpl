
  <select multiple="multiple" size="10" name="{$f.campo}[]" title="{$f.campo}[]" id="{$f.campo}">
  <div id="{$f.campo}">
    {foreach key=key item=c from=$f.datos}
      <option value="{$c.ID}"  {if $d[$f.campo][$c.ID]|default:'' == 1} selected="selected" {/if} >{$c.CAMPO}</option>
    {/foreach}
</div>
  </select>
  <br>
  <!--<button type="submit" class="btn btn-default btn-block">Submit data</button>-->

<script>
  var demo1 = $('select[name="{$f.campo}[]"]').bootstrapDualListbox();
  /*$("#demoform").submit(function() {
    alert($('[name="duallistbox_demo1[]"]').val());
    return false;
  });*/
</script>

<!--         <div class="form-group">
  <label for="{$f.campo}" class="font-weight-bold mb-2">{$f.campo|capitalize}</label>
  <select multiple="multiple" size="10" name="{$f.campo}[]" title="{$f.campo}[]" id="{$f.campo}" class="form-control">
    {foreach key=key item=c from=$f.datos}
      <option value="{$c.ID}" {if $d[$f.campo][$c.ID]|default:'' == 1} selected="selected" {/if}>{$c.CAMPO}</option>
    {/foreach}
  </select>
</div>
<script>
  var demo1 = $('select[name="{$f.campo}[]"]').bootstrapDualListbox({
    nonSelectedListLabel: 'Disponibles',
    selectedListLabel: 'Seleccionados',
    preserveSelectionOnMove: 'moved',
    moveOnSelect: false,
    filterPlaceHolder: 'Buscar',
    infoText: 'Mostrando todos {0}',
    infoTextEmpty: 'Lista vacía',
    infoTextFiltered: '<span class="label label-warning">Filtrado</span> {0} de {1}'
  });
</script>
<style>
  /* Mejora visual para el dual listbox */
  .bootstrap-duallistbox-container .moveall, 
  .bootstrap-duallistbox-container .removeall {
    background: #007bff;
    color: #fff;
    border-radius: 3px;
    margin-bottom: 5px;
  }
  .bootstrap-duallistbox-container select {
    min-height: 250px;
    font-size: 15px;
  }
  .bootstrap-duallistbox-container .btn {
    margin: 2px 0;
  }
</style>
 -->