	<?php $this->validation->geterrors(); ?>
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<h3>Kirim Pesan</h3>
		
		<form accept-charset="utf-8" method="post" action="/messages?id=<?php echo $_GET['id']; ?>" >
			<ul id="wide-input">
				<li><?php $this->forms->input('subject','text','Subject'); ?></li>
				<li><?php $this->forms->input('message','textarea',l('message')); ?></li>
			</ul>
			<p><input type="submit" value="Kirim" name="send" id="button"></p>
		</form>	
	</div>
	<!-- CONTENT END -->
