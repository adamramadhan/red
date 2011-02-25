	<div id="red-header">
		<div class="clearfix" id="red-menu">
			<ul id="red-menu-left">
				<li id="logo"><?php $views->href('/','netcoid'); ?></li>
				<li><?php $views->href('/blog','Blog'); ?></li>
				<li><?php $views->href('/products',l('search')); ?></li>
				<li><?php $views->href('/messages',l('messagecenter')); ?>
				<?php if ($message['countmessage'] != 0): ?>
					<span class="c" id="notification"><?php echo $message['countmessage'] ?></span>						
				<?php endif ?>
			</ul>		
			<ul id="red-menu-right" class="absolutewarp">
				<li><?php $views->href('/'.$this->sessions->get('username'),$this->sessions->get('name')); ?></li>
				<li><?php $views->href('/','Beranda'); ?></li>
				<li id="red-menu-login"><?php $views->href('/logout',l('logout')); ?></li>
			</ul>
		</div>
	</div>