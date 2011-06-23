<div style="height: 30px; background: none repeat scroll 0pt 0pt rgb(255, 255, 255); border-bottom: 1px solid rgb(231, 231, 231); color: rgb(68, 68, 68);"><p style="margin: 0pt auto; width: 960px; text-align: center; line-height: 29px;">
 <?php echo $socialpoint; ?> / 1000 ♥ Netcoid <span style="background: none repeat scroll 0% 0% rgb(254, 255, 203); padding: 3px 10px;">Invitasi #3 ditutup sementara. Dukung kami untuk berkembang, follow <a style="color: rgb(211, 46, 46);" href="http://www.twitter.com/netcoid" target="_blank">twitter</a>, like <a style="color: rgb(211, 46, 46);" target="_blank" href="http://www.facebook.com/netcoid">facebook</a> atau ikuti <a style="color: rgb(211, 46, 46);" target="_blank" href="/development">perkembangan</a> kami.</span></p></div></div>

<?php $views->CSS('buttons.v1') ?>	
	<style type="text/css" media="screen">
	.whatnetcoid {
	    font-family: 'Pacifico',serif;
	    font-size: 63px;
	    font-style: normal;
	    font-weight: 400;
	    height: 70px;
	    margin: 20px 0 0;
	    text-align: center;
	    display:block;
	}
	.hownetcoid{text-align: center;}
	.previewnetcoid p {
	    background: none repeat scroll 0 0 #222;
	    color: #FFFFFF;
	    font-weight: bold;
	    padding: 0 10px;
	    padding:5px 10px;display:block;
	    width:960px;
	    text-align:center;
	}


.previewnetcoid p {
    background: none repeat scroll 0 0 #151515;
    border: 20px solid #151515;
    bottom: 405px;
    color: #FFFFFF;
    display: block;
    font-size: 15px;
    font-weight: bold;
    height: 405px;
    opacity: 0.9;
    padding-top: 202.5px;
    position: relative;
    text-align: center;
    width: 920px;
}
.previewnetcoid p:hover {opacity:0.1;}
	.previewnetcoid{display:none;height:438px !important;}
	.previewnetcoid img{display:block;}
	</style>

	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
			<h1 class="whatnetcoid">jejaring bisnis</h1>
			<p class="hownetcoid">Menghubungkan pelaku bisnis dengan teknologi dan social media</p>
			<hr>
			
			<div style="width: 978px;" id="ajax-loading-preview"><img src="/www-static/assets/images/ajax-loader.gif" style="display: block; margin: 200px auto;"></div>
			<div class="previewnetcoid">
				<div><?php $views->getIMG('temp/new0.png'); ?>
				<p>Hello, Netcoid adalah jejaring bisnis <i>pertama</i> di Indonesia</p>
				</div>
				<div><?php $views->getIMG('temp/new1.png'); ?>
				<p>Buat <i>profil</i> Perusahaan, Bisnis atau Organisasi anda di www.networks.co.id/bisnisanda</p>
				</div>
				<div><?php $views->getIMG('temp/new4.png'); ?>
				<p>Social. Twitter, Facebook dan Yahoo dalam <i>satu halaman</i></p>
				</div>
				<div><?php $views->getIMG('temp/new3.png'); ?>
				<p>Upload Jasa, Produk atau Portofolio bisnis Anda</p>
				</div>
				<div><?php $views->getIMG('temp/new5.png'); ?>
				<p>Ikuti berita sesuai kebutuhan Anda secara <i>Real-Time</i></p>
				</div>
				<div><?php $views->getIMG('temp/new6.png'); ?>
				<p>Berikan promosi, feedback hingga <i>penawaran</i>. Semua bisa terjadi</p>
				</div>
				<div><?php $views->getIMG('temp/new7.png'); ?>
				<p><i>Konsumisasi</i> Produk anda sebebas - bebasnya</p>
				</div>
				<div><?php $views->getIMG('temp/new2.png'); ?>
				<p>Insights, <i>Pelajari</i> konsumen anda. Lakukan optimasi</p>
				</div>
				<div><?php $views->getIMG('temp/new8.png'); ?>
				<p>Insights, juga mengembalikan kata <i>"its fun"</i> dalam bisnis</p>
				</div>
				<div><?php $views->getIMG('temp/new9.png'); ?>
				<p>Blog bersama, dari kompetisi ke <i>kolaborasi</i></p>
				</div>
			</div>

			<hr>
	</div>
	<!-- CONTENT END -->

<?php $views->js('jquery,middleware/jquery/jquery.cycle','external'); ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	$('#ajax-loading-preview').hide();
	$('.previewnetcoid').fadeIn();
    $('.previewnetcoid').cycle({
		fx: 'scrollLeft', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		speed:    2000,
		timeout:  10000,
		sync: false
	});
});
</script>
