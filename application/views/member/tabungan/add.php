<?php echo $__header; ?>

<div class="container" style="margin-top: 100px">
	<div class="row">
	  	<div class="col-md-12">
			<h4 class="text-success"><b><i class="icon icon-wallet"></i> TAMBAH DEPOSITO</b></h4>
		</div>
	</div>
	<?php $member = $this->db->where('MEMBER_ID', $this->session->userdata('__ci_member_id') )->get('MEMBER')->row(); ?>
	<?php if( $member->MEMBER_STATUS == 'BARU' ){ ?>
	<div class="row" style="margin-top: 20px">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<span>Anda akan dapat menggunakan fitur ini jika identitas anda sudah lengkap <a href="<?php echo base_url() ?>member/profil">Lengkapi profil saya</a></span>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	<div class="row" style="margin-top: 20px;">	
		<div class="col-md-6">
        <form action="<?php echo base_url() ?>member/tabungan__add" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="token" value="<?php echo $this->encrypt->encode(TOKEN); ?>">
        	<fieldset class="form-group">
        		<label>Nominal</label><span class="required">*</span>
        		<input id="mask1" type="text" class="form-control" name="NOMINAL" placeholder="Enter nominal" required="">
        	</fieldset>
        	<fieldset class="form-group">
        		<label>Tujuan Bank Transfer</label><span class="required">*</span>
        		<select class="form-control" name="REK_ID" required="">
        			<option value="">--Pilih--</option>
        			<?php foreach( $this->db->where('REKENING_STATUS', 'TAMPIL')->get('REKENING')->result() as $rek ){ ?>
        			<option value="<?php echo $rek->REKENING_ID; ?>"><?php echo $rek->REKENING_NAMA; ?></option>
        			<?php } ?>
        		</select>
        	</fieldset>
        	<fieldset class="form-group">
        		<label>Tanggal</label><span class="required">*</span>
        		<input type="date" class="form-control" name="TGL" required="">
        	</fieldset>
        	<fieldset class="form-group">
        		<label>Bukti Tranfer</label><span class="required">*</span>
        		<input type="file" class="form-control-file" name="BUKTI" id="image-source" onchange="previewImage();" required="">
        		<small class="text-muted">Maximal ukuran file 200kb dan format PNG/JPG</small>
        	</fieldset>
        	<button type="submit" class="btn btn-primary">Kirim</button>
        </form>
		</div>
		<div class="col-md-6">
			<img id="image-preview" class="img-fluid img-thumbnail" style="width: 400px;height: auto;" alt="image preview" />
		</div>

		<?php } ?>
	</div>
</div>

<script>
    function previewImage() {
      document.getElementById("image-preview").style.display = "block";
      var oFReader = new FileReader();
       oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview").innerHTML = 'Loading ... ';
        document.getElementById("image-preview").src = oFREvent.target.result;
      };
    };

    $(function(){
      // Form Validation Parsley JS
      $('form').parsley();
      // Halaman Tabungan 
      $("#mask1").maskMoney({thousands:'.', decimal:',', allowZero: true, prefix: 'Rp. '});
    })
</script>

<?php echo $__footer; ?>