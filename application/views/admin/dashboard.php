<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h4 class="text-primary" style="display: inline-block;"><b><i class="icon icon-home"></i> DASHBOARD</b></h4>
							<div class="btn-group float-right">
								<a target="_blank" href="<?php echo base_url(); ?>admin/device/laptop" class="btn btn-light"><i class="icon icon-screen-desktop"></i> Laptop</a>
								<a target="_blank" href="<?php echo base_url(); ?>admin/device/tablet" class="btn btn-light"><i class="icon icon-screen-tablet"></i> Tablet</a>
								<a target="_blank" href="<?php echo base_url(); ?>admin/device/mobile" class="btn btn-light"><i class="icon icon-screen-smartphone"></i> Smartphone</a>			
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				    <div class="row">
				    	<div class="col-md-8 offset-2">
			    			<div class="card">
								<div class="card-body">
							        <div class="row">
							        	<div class="col-4">
							        		<div class="btn-group" role="group" aria-label="Basic example">
							        			<button onclick="window.location = '<?php echo base_url() ?>admin/dashboard?type-chart=bar'" type="button" class="btn btn-primary btn-type-chart" data-type="bar">Bar</button>
							        			<button onclick="window.location = '<?php echo base_url() ?>admin/dashboard?type-chart=line'" type="button" class="btn btn-secondary btn-type-chart" data-type="line">Line</button>
							        		</div>
							        	</div>
										<div class="col-8">
											<form>
											<div class="input-group">
												<select name="lembaga_id" class="form-control">
													<option value="">Semua lembaga</option>
													<?php foreach($query_lembaga->result() as $lem){ ?>
													<option value="<?php echo $lem->LEMBAGA_ID; ?>" <?php echo ( $lem->LEMBAGA_ID == $this->input->post('lembaga_id') )? 'selected': ''; ?>><?php echo $lem->LEMBAGA_NAMA; ?></option>
													<?php } ?>
												</select>
												<input type="number" class="form-control" name="tahun_terakhir" placeholder="Tahun terkhir" value="<?php echo (!is_null($this->input->post('tahun_terakhir'))) ? $this->input->post('tahun_terakhir') : date('Y') ?>" required="">
												<span class="input-group-btn">
													<button type="submit" formaction="<?php echo base_url(); ?>admin/dashboard" formmethod="POST" class="btn btn-secondary" type="button"><i class="icon icon-magnifier"></i> Filter</button>
												</span>
											</div>
											</form>
										</div>
									</div>
									<canvas id="canvas" style="min-height: 300px;max-height: 300px;"></canvas>
								</div>
							</div>
			    		</div>
				    	<div class="col-md-6">
					    	<div class="row text-center">
					    		<!-- Member -->
					    		<div class="col-md-6">
									<div class="card">
										<div class="row">
											<div class="col-6">
												<h4><b><?php echo $this->db->where('MEMBER_STATUS', 'AKTIF')->get('MEMBER')->num_rows(); ?></b></h4>
												<b class="text-primary">AKTIF</b>
											</div>
											<div class="col-6" style="border-left: 1px solid #ddd;">
												<h4><b><?php echo $this->db->where('MEMBER_STATUS', 'BLOKIR')->get('MEMBER')->num_rows(); ?></b></h4>
												<b class="text-danger">BLOKIR</b>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div style="padding: 10px;border-top: 1px solid #ddd">
													MEMBER
												</div>
											</div>
										</div>
									</div>
					    		</div>

					    		<!-- Pengunjung -->
						    	<div class="col-md-6">
									<div class="card">
										<div class="row">
											<div class="col-6">
												<h4>
													<b>
													<?php echo $this->db->count_all('PENGUNJUNG'); ?></b>
												</h4>
												<b class="text-primary">TOTAL</b>
											</div>
											<div class="col-6" style="border-left: 1px solid #ddd;">
												<h4>
													<b>
													<?php echo $this->db->select('DISTINCT(PENGUNJUNG_IP)')->get('PENGUNJUNG')->num_rows(); ?>
														
													</b>
												</h4>
												<b class="text-danger">UNIQ</b>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div style="padding: 10px;border-top: 1px solid #ddd">
													PENGUNJUNG
												</div>
											</div>
										</div>
									</div>
								</div>
					    	</div>

					    	<div class="row text-center">
					    		<!-- Penyaluran -->
					    		<div class="col-md-12">
									<div class="card">
										<div class="row">
											<div class="col-6">
												<h4>
													<b>
													<?php $KAMBING = $this->db->select_sum('KERANJANG.KERANJANG_QTY')
													->where('HEWAN.HEWAN_JENIS', 'KAMBING')
													->join('HEWAN', 'HEWAN.HEWAN_ID = KERANJANG.HEWAN_ID', 'left')
													->get('KERANJANG')
													->row()->KERANJANG_QTY;
													echo ($KAMBING == NULL)? '0' : $KAMBING;
													 ?>
													</b>
												</h4>
												<b class="text-primary">KAMBING</b>
											</div>
											<div class="col-6" style="border-left: 1px solid #ddd;">
												<h4>
													<b>
													<?php $SAPI =  $this->db->select_sum('KERANJANG.KERANJANG_QTY')
													->where('HEWAN.HEWAN_JENIS', 'SAPI')
													->join('HEWAN', 'HEWAN.HEWAN_ID = KERANJANG.HEWAN_ID', 'left')
													->get('KERANJANG')
													->row()->KERANJANG_QTY; 
													echo ( $SAPI == NULL )? '0' : $SAPI;
													?>
													</b>
												</h4>
												<b class="text-danger">SAPI</b>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div style="padding: 10px;border-top: 1px solid #ddd">
													TOTAL PENYALURAN HEWAN
												</div>
											</div>
										</div>
									</div>
					    		</div>
					    	</div>

					    	<div class="row text-center">
					    		<!-- Transaksi -->
					    		<div class="col-md-12">
									<div class="card">
										<div class="row">
											<div class="col-6">
												<h4>
													<b>
													<?php echo $this->db->count_all('TABUNGAN'); ?>
													</b>
												</h4>
												<b class="text-primary">PENABUNGAN</b>
											</div>
											<div class="col-6" style="border-left: 1px solid #ddd;">
												<h4>
													<b>
													<?php echo $this->db->count_all('NOTA'); ?>
													</b>
												</h4>
												<b class="text-danger">PEMBELIAN</b>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div style="padding: 10px;border-top: 1px solid #ddd">
													TOTAL JUMLAH TRANSAKSI
												</div>
											</div>
										</div>
									</div>
					    		</div>
					    	</div>

					    	<div class="row text-center">
					    		<!-- Transaksi -->
					    		<div class="col-md-12">
									<div class="card">
										<div class="row">
											<div class="col-6">
												<h4>
													<b>
													<?php echo __rp($this->db->select_sum('TABUNGAN_NOMINAL')
													->get('TABUNGAN')
													->row()->TABUNGAN_NOMINAL); ?>
													</b>
												</h4>
												<b class="text-primary">MASUK</b>
											</div>
											<div class="col-6" style="border-left: 1px solid #ddd;">
												<h4>
													<b>
													<?php echo __rp($this->db->select('SUM(KERANJANG.KERANJANG_QTY * HEWAN.HEWAN_HARGA) AS JUMLAH')
													->join('HEWAN', 'HEWAN.HEWAN_ID = KERANJANG.HEWAN_ID', 'left')
													->get('KERANJANG')
													->row()->JUMLAH); ?>
													</b>
												</h4>
												<b class="text-danger">KELUAR</b>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div style="padding: 10px;border-top: 1px solid #ddd">
													TOTAL DANA
												</div>
											</div>
										</div>
									</div>
					    		</div>
					    	</div>
					    </div>

					    <div class="col-md-6">
					    	<div class="row">
					    		<!-- Transaksi -->
					    		<div class="col-md-12">
									<div class="card">
										<div class="row">
											<div class="col-md-12">
												<?php $TABUNGAN = $this->db
												->where('TABUNGAN.TABUNGAN_STATUS', 'PROSES')
												->join('MEMBER', 'MEMBER.MEMBER_ID = TABUNGAN.MEMBER_ID', 'left')
												->get('TABUNGAN'); ?>
												<div style="height: 170px;overflow-y: auto;padding: 10px;">
												<?php if( $TABUNGAN->num_rows() != 0 ){ ?>
													<table class="table">
													<?php $no = 1; ?>
													<?php foreach ($TABUNGAN->result() as $tab) { ?>
														<tr>
															<td><?php echo $no++; ?>.</td>
															<td>
															<?php if( $tab->MEMBER_FOTO == NULL ){ ?>
															<img class="rounded-circle" width="30" src="<?php echo base_url() ?>uploads/not.jpg">
															<?php }else{ ?>
															<img class="rounded-circle" width="30" src="<?php echo base_url() ?>uploads/member/foto/<?php echo $tab->MEMBER_FOTO; ?>">
															<?php } ?>
															</td>
															<td><?php echo $tab->MEMBER_NAMA; ?></td>
															<td><?php echo __rp($tab->TABUNGAN_NOMINAL); ?></td>
															<td><?php echo __tgl_full($tab->TABUNGAN_ADD); ?></td>
															<td><a href="<?php echo base_url() ?>admin/tabunganDetail/<?php echo $tab->TABUNGAN_ID; ?>" class="btn btn-primary"><i class="icon icon-eye"></i></a></td>
														</tr>
													<?php } ?>
													</table>
												<?php }else{ ?>
													<p class="text-center">Tidak ada catatan</p>
												<?php } ?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div style="padding: 10px;border-top: 1px solid #ddd">
													TRANSAKSI TABUNGAN
												</div>
											</div>
										</div>
									</div>
					    		</div>
					    	</div>

					    	<div class="row">
					    		<!-- Transaksi -->
					    		<div class="col-md-12">
									<div class="card">
										<div class="row">
											<div class="col-md-12">
												<div>
													<?php $PEMBELIAN = $this->db
													->where('NOTA.NOTA_STATUS', 'PROSES')
													->join('MEMBER', 'MEMBER.MEMBER_ID = NOTA.MEMBER_ID', 'left')
													->join('LEMBAGA', 'LEMBAGA.LEMBAGA_ID = NOTA.LEMBAGA_ID', 'left')
													->get('NOTA'); ?>
													<div style="height: 170px;overflow-y: auto;padding: 10px;">
													<?php if( $PEMBELIAN->num_rows() != 0 ){ ?>
														<table class="table">
														<?php $no = 1; ?>
														<?php foreach ($PEMBELIAN->result() as $pem) { ?>
															<tr>
																<td><?php echo $no++; ?>.</td>
																<td>
																	<?php if( $pem->MEMBER_FOTO == NULL ){ ?>
																	<img class="rounded-circle" width="30" src="<?php echo base_url() ?>uploads/not.jpg">
																	<?php }else{ ?>
																	<img class="rounded-circle" width="30" src="<?php echo base_url() ?>uploads/member/foto/<?php echo $pem->MEMBER_FOTO; ?>">
																	<?php } ?>
																</td>
																<td><?php echo $pem->NOTA_NO; ?></td>
																<td><?php echo $pem->MEMBER_NAMA; ?></td>
																<td><?php echo $pem->LEMBAGA_NAMA; ?></td>
																<td><?php echo __tgl_dmy($pem->NOTA_ADD); ?></td>
																<td><a href="<?php echo base_url() ?>admin/pembelianDetail/<?php echo $pem->NOTA_ID; ?>" class="btn btn-primary"><i class="icon icon-eye"></i></a></td>
															</tr>													
														<?php } ?>
														</table>
													<?php }else{ ?>
														<p class="text-center">Tidak ada catatan</p>
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div style="padding: 10px;border-top: 1px solid #ddd">
													TRANSAKSI PEMBELIAN
												</div>
											</div>
										</div>
									</div>
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