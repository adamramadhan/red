		<div id="red-edit-left-wide">
			<h3>Pusat Bantuan</h3>
			<form accept-charset="utf-8" method="post" action="/help" >
				<ul id="wide-input">
					<li><?php $this->forms->textinput('subject','Subject'); ?></li>
					<li><?php $this->forms->textarea('message',l('message'), array( 
							  'cols' => '17',
							  'rows' => '5')); ?></li>
				</ul>
				<p><input type="submit" value="Kirim" name="send" id="button"></p>
			</form>	
		</div>		

		<div id="red-edit-right">
		<div class="c" id="red-profile-guides">
			<p>Kami disini untuk membantu dengan segala <strong>pertanyaan dan komentar</strong> Anda. Jika anda ingin mengatakan hi, hal itu juga keren. bisa juga melalui;</p>
			<ul>
			<li style="list-style: none outside none; margin-left: 0pt; padding-left: 30px;background: url('/www-static/assets/images/i/phone.png') no-repeat scroll left center transparent;">021-1234567(belum)</li>
			<li style="list-style: none outside none; margin-left: 0pt; padding-left: 30px;background: url('/www-static/assets/images/i/Airmail.png') no-repeat scroll left center transparent;">support@networks.co.id</li>
			</ul>
		</div>

		<div class="c" id="red-profile-guides">
			<h4>Apa dibalik permintaan support yang baik?</h4>
			<ul>
				<li>Membaca FAQS terlebih dahulu</li>
				<li>Alamat URL halaman yang bermasalah</li>
				<li>Username yang bermasalah</li>
			</ul>
		</div>

		</div>				