	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-content-left">
			<div id="helloworld">
				Hello!, Lets start to make a <strong>change</strong>.
			</div>
			<ul>
				<li>Selamat datang di jejaring bisnis indonesia</li>
				<li>Gabungkan Bisnis + Social</li>
				<li>Portofolio Bisnis Anda, <a style="color: rgb(204, 62, 62);" target="_blank" href="/LVUstore">Lihat Profil LVUstore</a></li>
				<li>Ikuti perkembangan Bisnis sesuai kebutuhan Anda</li>
				<li>Buat Peluang dengan menemukan partner di sekitar Anda</li>
				<li>Dapatkan juga Kepecayaan Pembeli dengan sistim <a target="_blank" style="color: rgb(204, 62, 62);" href="/verify">Verifikasi</a></li>
				<li>Tingkatkan penjualan Anda</li>
				<script src="https://platform.twitter.com/anywhere.js?id=VgMhY8zm9QF6SgpYskmptA&v=1" type="text/javascript"></script> 
				  <script type="text/javascript">
				    twttr.anywhere(function (T) {
				      T.hovercards();
				    });
				  </script>
				<li id="red-register-closed">5. Support berada di YM: netcoid, email: help@networks.co.id ( pioritas ), atau MENTION @netcoid.</a>
				<li style=" padding: 20px 10px 0;"><strong>Jangan lupa follow akun official</strong> <a class="u" href="/netcoid">Netcoid Indonesia</a> di netcoid untuk mendapatkan informasi Merchandise sewaktu-waktu dari @netcoid!.<li>
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
					<li><label for="company">Nama Organisasi / Bisnis</label>  <input type="text" title='<?php echo l('register_companyname_error'); ?>' 
					value="" id="input-company" class="textinput" name="company"></li>
					<li><label for="phone">Kontak Organisasi / Bisnis</label>  <input type="text" title='<?php echo l('register_phone_error'); ?>' 
					value="" id="input-phone" class="textinput" name="phone"></li>
				</ul>
				<p><?php $views->href('/terms',l('terms')); ?></p>
				<p><input type="submit" value="Setuju &amp; Registrasi" name="register" id="button"></p>
				</form>
			</div>
		</div>				
	</div>
	<!-- CONTENT END -->