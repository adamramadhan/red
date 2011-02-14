	<div id="red-header">
		<div class="clearfix" id="red-menu">
			<ul id="red-menu-left">
				<li><?php $this->href('/',$this->sessions->get('name')); ?></li>
				<li><?php $this->href('/blog','Blog'); ?></li>
				<li><?php $this->href('/products',l('search')); ?></li>
				<li><?php $this->href('/messages',l('messagecenter')); ?>
			</ul>		
			<ul id="red-menu-right" class="absolutewarp">
				<li><?php $this->href('/'.$this->sessions->get('username'),'Lihat Profil '); ?></li>
				<li id="red-menu-login"><?php $this->href('/logout',l('logout')); ?></li>
			</ul>
		</div>
	</div>