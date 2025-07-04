<style>
	
</style>


<canvas id="myChart"></canvas>
<br>
<p>{$descripcion}</p>

<!-- ChartJS -->
<!--<script src="{$BASE_URL_VIEW}plugins/chart.js/Chart.js"></script>-->

<script type="text/javascript">

  //const ctx = document.getElementById('myChart');

  new Chart('myChart', {
    type: '{$tipo_grafica}',
    data: {
      labels: [{$labeles}],
      datasets: [{
        label: '{$etiqueta}', 
        data: [{$data}],        
        backgroundColor: getDataColors(50),        
        {if $tipo_grafica eq 'bar'}
        	borderColor: getDataColors(),
        	borderWidth: 1
        {elseif $name == 'pie'}
        	hoverOffset: 4
        {/if}
      }]
    },
    options: {
    	{if $tipo_grafica eq 'bar'}
      	scales: {
          y: {
            beginAtZero: true
          }
        },
      {/if}
      plugins: {
        /*subtitle: {
            display: true,
            text: 'Custom Chart Subtitle'
        },*/        
      }
    }
  });
</script>