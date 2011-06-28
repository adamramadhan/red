<div style="height: 30px; background: none repeat scroll 0pt 0pt rgb(255, 255, 255); border-bottom: 1px solid rgb(231, 231, 231); color: rgb(68, 68, 68);"><p style="margin: 0pt auto; width: 960px; text-align: center; line-height: 29px;">
 <?php echo $socialpoint; ?> / 1000 ♥ Netcoid <span style="background: none repeat scroll 0% 0% rgb(254, 255, 203); padding: 3px 10px;">Invitasi #3 ditutup. Dukung kami berkembang, follow <a style="color: rgb(211, 46, 46);" href="http://www.twitter.com/netcoid" target="_blank">twitter</a>, like <a style="color: rgb(211, 46, 46);" target="_blank" href="http://www.facebook.com/netcoid">facebook</a> atau ikuti <a style="color: rgb(211, 46, 46);" target="_blank" href="/development">perkembangan</a> kami.</span></p></div></div>

<?php $views->CSS('buttons.v1','blog') ?>	
	<style type="text/css" media="screen">
	.helloworld {
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
	.benefits .left{width: 300px;
margin-right: 20px;}
	.benefits .mid{width:320px;}
	.benefits .right{width: 300px;
margin-left: 20px;}
.blog-post{padding:0;}
.blog-post h3{border:none;}
.netcoid-start a:hover{text-decoration:none;}
	</style>

	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
			<h1 class="helloworld">jejaring bisnis</h1>
			<p class="hownetcoid"><u>Menghubungkan pelaku bisnis dengan teknologi dan social media</u></p>
			<hr>
			
			<div class="blog-post benefits clearfix">
					<div class="left l">
						<h3>Business</h3>
						<p>Partisipasi dalam jejaring bisnis indonesia, dimana Anda bisa <i>membeli, menjual, mencari dan dicari</i> Pelaku bisnis lainnya.</p>
						<?php $views->getIMG('temp/hello1.png') ?>
						<ul>
							<li>Upload Produk anda</li>
							<li>Aman dan Mudah</li>
							<li>Shared Blog</li>
						</ul>
						<?php $views->getIMG('temp/hello4.png') ?>
					</div>
					<div class="mid l"><h3>Social</h3><p>Telusuri & Ikuti Pelaku bisnis lainnya dengan satu klik <i>"ikuti"</i>. <i>promosi, blog dan produk terbaru</i> pelaku bisnis yang Anda ikuti teringkas dalam satu halaman. </p>
					<?php $views->getIMG('temp/hello2.png') ?></div>		
					<div class="right l"><h3>Insights</h3><p>Pelajari penunjung anda, lakukan optimasi, tingkatkan penjualan anda. ( Real-time )</p>
					<?php $views->getIMG('temp/hello3.png') ?>
					<p>
					<ul>
					<li>Jumlah Penunjung Anda</li>
					<li>Produk Yang paling diminati</li>
					<li><a target="_blank" href="/products/fashion/tshirt">Pelajari trend yang sedang terjadi</a></li>
					</ul>
					</p></div>			
			</div>
			<hr>
			
			<div class="netcoid-start">
					<p style="text-align: center;"><a href="/signup"><input class="button cupid-green" type="submit" value="Signup" name="register" id="button"></a></p>
			</div>
			
	</div>
	<!-- CONTENT END -->

<?php $views->js('jquery,middleware/jquery/jquery.cycle','external'); ?>
