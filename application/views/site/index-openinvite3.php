<div style="height: 30px; background: none repeat scroll 0pt 0pt rgb(255, 255, 255); border-bottom: 1px solid rgb(231, 231, 231); color: rgb(68, 68, 68);"><p style="margin: 0pt auto; width: 960px; text-align: center; line-height: 29px;">
 <?php echo $socialpoint; ?> / 1000 ♥ Netcoid <span style="background: none repeat scroll 0% 0% rgb(254, 255, 203); padding: 3px 10px;">Invitasi #3 dibuka! dukung kami untuk berkembang, follow <a style="color: rgb(211, 46, 46);" href="http://www.twitter.com/netcoid" target="_blank">twitter</a>, like <a style="color: rgb(211, 46, 46);" target="_blank" href="http://www.facebook.com/netcoid">facebook</a> atau ikuti <a style="color: rgb(211, 46, 46);" target="_blank" href="/development">perkembangan</a> kami.</span></p></div></div>

	
	<style type="text/css" media="screen">
	.home{
		    background: url("www-static/assets/images/trees.png") no-repeat scroll center bottom #FFFFFF !important;
}
.button{
	background: #7FBF4D;
background: -moz-linear-gradient(top, #7FBF4D 0%, #63A62F 100%);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#7FBF4D), to(#63A62F));
border: 1px solid #63A62F;
border-bottom: 1px solid #5B992B;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
-moz-box-shadow: inset 0 1px 0 0 #96CA6D;
-webkit-box-shadow: inset 0 1px 0 0 #96CA6D;
box-shadow: inset 0 1px 0 0 #96CA6D;
}
.helloworld {
    font-family: 'Pacifico',serif;
    font-size: 63px;
    font-style: normal;
    font-weight: 400;
    display:block;
    width:800px;
    height:50px;
}
#invitation-open {
    margin: 100px 0 0 90px;
}
#invitation-open-meta {
    margin: 40px 0 0 400px;
}
#what-is-netcoid {      font-family: 'Droid Sans',verdana,ariel,serif; font-weight:bold; font-size: 40px; text-decoration:underline;}

#red-register{    background: none repeat scroll 0 0 #FBFBFB;
    border: 1px solid #EEEEEE;
    float: left;
    opacity: 0.9;
    padding: 10px;
    width: 218px;}
   
#event-invitasi2 {
    background: none repeat scroll 0 0 #FFFFFF;
    float: left;
    margin-left: 40px;
    padding: 5px;
    width: 670px;
}
#netcoid-invitation{
	margin-top:50px;display:none;
}
	</style>

	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="invitation-open">
			<div class="helloworld">business + technology + social</div>
			<div>menghubungkan pelaku bisnis dengan teknologi dan social media.</div>
		</div>

		<div id="invitation-open-meta"><a id="what-is-netcoid" href="#">Signup</a></div>
		<div class="clearfix" id="netcoid-invitation">

	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>

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
						<li>Masih Bingung? langsung ke <a target="_blank" href="/why">Seperti apa?</a> <sub><i>Atau lihat contoh <a class="u" target="_blank" href="/LVUStore">Profil LVU Store</a> atau <a class="u" target="_blank" href="/mangkukmerah">Profil Mangkuk Merah Hosting &#x2714;</a></i></sub></li>
					</ul>
			</div>
				<div class="c" id="red-register">
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

<?php $views->js('jquery,middleware/jquery/jquery.timeago','external'); ?>
<script type="text/javascript">
    $("#what-is-netcoid").click(function () { 
      $('#netcoid-invitation').delay(400).slideDown();
    });
</script>
<?php #$views->js('middleware/historyjs/amplify.store,middleware/historyjs/history.adapter.jquery,middleware/historyjs/history,middleware/historyjs/history.html4','external');
?>
<?php # $views->js('ajaxify-netcoid') ?>
<?php $views->js('middleware/jquery/jquery.form,middleware/jquery/jquery.validation,home'); ?>