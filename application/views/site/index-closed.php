	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-content-left">
			<div id="helloworld">
				netcoid adalah layanan jejaring bisnis yang menghubungkan usaha anda dengan peluang baru.
			</div>
			<div id="why-red">
				<a id="pic-1" class="awesome" href="#" title="find & trade"><?php $views->getIMG('4.png'); ?></a>
				<a id="pic-2" class="awesome"href="#" title="and simple."><?php $views->getIMG('2.png'); ?></a>
				<a id="pic-3" class="awesome" href="#" title="it`s social"><?php $views->getIMG('1.png'); ?></a>	
			</div>
			<div>
				<p id="helloworld">want to see more?</p>
				<p id="red-register-closed">Hello, sebelumnya, saya Adam Ramadhan, Netcoid ingin mengucapkan terimakasih kepada seluruh pihak
					yang telah berpartisipasi, kini kami sudah berada pada versi stabil pertama, sayangnya untuk saat ini kami hanya menerima anggota baru <strong>berdasarkan invitasi</strong>. untuk keterangan email ke hello@networks.co.id atau follow twitter kami di <a href="http://www.twitter.com/netcoid">@netcoid</a>.
				</p>
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