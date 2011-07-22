	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div class="c" id="red-content-secure">
			<h3>Keamanan & Kenyamanan</h3>
			<form id="form-register" accept-charset="utf-8" method="post" >
			<ul>
				<li><?php echo $this->recaptcha->get_html(null,true); ?></li>
			</ul>
			<p><input type="submit" value="Setuju &amp; Registrasi" name="secure" id="button"></p>
			</form>
		</div>				
	</div>
	<!-- CONTENT END -->