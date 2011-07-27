<!-- FORM START -->
<div id="red-edit-left-wide">
	<h3>Data Usaha</h3>
	<form id="form-useredit" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="#" >
	<ul>
		<li><?php $this->forms->textinput('name',l('name'), array( 'disabled' => 'disabled', 'value' => $this->sessions->get('name'))); ?></li>
		<li><?php $this->forms->textarea('address',l('address'), 
		array(	'value' => $user['address'], 
				'cols' => '17',
				'rows' => '5',
				'title'=> l('edit_address_error'))); ?></li>
		
		<li><?php $this->forms->textinput('phone',l('phone'), 
		array(	'value' => $user['phone'],
				'title' => l('register_phone_error'))); ?></li>

		<li><?php $this->forms->textinput('email',l('email'), 
		array(	'value' => $user['email'],
				'title' => l ( 'edit_email_error' ))); ?></li>
		<li><?php $this->forms->fileinput('logo', l('logo'), array( 'title' => l ( 'edit_logo_error' ))); ?></li>
	</ul>
	<p><input type="submit" value="Ubah" name="edit" id="button"></p>
	</form>
</div>
<!-- FORM ENDS -->

<!-- INFORMATION START -->
<div id="red-edit-right">
	<?php
		if (!empty($user['logo'])) {
			echo "<h3>Preview Informasi</h3>";
			$views->getStorage($this->sessions->get('uid'),$user['logo']);
			echo "<hr/>";
		}
		
		if (!empty($user['address'])) {
			$this->googlemaps->display($this->sessions->get('uid'));
		}
		
		if ( empty($user['logo']) || empty($user['address']) || empty($user['email']) ) {
		?>
            <div id="red-edit-right">
                <div id="red-profile-guides">
                <h3>Introduce yourself.</h3>
                    <p>Perkenalkan usaha anda, informasi ini akan digunakan <i>visitor</i> yang menghubungi usaha anda.</p>
                </div>
              <div id="red-profile-guides">
                <h3>Howto & Guide</h3>
				<ul>
					<li>Nama Perusahaan tidak dapat diubah, untuk perubahan silahkan hubungi <a href="#">Pusat Bantuan</a>.</li>
					<li>contoh: <em>"Binus university, Jakarta, Indonesia"</em>, jika tidak terdapat gambar peta, anda dapat <u>merefresh halaman</u> atau mengubah format alamat anda.</li>
					<li>Resolusi logo akan disesuaikan lebar baru 220px</li>
				</ul>
                </div>
            </div>
		<?php
		}				
	?>
</div>
<!-- INFORMATION ENDS -->		

<?php $views->js('middleware/jquery/jquery.form,middleware/jquery/jquery.validation','external'); ?>
<?php $views->js('users/editprofile'); ?>