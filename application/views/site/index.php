	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-content-left">
			<div id="helloworld">
				Hello VIP`s, lets start to make a change.
			</div>
			<ul>
				<li id="red-register-closed">1. masukan username yang diinginkan,nanti digunakan sebagai url anda seperti www.networks.co.id/username<li>
				<li id="red-register-closed">2. kata sandi, pastinya tidak kami simpan secara langsung ( di hash / enskirpsi satu jalan ) kalo lupa
					passwordnya cuma bisa direset. 'password' akan terlihat seperti ini di database<img src="http://dl.dropbox.com/u/5984602/images/hash.png" /> bisa sampai 200 char dan selalu diacak.<li>
				<li id="red-register-closed">3. support di 08999252530 untuk support / gagal login karena password salah ( reset ) atau ke ym netcoid atau damsprivate. jika mengunakan bb bisa masuk ke group bb kami.<li><img src="http://dl.dropbox.com/u/5984602/images/barcode.png" />
				<li id="red-register-closed">4. Thankyou.</li>
										
			</ul>
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
				<p><?php $views->href('/terms',l('terms')); ?></p>
				<p><input type="submit" value="Setuju &amp; Registrasi" name="register" id="button"></p>
				</form>
			</div>
		</div>				
	</div>
	<!-- CONTENT END -->