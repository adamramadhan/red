	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- FORM START -->
		<div class="clearfix" id="red-edit-left-wide">
		<h2><?php echo $message['subject']; ?></h2>
		
		<p id="ptime"><?php echo strftime("%A, %d %B %Y pada %X ",strtotime($message['timecreate']));  ?></p>
		<hr/>
		<p><?php echo $message['message']; ?></p>
			<hr class="clear" /><p><?php echo '<span class="l">'.$message['name'].
			'</span><a class="r" href="/messages?id='. $message['suid'] .'">Balas</a>' ?></p>
		</div>
		<!-- INFORMATION ENDS -->		
		
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU END -->
		
	</div>
	<!-- CONTENT END -->
