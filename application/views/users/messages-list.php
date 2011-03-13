
	<!-- CONTENT START -->
	<div class="clearfix" id="red-content">

		<!-- FORM START -->
		<div id="red-edit-full">
			
		<?php 	
		if ( !empty($messages) ) {		
			foreach ($messages as $message) {
			echo 	'<div class="clearfix iconmessage" id="message">
					<div id="subuser">'.$message['name'].'</div>
					<div id="subname">'.$message['subject'].'</div>
					<div id="subtime">'.$this->time->formatDateDiff($message['timecreate']).'</div>
							<div class="c" id="suboptions"><a href="/messages?d='.$message['mid'].'">Hapus</a></div>
							<div class="c" id="suboptions"><a href="/messages?mid='.$message['mid'].'">Lihat</a></div>
					</div>';
			}
		}

		if ( !empty($archives) ) {		
			foreach ($archives as $message) {
			echo 	'<div class="clearfix iconarchive" id="archive">
					<div id="subuser">'.$message['name'].'</div>
					<div id="subname">'.$message['subject'].'</div>
					<div id="subtime">'.$this->time->formatDateDiff($message['timecreate']).'</div>
							<div class="c" id="suboptions"><a href="/messages?d='.$message['mid'].'">Hapus</a></div>
							<div class="c" id="suboptions"><a href="/messages?mid='.$message['mid'].'">Lihat</a></div>
					</div>';
			}
		}

		if ( empty($messages) && empty($archives) ) {	
			echo 	'<div class="c" id="red-box-red">
					<p>Komunikasi <em>simple</em> tampa perantara adalah salah satu tujuan kami, anda mendapat pesan ini karena anda belum mendapatkan
					message dari organisasi lain, anda dapat mengirim pesan dengan melihat profile organisasi yang dituju, 
					pilih kirim pesan, masukan subject dan message.</p>
					</div>';
							
		}	
		?>
		</div>
		<!-- INFORMATION ENDS -->		
		
		<!-- ADS & MENU START -->
		<?php $this->view('users/menu-right'); ?>	
		<!-- ADS & MENU END -->
		
	</div>
	<!-- CONTENT END -->
	
