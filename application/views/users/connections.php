	<?php $this->validation->geterrors(); ?>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- FORM START -->
		<div id="red-edit-left">
			<h3>Data Koneksi</h3>
			<form accept-charset="utf-8" method="post" action="#" >
			<ul>
				<li><?php $this->forms->textinput('twitter',l('twitter'), array( 'value' => $user['twitter'])); ?></li>
				<li><?php $this->forms->textinput('yahoo',l('yahoo'), array( 'value' => $user['yahoo'])); ?></li>
			</ul>
			<p><input type="submit" value="Ubah" name="edit" id="button"></p>
			</form>
		</div>
		<!-- FORM ENDS -->
		
		<!-- INFORMATION START -->
		<div id="red-edit-right">
		<ul id="connect-status">
		<li class="c" id="twitter"><?php echo $this->social->get_twitter($user['twitter']); ?></li>
		<li class="c" id="yahoo"><?php echo $this->social->get_yahoo($user['yahoo']); ?></li>
		</ul>
		</div>
		<!-- INFORMATION ENDS -->			
		
		<!-- ADS & MENU START -->
		<?php $this->view('users/ads'); ?>	
		<?php $this->view('users/menu-right'); ?>
		<!-- ADS & MENU START -->

	</div>
	<!-- CONTENT END -->