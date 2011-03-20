	<?php $this->validation->geterrors(); ?>
	<div id="red-error-box"></div>
	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="red-login">
			<form accept-charset="utf-8" method="post" >
				<ul>
				<h3>Login</h3>
				<li><label for="username">Username</label> <input type="text" value="" id="input-username" name="username"></li>
				<li><label for="password">Kata Sandi</label> <input type="password" value="" id="input-password" name="password" autocomplete="off"></li>	
				<p><input type="submit" value="Login" name="login" id="button"></p>	
				</ul>			
			</form>
		</div>
		<div id="red-login-information">
			<h3>Partnerships</h3>
			<?php $views->getIMG('icon-domain-id.gif') ?>
			<a rel="nofollow" href="http://xcode.or.id/support.htm"><?php $views->getIMG('partnerships/yogyafree-banner.png') ?></a>
		</div>
	</div>
	<!-- CONTENT END -->