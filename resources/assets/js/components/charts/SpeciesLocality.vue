<template>	
	<div id="chart" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Chart</h4>
          </div>
          <div class="modal-body">            
            <canvas id="lchart"></canvas>
          </div>          
        </div>
      </div>
    </div>
</template>

<script>
	import Chart from 'chart.js';

	export default {
		props: ['locs', 'species'],

		data(){
			return {

			};
		},
		mounted(){
			console.log(this.locs)
		 	var ctx = document.getElementById("lchart").getContext('2d');
		  	var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: this.locs,
					datasets: [{
					    label: 'Number of species in each locality',
					    data: this.species
					}]
				},
				options: {
					scales: {
						 xAxes: [{
						 	
					        ticks: {
					            stepSize: 1,
					            min: 0,
					            autoSkip: false
					        }			            
				        }],
					    yAxes: [{
					        ticks: {
					            beginAtZero:true,
					            stepSize: 1,
					        }
					    }]
					}
				}
			});
		}

	}

 
	
</script>