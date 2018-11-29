		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	    	<?php echo $__header; ?>
	    	
	    	<div class="card">
				<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-chart"></i> GRAFIK KURBAN</b></h4>
			    		</div>
			    		<div class="col-md-8 offset-md-2">
			    			<div class="card">
								<div class="card-body">
							        <div class="row">
							        	<div class="col-lg-8">
							        		<div class="btn-group" role="group" aria-label="Basic example">
							        			<button onclick="window.location = '<?php echo base_url() ?>lembaga/dashboard?type-chart=bar'" type="button" class="btn btn-primary btn-type-chart" data-type="bar">Bar</button>
							        			<button onclick="window.location = '<?php echo base_url() ?>lembaga/dashboard?type-chart=line'" type="button" class="btn btn-secondary btn-type-chart" data-type="line">Line</button>
							        		</div>
							        	</div>
										<div class="col-lg-4">
											<form>
											<div class="input-group">
												<input type="number" class="form-control" name="tahun_terakhir" placeholder="Tahun terkhir" value="<?php echo (!is_null($this->input->post('tahun_terakhir'))) ? $this->input->post('tahun_terakhir') : date('Y') ?>" required="">
												<span class="input-group-btn">
													<button type="submit" formaction="<?php echo base_url(); ?>lembaga/dashboard" formmethod="POST" class="btn btn-secondary" type="button"><i class="icon icon-magnifier"></i> Filter</button>
												</span>
											</div>
											</form>
										</div>
									</div>
									<canvas id="canvas" style="height: 200px;"></canvas>
								</div>
							</div>
			    		</div>
			    	</div>
			    </div>
			</div>
	    </div>
	</div>

	<script>
		var MONTHS = <?php echo json_encode($res); ?>;
		var color  = Chart.helpers.color;
		var barChartData = {
			labels: <?php echo json_encode($res); ?>,
			datasets: 
			[
				{
					label: 'Kambing',
					backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
					borderColor: window.chartColors.red,
					borderWidth: 1,
					data: <?php echo json_encode($kambing); ?>
				},
				{
					label: 'Sapi',
					backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
					borderColor: window.chartColors.blue,
					borderWidth: 1,
					data: <?php echo json_encode($sapi); ?>
				}
			]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: '<?php echo (!is_null($this->input->get('type-chart'))) ? $this->input->get('type-chart') : 'bar' ?>',
				data: barChartData,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Grafik Jumlah Terima Kurban 5 Tahun Terakhir'
					},
					scales: {
				        yAxes: [{
				            ticks: {
				                beginAtZero: true
				            }
				        }]
				    },
				    legend: {
				      display: true,
				      position : 'top'
				    },
				    elements: {
				      point: {
				        radius: 0
				      }
				    }
				}
			});
		};
	</script>
	</body>
</html>