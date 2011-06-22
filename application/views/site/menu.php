	<div id="red-header">
		<div class="clearfix" id="red-menu">
			<ul id="red-menu-left">
				<li id="logo"><a href="/"><?php $views->getIMG('logo2.png','width="75px" height="20px"'); ?></a></li>
				<li><?php $views->href('/blog','Blog'); ?></li>
				<li><?php $views->href('/products','Pencarian'); ?></li>
			</ul>		
			<ul id="red-menu-right" class="absolutewarp">
				<li id="red-menu-signup"><?php #$views->href('/signup',l('signup')); ?></li>
				<li id="red-menu-login"><?php $views->href('/login',l('login')); ?></li>
			</ul>
		</div>
	</div>
	<!-- HEADER END -->