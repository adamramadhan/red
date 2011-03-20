	<div id="red-header">
		<div class="clearfix" id="red-menu">
			<ul id="red-menu-left">
				<li id="logo"><a href="/"><?php $views->getIMG('logo2.png','width="75px" height="20px"'); ?></a></li>
				<li><?php $views->href('/blog','Blog'); ?></li>
				<li><?php $views->href('/products',l('search')); ?></li>
				<li><?php $views->href('/messages',l('messagecenter')); ?>
				<?php if ($message['countmessage'] != 0): ?>
					<span class="c" id="notification"><?php echo $message['countmessage'] ?></span>						
				<?php endif ?>

				<?php if (config('features/comments/mentions')): ?>
					<li><?php $views->href('/mentions',l('mentionscenter')); ?>
					<?php if ($mentions['countmentions'] != 0): ?>
						<span class="c" id="notification"><?php echo $mentions['countmentions'] ?></span>
					<?php endif ?>					
				<?php endif ?>

			</ul>		
			<ul id="red-menu-right" class="absolutewarp">
				<li><?php $views->href('/'.$this->sessions->get('username'),$this->sessions->get('name')); ?></li>
				<li id="red-menu-login"><?php $views->href('/logout',l('logout')); ?></li>
			</ul>
		</div>
	</div>