<?php
    foreach($this->db->query("SELECT PENGUNJUNG_TGL, COUNT(PENGUNJUNG_IP) as PENGUNJUNG_IP FROM `pengunjung` GROUP BY PENGUNJUNG_TGL")->result() as $data){
        $TGL[] = $data->PENGUNJUNG_TGL;
        $IP[] = $data->PENGUNJUNG_IP;
    }
?>

		<?php echo $__sidebar; ?>

	    <!-- Page Content  -->
	    <div id="content">

	        <?php echo $__header; ?>
	        <div class="card">
	        	<div class="card-body">
			    	<div class="row">
			    		<div class="col-12">
			    		  	<h4 class="text-primary"><b><i class="icon icon-rocket"></i> LAPORAN</b></h4>
			    		</div>
			    	</div>

			    	<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h3 class="box-text text-muted"><b>LEMBAGA</b></h3>
									<a href="#" class="btn btn-primary filter"  data-filter="lembaga">Filter</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h3 class="box-text text-muted"><b>PEKURBAN</b></h3>
									<a href="<?php echo base_url() ?>admin/pdfMember" class="btn btn-primary filter"  data-filter="pekurban">Filter</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h3 class="box-text text-muted"><b>HEWAN QURBAN</b></h3>
									<a href="<?php echo base_url() ?>admin/pdfHewan" class="btn btn-primary filter"  data-filter="hewan">Filter</a>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h3 class="box-text text-muted"><b>PENABUNGAN</b></h3>
									<a href="<?php echo base_url() ?>admin/pdfPenabungan" class="btn btn-primary filter"  data-filter="penabungan">Filter</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h3 class="box-text text-muted"><b>PEMBELIAN</b></h3>
									<a href="<?php echo base_url() ?>admin/pdfPembelian" class="btn btn-primary filter"  data-filter="pembelian">Filter</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h3 class="box-text text-muted"><b>SARAN</b></h3>
									<a href="<?php echo base_url() ?>admin/pdfSaran" class="btn btn-primary filter"  data-filter="saran">Filter</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>

	<!-- lembaga -->
	<div class="modal fade" id="lembaga">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filter Lembaga</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
			<form method="POST">
				<div class="modal-body">
					<p>Tampilkan Kolom</p>
					<fieldset class="form-group">
						<input type="checkbox" name="no"> No
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="nama"> Nama lembaga
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="hp"> No Hp
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="email"> Email
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="alamat"> Alamat
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="status"> Status
					</fieldset>
					<br>
					<p>Mode Urutan Nama</p>
					<fieldset class="form-group">
						<select class="form-control" name="order_by">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
						</select>
					</fieldset>
					<br>
					<p>Tampilkan Berdasrkan Status</p>
					<fieldset class="form-group">
						<select class="form-control" name="where">
							<option value="semua">SEMUA</option>
							<option value="TAMPIL">TAMPIL</option>
							<option value="SEMBUNYI">SEMBUNYI</option>
						</select>
					</fieldset>
					<br>
					<p>Nama File</p>
					<input type="text" class="form-control" name="nama_file" placeholder="Enter nama file" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button formaction="<?php echo base_url(); ?>admin/pdfLembaga" type="submit" class="btn btn-primary">PDF</button>
					<button formaction="<?php echo base_url(); ?>admin/xlsLembaga" type="submit" class="btn btn-success">XLS</button>
				</div>
			</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- pekurban -->
	<div class="modal fade" id="pekurban">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filter Pekurban</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
			<form method="POST">
				<div class="modal-body">
					<p>Tampilkan Kolom</p>
					<fieldset class="form-group">
						<input type="checkbox" name="no"> No
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="nik"> NIK
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="nama"> Nama pekurban
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="hp"> No Hp
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="email"> Email
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="alamat"> Alamat
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="status"> Status
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="tanggal"> Tanggal
					</fieldset>
					<br>
					<p>Mode Urutan Nama</p>
					<fieldset class="form-group">
						<select class="form-control" name="order_by">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
						</select>
					</fieldset>
					<br>
					<p>Tampilkan Berdasrkan Status</p>
					<fieldset class="form-group">
						<select class="form-control" name="where">
							<option value="semua">SEMUA</option>
							<option value="BARU">BARU</option>
							<option value="AKTIF">AKTIF</option>
							<option value="BLOKIR">BLOKIR</option>
						</select>
					</fieldset>
					<br>
					<p>Batas Tanggal</p>
					<div class="input-daterange input-group">
						<input type="date" class="form-control" name="start">
						<span class="input-group-btn">
							<button class="btn btn-secondary" type="button">sampai</button>
						</span>
						<input type="date" class="form-control" name="end">
					</div>
					<br>
					<p>Nama File</p>
					<input type="text" class="form-control" name="nama_file" placeholder="Enter nama file" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button formaction="<?php echo base_url(); ?>admin/pdfMember" type="submit" class="btn btn-primary">PDF</button>
					<button formaction="<?php echo base_url(); ?>admin/xlsMember" type="submit" class="btn btn-success">XLS</button>
				</div>
			</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- hewan -->
	<div class="modal fade" id="hewan">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filter Hewan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
			<form method="POST">
				<div class="modal-body">
					<p>Tampilkan Kolom</p>
					<fieldset class="form-group">
						<input type="checkbox" name="no"> No
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="nama"> Nama hewan
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="berat"> Berat
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="status"> Status
					</fieldset>
					<br>
					<p>Mode Urutan Nama</p>
					<fieldset class="form-group">
						<select class="form-control" name="order_by">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
						</select>
					</fieldset>
					<br>
					<p>Tampilkan Berdasrkan Status</p>
					<fieldset class="form-group">
						<select class="form-control" name="where">
							<option value="semua">SEMUA</option>
							<option value="TAMPIL">TAMPIL</option>
							<option value="SEMBUNYI">SEMBUNYI</option>
						</select>
					</fieldset>
					<br>
					<p>Nama File</p>
					<input type="text" class="form-control" name="nama_file" placeholder="Enter nama file" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button formaction="<?php echo base_url(); ?>admin/pdfHewan" type="submit" class="btn btn-primary">PDF</button>
					<button formaction="<?php echo base_url(); ?>admin/xlsHewan" type="submit" class="btn btn-success">XLS</button>
				</div>
			</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- penabungan -->
	<div class="modal fade" id="penabungan">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filter Penabungan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
			<form method="POST">
				<div class="modal-body">
					<p>Tampilkan Kolom</p>
					<fieldset class="form-group">
						<input type="checkbox" name="no"> No
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="tgl_add"> Tanggal
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="pekurban"> Nama pekurban
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="nominal"> Nominal
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="tgl_transfer"> Tanggal Transfer
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="catatan"> Catatan
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="status"> Status
					</fieldset>
					<br>
					<p>Mode Urutan Tanggal</p>
					<fieldset class="form-group">
						<select class="form-control" name="order_by">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
						</select>
					</fieldset>
					<br>
					<p>Tampilkan Berdasrkan Status</p>
					<fieldset class="form-group">
						<select class="form-control" name="where">
							<option value="semua">SEMUA</option>
							<option value="PROSES">PROSES</option>
							<option value="TERIMA">TERIMA</option>
							<option value="TOLAK">TOLAK</option>
						</select>
					</fieldset>
					<br>
					<p>Batas Tanggal</p>
					<div class="input-daterange input-group">
						<input type="date" class="form-control" name="start">
						<span class="input-group-btn">
							<button class="btn btn-secondary" type="button">sampai</button>
						</span>
						<input type="date" class="form-control" name="end">
					</div>
					<br>
					<p>Nama File</p>
					<input type="text" class="form-control" name="nama_file" placeholder="Enter nama file" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button formaction="<?php echo base_url(); ?>admin/pdfPenabungan" type="submit" class="btn btn-primary">PDF</button>
					<button formaction="<?php echo base_url(); ?>admin/xlsPenabungan" type="submit" class="btn btn-success">XLS</button>
				</div>
			</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- pembelian -->
	<div class="modal fade" id="pembelian">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filter Pembalian</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
			<form method="POST">
				<div class="modal-body">
					<p>Tampilkan Kolom</p>
					<fieldset class="form-group">
						<input type="checkbox" name="no"> No
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="tgl_add"> Tanggal
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="pekurban"> Nama pekurban
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="lembaga"> Nama lembaga
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="total"> Total
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="tgl_terima"> Tanggal Terima
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="catatan"> Catatan
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="status"> Status
					</fieldset>
					<br>
					<p>Mode Urutan Tanggal</p>
					<fieldset class="form-group">
						<select class="form-control" name="order_by">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
						</select>
					</fieldset>
					<br>
					<p>Tampilkan Berdasrkan Status</p>
					<fieldset class="form-group">
						<select class="form-control" name="where">
							<option value="semua">SEMUA</option>
							<option value="PROSES">PROSES</option>
							<option value="TERIMA">TERIMA</option>
						</select>
					</fieldset>
					<br>
					<p>Batas Tanggal</p>
					<div class="input-daterange input-group">
						<input type="date" class="form-control" name="start">
						<span class="input-group-btn">
							<button class="btn btn-secondary" type="button">sampai</button>
						</span>
						<input type="date" class="form-control" name="end">
					</div>
					<br>
					<p>Nama File</p>
					<input type="text" class="form-control" name="nama_file" placeholder="Enter nama file" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button formaction="<?php echo base_url(); ?>admin/pdfPembelian" type="submit" class="btn btn-primary">PDF</button>
					<button formaction="<?php echo base_url(); ?>admin/xlsPembelian" type="submit" class="btn btn-success">XLS</button>
				</div>
			</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- saran -->
	<div class="modal fade" id="saran">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Filter Saran</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
			<form method="POST">
				<div class="modal-body">
					<p>Tampilkan Kolom</p>
					<fieldset class="form-group">
						<input type="checkbox" name="no"> No
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="tgl_add"> Tanggal
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="nama"> Nama
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="email"> Email
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="isi"> Isi
					</fieldset>
					<fieldset class="form-group">
						<input type="checkbox" name="status"> Status
					</fieldset>
					<br>
					<p>Mode Urutan Tanggal</p>
					<fieldset class="form-group">
						<select class="form-control" name="order_by">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
						</select>
					</fieldset>
					<br>
					<p>Tampilkan Berdasrkan Status</p>
					<fieldset class="form-group">
						<select class="form-control" name="where">
							<option value="semua">SEMUA</option>
							<option value="BELUM">BELUM</option>
							<option value="SUDAH">SUDAH</option>
						</select>
					</fieldset>
					<br>
					<p>Batas Tanggal</p>
					<div class="input-daterange input-group">
						<input type="date" class="form-control" name="start">
						<span class="input-group-btn">
							<button class="btn btn-secondary" type="button">sampai</button>
						</span>
						<input type="date" class="form-control" name="end">
					</div>
					<br>
					<p>Nama File</p>
					<input type="text" class="form-control" name="nama_file" placeholder="Enter nama file" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button formaction="<?php echo base_url(); ?>admin/pdfSaran" type="submit" class="btn btn-primary">PDF</button>
					<button formaction="<?php echo base_url(); ?>admin/xlsSaran" type="submit" class="btn btn-success">XLS</button>
				</div>
			</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>
		$(function(){
			$('form').parsley();
			
			$(document).on('submit','form',function(){

                var pilih = $('input[type=checkbox]:checked').length;

                if (pilih == 0 ) {
                    alert('Silahkan pilih minimal 1 kolom');
                    return false;
                }
            });

			$(document).on('click', '.filter', function(event){
				event.preventDefault();
				var modal = $(this).data('filter');
				$('#'+modal+"").modal();
			});

		})
	</script>
	</body>
</html>