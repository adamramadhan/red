	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	
	<style type="text/css" media="screen">
	#red-content-left {
	    height: 500px;
	}
	#red-content.background {
	    background: url("/www-static/assets/images/5.png") no-repeat scroll 200px 150px transparent;
	}
	#red-content.background:hover{
		background: url("/www-static/assets/images/5.png") no-repeat scroll 120px 150px transparent;
	}		
	</style>
	
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-content-left">
			<div id="helloworld">
				netcoid adalah layanan jejaring bisnis yang menghubungkan usaha anda dengan peluang baru.
			</div>
		</div>
		
		<div id="red-content-right">
			<div id="red-register">
				<h3>Pendaftaran</h3>
				<form id="form-register" accept-charset="utf-8" method="post" >
				<ul>
					<li><label for="username">Username</label><input type="text" maxlength="20" title="<?php echo l('register_username_error'); ?>" 
					value="" id="input-username" class="textinput" name="username">
					<p id="red-register-information">http://networks.co.id/<span id="url-suffix" /></span></p></li>
					<li><label for="password">Kata Sandi</label><input type="password" title="<?php echo l('register_password_empty'); ?>" 
					value="" id="input-password" class="textinput" name="password" autocomplete="off"></li>
					<li><label for="company">Nama Organisasi</label>  <input type="text" title='<?php echo l('register_companyname_error'); ?>' 
					value="" id="input-company" class="textinput" name="company"></li>
					<li><label for="phone">Kontak Organisasi</label>  <input type="text" title='<?php echo l('register_phone_error'); ?>' 
					value="" id="input-phone" class="textinput" name="phone"></li>
				</ul>
				<p><p><?php $views->href('/terms',l('terms')); ?></p></p>
				<p><input type="submit" disabled="off" value="Setuju &amp; Registrasi" name="register" id="button"></p>
				</form>
			</div>
		</div>				
	</div>
	<!-- CONTENT END -->