	<?php $this->validation->geterrors(); ?>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		
		<div id="red-edit-left-wide">
			<h3>Pusat Bantuan</h3>
			<form accept-charset="utf-8" method="post" action="/help" >
				<ul id="wide-input">
					<li><?php $this->forms->textinput('subject','Subject'); ?></li>
					<li><?php $this->forms->textarea('message',l('message'), array( 
							  'cols' => '17',
							  'rows' => '5')); ?></li>
				</ul>
				<p><input type="submit" value="Kirim" name="send" id="button"></p>
			</form>	
		</div>		

		<div id="red-edit-right">
			FAQ sedang kami sortir
		</div>				
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>		
		<!-- ADS & MENU END -->
	</div>
	<!-- CONTENT END -->
