<div style="height: 30px; background: none repeat scroll 0pt 0pt rgb(255, 255, 255); border-bottom: 1px solid rgb(231, 231, 231); color: rgb(68, 68, 68);"><p style="margin: 0pt auto; width: 960px; text-align: center; line-height: 29px;">
 <?php echo $socialpoint; ?> ♥ Netcoid <span style="background: none repeat scroll 0% 0% rgb(254, 255, 203); padding: 3px 10px;">Invitasi #3 dibuka! dukung kami untuk berkembang, follow <a style="color: rgb(211, 46, 46);" href="http://www.twitter.com/netcoid" target="_blank">twitter</a>, like <a style="color: rgb(211, 46, 46);" target="_blank" href="http://www.facebook.com/netcoid">facebook</a> atau ikuti <a style="color: rgb(211, 46, 46);" target="_blank" href="/development">perkembangan</a> kami.</span></p></div></div>

<?php $views->CSS('buttons.v1','blog') ?>	
	<style type="text/css" media="screen">

.whatnetcoid {
    display: block;
    font-family: 'Pacifico',serif;
    font-size: 63px;
    font-style: normal;
    font-weight: 400;
    height: 70px;
    margin: 20px 0 0;
    text-align: center;
}
.hownetcoid{text-align: center;}
#invitation-open {
    margin: 100px 0 0 90px;
}
#invitation-open-meta {
    margin: 40px 0 0 400px;
}
#what-is-netcoid {      font-family: 'Droid Sans',verdana,ariel,serif; font-weight:bold; font-size: 40px; text-decoration:underline;}

#red-register {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #DDDDDD;
    float: left;
    padding: 10px;
    width: 218px;
}
#red-content-left {
    background: none repeat scroll 0 0 #FFFFFF;
    float: left;
    height: 635px;
    margin: 5px;
    width: 695px;
}
#event-invitasi2 {
    background: none repeat scroll 0 0 #FFFFFF;
    float: left;
    margin-left: 40px;
    padding: 5px;
    width: 670px;
}
#helpus-1{
    float: left;
    margin: 0 10px 0 0;
    padding: 5px;
width:215px;
}
#helpus-2{  
    float: left;
    margin: 0 10px 0 0;
    padding: 5px;
width:215px;}
#helpus-3{    
    float: left;
    padding: 5px;
width:215px;}
.blog-post{padding:0;}
#moreabout{    font-family: verdana;
    font-size: 15px;}
.showonhover{display:none;}
#helpus-1:hover .showonhover{display: block;width:215px;position: relative;background:#fff;}
#helpus-2:hover .showonhover{display: block;width:215px;position: relative;background:#fff;}
#helpus-3:hover .showonhover{display: block;width:215px;position: relative;background:#fff;}
.wbt{color: #D32E2E;position:absolute;display: block;}
	</style>

	<!-- CONTENT START -->
	<?php $this->validation->geterrors(); ?>
	<div class="clearfix" id="red-content">
		
		<div id="red-content-left">
			<h1 class="whatnetcoid">jejaring bisnis <span id="moreabout">Situs jejaring untuk Bisnis</span></h1>
			<p class="hownetcoid">Menghubungkan pelaku bisnis dengan teknologi dan social media</p>
			<div style="margin-top: 20px;" class="blog-post clearfix">
				<div id="helpus-1">
				<h3>Promote</h3>
					<p>Partisipasi dalam jejaring bisnis indonesia, dimana Anda bisa <strong>membeli, menjual, mencari dan dicari</strong> Pelaku bisnis lainnya. <span class="wbt"><i class="showonhover">Promosikan jasa atau produk anda!</i></span></p>
				</div>		
				<div id="helpus-2">
					<h3>Stay Updated</h3><p>Telusuri & Ikuti Update Pelaku bisnis lainnya dengan satu klik <i>"ikuti"</i>. <strong>promosi, blog, jasa dan produk terbaru</strong> pelaku bisnis yang Anda ikuti. 
					<span class="wbt"><i class="showonhover">Teringkas dalam satu halaman</i></span>
					</p>
				</div>
				<div id="helpus-3">
					<h3>Learn</h3>
					<p>Pelajari penunjung anda, lakukan optimasi, <strong>tingkatkan penjualan anda</strong>. ( Real-time ) <span class="wbt"><i class="showonhover">Jumlah Pengunjung, Produk mana yang paling diminati, Asal Penunjung, Butuh lebih?</span></i>
					</p>
				</div>
			</div>	
			
			<hr>
			<div style="height: 325px; background: url(&quot;www-static/assets/images/sarangsemut.png&quot;) no-repeat scroll -60px -575px rgb(255, 255, 255);"></div>
		</div>
		
		<div id="red-content-right">
			<div id="red-register">
				<h3><strong>Pendaftaran</strong></h3>
				<i>gratis selamanya</i>
				<form id="form-register" accept-charset="utf-8" method="post" >
				<ul>
					<li><label for="username">Username</label><input type="text" maxlength="20" title="<?php echo l('register_username_error'); ?>" 
					value="" id="input-username" class="textinput" name="username">
					<p id="red-register-information">http://networks.co.id/<span id="url-suffix" /></span></p></li>
					<li><label for="password">Kata Sandi</label>
					<input type="password" title="<?php echo l('register_password_empty'); ?>" 
					value="" id="input-password" class="textinput" name="password" autocomplete="off"></li>
					<hr>
					<li><label for="company">Nama Organisasi / Bisnis</label>
					<p id="red-register-information">Jika berawalan PT atau CV akan kami kontak paling lambat 2x24 untuk verifikasi</p>
					<input type="text" title='<?php echo l('register_companyname_error'); ?>' 
					value="" id="input-company" class="textinput" name="company"></li>
					<li><label for="phone">Kontak Organisasi / Bisnis</label>
					<p id="red-register-information">format: <code style="background: none repeat scroll 0pt 0pt rgb(254, 255, 203);">021-1234567</code> atau <code style="background: none repeat scroll 0pt 0pt rgb(254, 255, 203);">08123456789</code></p>
					<input type="text" title='<?php echo l('register_phone_error'); ?>' 
					value="" id="input-phone" class="textinput" name="phone"></li>
				</ul>
				<hr>
				<p style="padding: 5px;">Anda Menyetujui <a target="_blank" href="/terms" style="color: rgb(211, 46, 46);">Kebijakan Layanan</a> dan <a target="_blank" href="/privacy" style="color: rgb(211, 46, 46);">Kebijakan Privasi</a> Netcoid.</p>
				<hr>
				<p style="text-align: center;"><input class="button cupid-green" type="submit" value="Setuju &amp; Registrasi" name="register" id="button"></p>
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