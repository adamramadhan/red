
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">
		<div id="red-reset">
			<form accept-charset="utf-8" method="post" >
				<ul>
				<h3>Reset Password</h3>
				<li id="important">Hello, <strong><?php echo $user['name']; ?></strong> atau <strong><?php echo $user['username']; ?></strong> anda dapat mereset password anda dengan menulis ulang password yang diinginkan, password reset ini berlaku sekali.</li>
				<li><label for="password">Kata Sandi</label> <input type="password" value="" id="input-password" name="password" autocomplete="off"></li>	
				<p><input type="submit" value="Reset" name="reset" id="button"></p>	
				</ul>			
			</form>
		</div>
	</div>
	<!-- CONTENT END -->