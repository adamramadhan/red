	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="verified">
			<ul class="c" id="information">
				<li class="clearfix"><label>Identity Verified</label><p><strong><?php echo $user['name']; ?></strong> has been verified as the owner or operator of the Web site located at www.networks.co.id/<?php echo $user['username']; ?>. Official records confirm <strong><?php echo $user['name']; ?></strong> as a valid business or an non-profit organization. If you are partners at www.networks.co.id ( mutual followship ), the data should be shown here.</p>
				</li>

				<li class="clearfix"><label>Identitas Terverifikasi</label><p><strong><?php echo $user['name']; ?></strong> telah diverifikasi sebagai pemilik atau sebagai operator di website www.networks.co.id/<?php echo $user['username']; ?>. Data ( KTP, SIUP, atau lainnya ) Menunjukan bahwa <strong><?php echo $user['name']; ?></strong> adalah bisnis atau organisasi non-profit yang valid. Jika anda merupakan partner di di www.networks.co.id ( saling mengikuti ), maka data tersebut seharusnya berada di halaman ini.</p>
				</li>				
			</ul>
			<ul id="meta-information" class="clearfix">
				<li class="l"><i>Bila data ini tidak sesuai segera hubungi security@networks.co.id</i></li>
				<li class="r"><i>Valid hingga <?php echo $user['seal_date'] ?></i></li>
			</ul>
		</div>
	</div>
	<!-- CONTENT END -->