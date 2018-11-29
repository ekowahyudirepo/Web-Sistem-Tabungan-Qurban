<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">

	<?php $member = $this->db->where('MEMBER_ID', $this->session->userdata('__ci_member_id') )->get('MEMBER')->row(); ?>

	<?php if( $member->MEMBER_STATUS == 'BARU' ){ ?>
	<div class="row" style="margin-top: 20px">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<span>Anda akan dapat menggunakan fitur ini jika status anda <span class="badge badge-success">Aktif</span> Silahkan Lengkapi identitas anda sehingga admin dapat memverifikasinya sekaran <a href="<?php echo base_url() ?>member/profil">Lengkapi profil saya</a></span>
			</div>
		</div>
	</div>

	<?php }else{ ?>

	<div class="row">
		<div class="col-md-12">
			<h3 class="text-success"><b><i class="icon icon-check"></i> PILIH HEWAN QURBAN </b></h3>

			<p class="text-mute">Pilih harga hewan qurban sesuai dompet anda</p>
		</div>
		<?php foreach( $query_hewan->result() as $hew ){ ?>
			<div class="col-md-3 col-6">

				<div class="card card-style" style="height: 400px">
					<div class="card-body" style="background-image: url('<?php echo base_url(); ?>uploads/hewan/<?php echo $hew->HEWAN_JENIS; ?>.png');background-size: cover;">
					</div>
					<div class="bg-success text-white" style="padding-top: 10px">
						<h5 class="text-mute text-center box-text"><?php echo $hew->HEWAN_NAMA; ?></h5>
		
						<p class="text-center text-white box-text"><i class="icon icon-info"></i> Berat : <?php echo $hew->HEWAN_BERAT; ?></p>
						<p class="text-center text-white box-text"><i class="icon icon-tag"></i> Harga : <?php echo __rp($hew->HEWAN_HARGA); ?></p>
						<br>
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-secondary btn-lg btn-minus" type="button"><i class="icon icon-minus"></i></button>
							</span>
							<input type="number" name="quantity" id="<?php echo $hew->HEWAN_ID;?>" min="1" value="1" class="quantity form-control" style="border-radius: 0px;" readonly="">
							<span class="input-group-btn">
								<button class="btn btn-secondary btn-lg btn-plus"><i class="icon icon-plus"></i></button>
								<button class="add_cart btn btn-primary btn-lg" data-produkid="<?php echo $hew->HEWAN_ID;?>" data-produknama="<?php echo $hew->HEWAN_NAMA;?>" data-produkharga="<?php echo $hew->HEWAN_HARGA;?>"><i class="icon icon-check"></i></button>
							</span>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h4 class="text-success"><b><i class="icon icon-bag"></i> KERANJANG BELANJA ANDA</b></h4>
		</div>
		<div class="col-md-12">
			<div class="table-responsive"> 
	  	        <table class="table table-hover" style="width: 100%">
	  	        	<thead>
	  	        		<tr>
	  	        			<th>No</th>
	  	        			<th>Nama</th>
	  	        			<th>Harga</th>
	  	        			<th>QTY</th>
	  	        			<th>Sub Total</th>
	  	        			<th>Opsi</th>
	  	        		</tr>
	  	        	</thead>
	  	        	<tbody id="detail_cart">
	  	        	</tbody>
	  	        </table>
	  	        <form>
				
				<fieldset class="form-group">
					<label>Atas Nama Pekurban</label><span class="required">*</span>
					<textarea class="form-control" rows="6" placeholder="Enter Atas Nama Contoh: Sifulan1, Sifulan2, Sifulan3 dst." name="CATATAN" required=""></textarea>
				</fieldset>

				<fieldset class="form-group">
					<label>Lembaga Penerima</label><span class="required">*</span>
					<select class="form-control" name="LEMBAGA_ID" required="">
						<option value="">--Pilih Penerima --</option>
						<?php foreach( $this->db->where('LEMBAGA_STATUS', 'TAMPIL')->get('LEMBAGA')->result() as $pen ){ ?>
						<option value="<?php echo $pen->LEMBAGA_ID; ?>"><?php echo $pen->LEMBAGA_NAMA; ?></option>
						<?php } ?>
					</select>
				</fieldset>
				<button type="submit" formaction="<?php echo base_url() ?>member/pembelian__cek" formmethod="POST" class="btn btn-success btn-lg">Lanjut bayar <i class="icon icon-arrow-right-circle"></i></button>
				</form>
	  	    </div>
		</div>
	</div>
	<?php } ?>
</div>

<?php echo $__footer; ?>

<script>
	$(function(){
		// variable
		const base_url = window.location.origin+'/ci__sitaqur/';
		
		// Form Validation Parsley JS
		$('form').parsley();
		
		// Halaman Pembelian Add
		var input = $('input[name=quantity]');
		var hasil = 1;

		$(document).on('click', '.btn-plus', function(event) {
			event.preventDefault();
			/* Act on the event */
			$(this).parent().parent().find('input[name=quantity]').val(hasil += 1)
			
		});

		$(document).on('click', '.btn-minus', function(event) {
			event.preventDefault();
			/* Act on the event */
			if (hasil>1) { $(this).parent().parent().find('input[name=quantity]').val( hasil -= 1 ) }
		});

		$(document).on('click','.add_cart', function(){
			var HEWAN_ID    = $(this).data("produkid");
			var HEWAN_NAMA  = $(this).data("produknama");
			var HEWAN_HARGA = $(this).data("produkharga");
			var QTY         = $('#' + HEWAN_ID).val();

			var SALDO;
			$.get(base_url+'api/getSaldo', function(data) {

				if ( HEWAN_HARGA < data ) {
					$.ajax({
						url   : base_url+"member/member_keranjang__add",
						method: "POST",
						data  : 
							{
								HEWAN_ID   : HEWAN_ID, 
								HEWAN_NAMA : HEWAN_NAMA, 
								HEWAN_HARGA: HEWAN_HARGA, 
								QTY        : QTY
							},
						success: function(data){
							$('#detail_cart').html(data);
						}
					});
				}else{
					$.confirm({
	                    title: 'Perhatian',
	                    content: 'Maaf , Dompet anda tidak mencukupi',
	                });
				}
			});		
		});

		// Load shopping cart
		$('#detail_cart').load(base_url+"member/load_cart");

		//Hapus Item Cart
		$(document).on('click','.hapus_cart', function(){
			var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
			$.ajax({
				url : base_url+"member/member_keranjang__del",
				method : "POST",
				data : {row_id : row_id},
				success :function(data){
					$('#detail_cart').html(data);
				}
			});
		});
	});
</script>