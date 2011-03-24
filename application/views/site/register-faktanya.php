	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-content-left">
			<div id="helloworld">
				Hello Faktahunter, Lets start to make a <strong>change</strong>.
			</div>
			<ul>
				<li style="padding: 10px;">@netcoid dibentuk sebagai media, ispirasi dan menguatkan jiwa entrepreneur indonesia, disini faktahunter dapat membuat profil toko, usaha atau organisasi sendiri untuk menawarkan produk <strong>karya original</strong> masing masing, faktahunter bisa saling berinteraksi dengan toko lainnya. Lengkapnya langsung ke <a style="color:#D32E2E" target="_blank" href="/why">Perkenalan</a>.</li>
				<li id="red-register-closed">1. masukan username yang diinginkan,nanti digunakan sebagai url anda seperti www.networks.co.id/username<li>
				<li id="red-register-closed">2. masukan kata sandi, <strong>kami tidak menyimpan password anda</strong> kunjungi <a href="/terms"><u>Persyaratan & Privacy</u></a> terlebih dahulu, dikarenakan hal tersebut kami hanya dapat <i>mereset password</i> anda. jika lupa silahkan hubungi <a href="/help"><u>Pusat Bantuan</u></a>.<li>
				<li id="red-register-closed">3. Masukan nama usaha pribadi, perusahaan atau organisasi, pastikan bahwa nama anda benar.<li>
				<li id="red-register-closed">4. Masukan nomer kontak utama, perhatikan format pengisian seperti 000-1234567 atau Kontak GSM 08123456789.<li>
				<script src="http://platform.twitter.com/anywhere.js?id=VgMhY8zm9QF6SgpYskmptA&v=1" type="text/javascript"></script> 
				  <script type="text/javascript">
				    twttr.anywhere(function (T) {
				      T.hovercards();
				    });
				  </script>
				<li id="red-register-closed">5. support tambahan berada di YM: netcoid, email: help@networks.co.id ( pioritas ), atau DM / MENTION di @netcoid</a>
				<li style=" padding: 20px 10px 0;">jangan lupa untuk follow akun official <a class="u" href="/faktanyaadalah">faktanyaadalah</a> dinetcoid untuk mendapatkan informasi merchandise sewaktu-waktu dari @faktanyaadalah!.<li>
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
				<p><input type="submit" disabled="off" value="Setuju &amp; Registrasi" name="register" id="button"></p>
				</form>
			</div>
		</div>				
	</div>
	<!-- CONTENT END -->