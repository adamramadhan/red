	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-content-left">
			<div id="helloworld">
				Start to make a <strong>real change</strong>.
			</div>
			<?php $views->css('blog'); ?>
			<div class="blog-post" id="event-invitasi2">
			<p>Netcoid adalah layanan jejaring bisnis dimana anda bisa;</p>
					<ul>
						<li>Buat Portofolio Bisnis Anda, <sub><i>tidak hanya menjual</i></sub></li>
						<li>Social, <sub><i>dapatkan www.networks.co.id/bisnisanda dengan kekuatan social. facebook, twitter dan yahoo!</i></sub></li>
						<li>Gunakan domain sendiri! www.bisnisanda.com <sub><i>kontak kami di pusat bantuan</i></sub></li>
						<li>Dapatkan Partner baru, <sub><i>yang saling melengkapi</i></sub></li>
						<li>Ikuti perkembangan bisnis disekitar anda, <sub><i>dengan menggunakan sistim follow</i></sub></li>
						<li>Tingkatkan Kepercayaan pengunjung, <sub><i>bukan hanya feedback & testimonial</i></sub></li>
						<li>Butuh lebih?, <sub><i>email team di hello@networks.co.id, 12x7 fast response.</i></sub></li>
						<li>Masih Bingung? langsung ke <a target="_blank" href="/why">Seperti apa?</a> <sub><i>Atau lihat contoh <a class="u" target="_blank" href="/LVUStore">Profil LVU Store</a> atau <a class="u" target="_blank" href="/mangkukmerah">Profil Mangkuk Merah Hosting</a></i></sub></li>
					</ul>
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
					<li><label for="company">Nama Organisasi / Bisnis</label>  <input type="text" title='<?php echo l('register_companyname_error'); ?>' 
					value="" id="input-company" class="textinput" name="company"></li>
					<li><label for="phone">Kontak Organisasi / Bisnis</label>  <input type="text" title='<?php echo l('register_phone_error'); ?>' 
					value="" id="input-phone" class="textinput" name="phone"></li>
				</ul>
				<p style="padding: 5px;">Anda Menyetujui <a target="_blank" href="/terms" style="color: rgb(211, 46, 46);">Kebijakan Layanan</a> dan <a target="_blank" href="/privacy" style="color: rgb(211, 46, 46);">Kebijakan Privasi</a> Netcoid.</p>
				<p><input type="submit" value="Setuju &amp; Registrasi" name="register" id="button"></p>
				</form>
			</div>
		</div>				
	</div>
	<!-- CONTENT END -->