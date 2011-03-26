	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-content-left">
			<div id="helloworld">
				Hello Faktahunter, Lets start to make a <strong>change</strong>.
			</div>
			<ul>
				<li style="padding: 10px;">@netcoid dibentuk sebagai media dan inspirasi jiwa entrepreneur muda indonesia, Disini #FaktaHunter dapat membuat profil / portofolio usaha, toko sampai organisasi untuk menawarkan produk dan <strong>karya original</strong> masing-masing, #FaktaHunter dapat saling berinteraksi dengan sesama pengguna netcoid. Untuk lebih lengkapnya dapat langsung ke <a style="color:#D32E2E" target="_blank" href="/why">Informasi Perkenalan</a>.</li>
				<li id="red-register-closed">1. Masukan username yang diinginkan, untuk digunakan sebagai url anda seperti : www.networks.co.id/username.<li>
				<li id="red-register-closed">2. Masukan kata sandi, Data yang tersimpan di netcoid seperti <i>password</i>, kami simpan secara terenkripsi sehingga data yang anda simpan <strong>aman</strong> dan <strong>tidak dapat disalahgunakan oleh pihak manapun</strong>, pastikan anda mengunjungi <a style="color:#D32E2E" href="/terms"><u>Persyaratan & Privacy</u></a> terlebih dahulu. Anda bisa <i>mereset password</i> anda dengan menghubungi <a href="/help"><u>Pusat Bantuan</u></a>.<li>
				<li id="red-register-closed">3. Masukan nama usaha, toko atau organisasi anda, Pastikan bahwa nama usaha anda sesuai.<li>
				<li id="red-register-closed">4. Masukan nomer kontak usaha, perhatikan format pengisian seperti 000-1234567 atau berformat GSM 08123456789.<li>
				<script src="http://platform.twitter.com/anywhere.js?id=VgMhY8zm9QF6SgpYskmptA&v=1" type="text/javascript"></script> 
				  <script type="text/javascript">
				    twttr.anywhere(function (T) {
				      T.hovercards();
				    });
				  </script>
				<li id="red-register-closed">5. Support berada di YM: netcoid, email: help@networks.co.id ( pioritas ), atau MENTION @netcoid.</a>
				<li style=" padding: 20px 10px 0;"><strong>Jangan lupa follow akun official</strong> <a class="u" href="/faktanyaadalah">FaktanyaAdalah</a> di netcoid untuk mendapatkan informasi Merchandise sewaktu-waktu dari @FaktanyaAdalah!.<li>
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