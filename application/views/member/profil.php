<?php echo $__header; ?>

<?php $mbr = $query_mbr->row(); ?>

<div class="container" style="margin-top: 100px">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info">Mohon isikan data identitas asli anda demi kelancaran proses verifikasi identitas <br>
			Demi keamanan identitas setelah akun anda aktif sistem tidak mengizinkan anda mengubah identitas penting lainya</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<form action="<?php echo base_url() ?>member/member__foto_up" method="POST" enctype="multipart/form-data">
					<fieldset class="form-group" style="margin-top: 20px;">
						<center>
							<?php if( $mbr->MEMBER_FOTO == NULL ){ ?>
							<img class="rounded-circle" width="200" src="<?php echo base_url() ?>uploads/not.jpg">
							<?php }else{ ?>
							<img class="rounded-circle" width="200" src="<?php echo base_url() ?>uploads/member/foto/<?php echo $mbr->MEMBER_FOTO; ?>">
							<?php } ?>
						</center>
						<br>
						<input type="hidden" name="FOTO_LAMA" value="<?php echo $mbr->MEMBER_FOTO; ?>">
						<div class="input-group">
							<input type="file" class="form-control" name="FOTO" required="">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary btn-lg">Perbarui</button>
							</span>
						</div>
					</fieldset>	
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<p><i class="icon icon-wallet"></i> Saldo anda</p>
					<hr/>
					<span class="text-dark" style="font-size: 40px;font-weight: bold;"><?php echo __rp($this->M__tabungan->saldo($this->session->userdata('__ci_member_id'))); ?>
					</span>
					<br>
					<hr/>
					<a href="<?php echo base_url(); ?>member/tabunganTambah" class="btn btn-primary" title=""><i class="icon icon-plus"></i> Deposito</a>
					<a href="<?php echo base_url(); ?>member/tabungan" class="btn btn-light" title=""><i class="icon icon-list"></i> Lihat Detail</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-success"><b><i class="icon icon-user-following"></i> PROFIL</b></h3>
				</div>

				<div class="col-md-12" style="margin-top: 20px;">
					<form action="<?php echo base_url() ?>member/member__profil_up" method="POST">
						<input type="hidden" name="ID" value="<?php echo $mbr->MEMBER_ID; ?>">
						<fieldset class="form-group">
							<label>Status</label><br>
							<span class="badge badge-info"><?php echo $mbr->MEMBER_STATUS; ?></span>
						</fieldset>
						<fieldset class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="EMAIL" placeholder="Enter email" value="<?php echo $mbr->MEMBER_EMAIL; ?>" readonly> 
							<small class="text-muted">Email ini digunakan sebagai media konfirmasi sistem dengan pengguna</small>
						</fieldset>
						<fieldset class="form-group">
							<label>NIK</label>
							<input type="text" class="form-control" name="NIK" placeholder="Enter NIK" value="<?php echo $mbr->MEMBER_NIK; ?>" required="" data-parsley-type="number" <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'readonly' : ''; ?> >
						</fieldset>
						<fieldset class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="NAMA" placeholder="Enter nama" value="<?php echo $mbr->MEMBER_NAMA; ?>" <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'readonly' : ''; ?> required="">
						</fieldset>
						<fieldset class="form-group">
					        <div class="row">
								<div class="col-12">
									<label>Nomor HP</label>
									<div class="input-group">

										<input type="text" class="form-control" placeholder="Enter nomor HP" name="HP" value="<?php echo $mbr->MEMBER_HP; ?>" required="" data-parsley-type="number">
										<span class="input-group-btn">
											<button class="btn btn-secondary kode-verifikasi" type="button">Kirim Kode</button>
										</span>
									</div>
								</div>
							</div>
						</fieldset>
						<br>
						<fieldset class="form-group">
							<label>Jenis Kelamin</label>
							<div class="radio">
								<label>
									<input type="radio" name="JK" value="L" <?php echo ($mbr->MEMBER_JK == 'L')? 'checked' : ''; ?> <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'disabled' : ''; ?>>
									Laki Laki
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="JK" value="P" <?php echo ($mbr->MEMBER_JK == 'P')? 'checked' : ''; ?> <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'disabled' : ''; ?>>
									Perempuan
								</label>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label>Provinsi</label>
							<select class="form-control" name="PROVINSI" <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'disabled' : ''; ?>>
							     <?php if($mbr->MEMBER_PROVINSI != NULL){ ?>
							     <option><?php echo $mbr->MEMBER_PROVINSI; ?></option>
							     <?php } ?>
							</select>
						</fieldset>
						<fieldset class="form-group">
							<label>Kabupaten</label>
							<select class="form-control" name="KABUPATEN" disabled>
							    <?php if($mbr->MEMBER_KABUPATEN != NULL){ ?>
							     <option><?php echo $mbr->MEMBER_KABUPATEN; ?></option>
							     <?php } ?>
							</select>
						</fieldset>
						<fieldset class="form-group">
							<label>Kecamatan</label>
							<select class="form-control" name="KECAMATAN" disabled>
							    <?php if($mbr->MEMBER_KECAMATAN != NULL){ ?>
							     <option><?php echo $mbr->MEMBER_KECAMATAN; ?></option>
							     <?php } ?>
							</select>
						</fieldset>
						<fieldset class="form-group">
							<label>Desa</label>
							<select class="form-control" name="DESA" disabled>
							    <?php if($mbr->MEMBER_DESA != NULL){ ?>
							     <option><?php echo $mbr->MEMBER_DESA; ?></option>
							     <?php } ?>
							</select>
						</fieldset>
						<fieldset class="form-group">
							<label for="exampleTextarea">Dusun</label>
							<textarea class="form-control" name="DUSUN" rows="5" required="" <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'readonly' : ''; ?>><?php echo $mbr->MEMBER_DUSUN; ?></textarea>
						</fieldset>
						<fieldset class="form-group">
							<label>Bank</label>
							<input type="text" class="form-control" name="BANK" placeholder="Enter nama" value="<?php echo $mbr->MEMBER_BANK; ?>" required="" <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'readonly' : ''; ?>>
						</fieldset>
						<fieldset class="form-group">
							<label>No Rekening</label>
							<input type="text" class="form-control" name="NO_REK" placeholder="Enter no Rekening" value="<?php echo $mbr->MEMBER_NO_REK; ?>" required="" <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'readonly' : ''; ?>>
						</fieldset>
						<fieldset class="form-group">
							<label>Atas Nama Rekening</label>
							<input type="text" class="form-control" name="AN_REK" placeholder="Enter A.N" value="<?php echo $mbr->MEMBER_AN_REK; ?>" required="" <?php echo ($mbr->MEMBER_STATUS == 'AKTIF') ? 'readonly' : ''; ?>>
						</fieldset>
						<?php if( $mbr->MEMBER_STATUS == 'BARU' ){ ?>
						<button type="submit" class="btn btn-primary">Perbarui</button>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-success"><b><i class="icon icon-key"></i> UBAH PASSWORD</b></h3>
				</div>

				<div class="col-md-12" style="margin-top: 20px;">
					<form action="<?php echo base_url() ?>member/member_password__up" method="POST">
						<input type="hidden" name="ID" value="<?php echo $mbr->MEMBER_ID; ?>">
						<fieldset class="form-group">
							<label>Password Lama</label>
							<input type="password" class="form-control" name="PASSWORD_LAMA" placeholder="Enter Password Lama" required="" id="pass2">
						</fieldset>
						<fieldset class="form-group">
							<label>Password Baru</label>
							<input type="password" class="form-control" name="PASSWORD_BARU" placeholder="Enter Password Baru" required="" data-parsley-equalto="#pass2">
						</fieldset>
						
						<button type="submit" class="btn btn-primary">Perbarui</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(function(){
		// variable
		const base_url = window.location.origin+'/ci__sitaqur/';

		// Form Validation Parsley JS
		$('form').parsley();
		// Halaman Profil
	  	var provinsi  = $('select[name=PROVINSI]');
		var kabupaten = $('select[name=KABUPATEN]');
		var kecamatan = $('select[name=KECAMATAN]');
		var desa      = $('select[name=DESA]');
		var edit      = $('a.edit_alamat');
		
		function ajax_provinsi(){
		    jQuery.ajax({
		      url: base_url+'api/provinsi',
		      type: 'GET',
		      dataType: 'html',
		      beforeSend: function() {
		        provinsi.html('<option>Loading..</option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option><option></option>');
		      },
		      success: function(data) {
		        //called when successful
		        provinsi.html(data);
		        console.log(data);
		      },
		      error: function(xhr, textStatus, errorThrown) {
		        //called when there is an error
		        alert('Error load');
		      }
		    });
		}
		
		function ajax_kabupaten(){
		    jQuery.ajax({
		      url: base_url+'api/kabupaten/'+provinsi.children('option:selected').data('id')+'',
		      type: 'GET',
		      dataType: 'html',
		      beforeSend: function() {
		        kabupaten.html('<option>Loading..</option>');
		      },
		      success: function(data) {
		        //called when successful
		        kabupaten.html(data);
		      },
		      error: function(xhr, textStatus, errorThrown) {
		        //called when there is an error
		        alert('Error load');
		      }
		    });    
		}
		
		function ajax_kecamatan(){
		    jQuery.ajax({
		      url: base_url+'api/kecamatan/'+kabupaten.children('option:selected').data('id')+'',
		      type: 'GET',
		      dataType: 'html',
		      beforeSend: function() {
		        kecamatan.html('<option>Loading..</option>');                                       
		      },
		      success: function(data) {
		        //called when successful
		        kecamatan.html(data);
		        console.log(data);
		      },
		      error: function(xhr, textStatus, errorThrown) {
		        //called when there is an error
		        alert('Error load');
		      }
		    });
		}
		
		function ajax_desa(){
			jQuery.ajax({
		      url: base_url+'api/desa/'+kecamatan.children('option:selected').data('id')+'',
		      type: 'GET',
		      dataType: 'html',
		      beforeSend: function() {
		        desa.html('<option>Loading..</option>');
		      },
		      success: function(data) {
		        //called when successful
		        desa.html(data);
		        console.log(data);
		      },
		      error: function(xhr, textStatus, errorThrown) {
		        //called when there is an error
		        alert('Error load');
		      }
		    });
		}
		
		provinsi.on('focus', function(){
		    ajax_provinsi();
		});
			
		provinsi.on('change', function(){
		    ajax_kabupaten();
		    kabupaten.removeAttr('disabled');
		    
		    kecamatan.val('');
		    kecamatan.attr('disabled','disabled');
		    
		    desa.val('');
		    desa.attr('disabled','disabled');
		});

		kabupaten.on('change', function(){
		    ajax_kecamatan();
		    kecamatan.removeAttr('disabled');
		    
		    desa.val('');
		    desa.attr('disabled','disabled');
		});

		kecamatan.on('change', function(){
		    ajax_desa();
		    desa.removeAttr('disabled');
		});

		edit.on('click', function(e){
		    e.preventDefault();
		    provinsi.removeAttr('disabled');
		    ajax_provinsi();
		});


		$(document).on('click', '.kode-verifikasi', function(event) {
			event.preventDefault();
			/* Act on the event */
	            $.alert({
	                title: 'Masukkan Kode Anda',
	                icon: 'icon icon-check',
	                content: '<input type="number" class="input-kode" name="kode"><input type="number" class="input-kode" name="kode1"><input type="number" class="input-kode" name="kode2"><input type="number" class="input-kode" name="kode3">',
	                animation: 'scale',
	                closeAnimation: 'scale',
	                buttons: {
	                    okay: {
	                        text: 'Kirim',
	                        btnClass: 'btn-blue'
	                    }
	                }
	            });
		});
		$(document).on('click', 'input[name=kode]', function(event) {
			$(this).val('');
		});
		$(document).on('click', 'input[name=kode1]', function(event) {
			$(this).val('');
		});
		$(document).on('click', 'input[name=kode2]', function(event) {
			$(this).val('');
		});
		$(document).on('click', 'input[name=kode3]', function(event) {
			$(this).val('');
		});

		$(document).on('input', 'input[name=kode]', function(event) {
			event.preventDefault();
			/* Act on the event */
			var val = $(this).val();

			if ( val.length == 1 ) {
				
				$('input[name=kode1]').val('');
				$('input[name=kode1]').focus();
			}
		});

		$(document).on('input', 'input[name=kode1]', function(event) {
			event.preventDefault();
			/* Act on the event */
			var val = $(this).val();

			if ( val.length == 1 ) {
				
				$('input[name=kode2]').val('');
				$('input[name=kode2]').focus();
			}

			if (val == '') {
			
				$('input[name=kode]').val('');
				$('input[name=kode]').focus();
			}
		});

		$(document).on('input', 'input[name=kode2]', function(event) {
			event.preventDefault();
			/* Act on the event */
			var val = $(this).val();

			if ( val.length == 1 ) {
				
				$('input[name=kode3]').val('');
				$('input[name=kode3]').focus();
			}

			if (val == '') {
				
				$('input[name=kode1]').val('');
				$('input[name=kode1]').focus();
			}
		});

		$(document).on('input', 'input[name=kode3]', function(event) {
			event.preventDefault();
			/* Act on the event */
			var val = $(this).val();

			if ( val.length == 1 ) {
				$('.kode-loading').html('<img src="'+base_url+'assets/AjaxLoader.gif" width="20px;">')
			}

			if (val == '') {
				
				$('input[name=kode2]').val('');
				$('input[name=kode2]').focus();
			}
		});
	}); 
</script>

<!-- Footer -->
<?php echo $__footer; ?>