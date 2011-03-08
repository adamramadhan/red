	<!-- CONTENT START -->
	<div class="clearfix background" id="red-content">
		<div id="verified">
			<ul>
				<li class="clearfix"><label>Nama</label><p><?php echo $user['name']; ?></p></li>
				<li class="clearfix"><label>Status</label><p>TIDAK TERVERIFIKASI</p></li>
				<?php if (!empty($user['address'])): ?>
					<li class="clearfix"><label>Alamat</label><p><?php echo $user['address']; ?></p></li>
					<li class="clearfix"><?php $this->googlemaps->show(); ?></li>
				<?php endif ?>	
				<li class="clearfix"><label>Kontak</label><p>08999252530</p></li>
			</ul>
			<ul class="c" id="notverified">
				<li class="clearfix"><label>Identity NOT Verified</label><p><strong><?php echo $user['name']; ?></strong> <span id="important">is not verified</span> as the owner or operator of the Web site located at www.networks.co.id/<?php echo $user['username']; ?>. <span id="important">No official records</span> confirm <strong><?php echo $user['name']; ?></strong> as a valid business or an non-profit organization. If you are the owner or legal officials please contact hello@networks.co.id.</p>
				</li>

				<li class="clearfix"><label>Identitas NOT Terverifikasi</label><p><strong><?php echo $user['name']; ?></strong> <span id="important">Belum diverifikasi</span> sebagai pemilik atau sebagai operator di website www.networks.co.id/<?php echo $user['username']; ?>. <span id="important">Tidak Terdapat Data</span> ( KTP, SUIP, atau lainnya ) Menunjukan bahwa <strong><?php echo $user['name']; ?></strong> adalah bisnis atau organisasi non-profit yang valid. Jika anda merupakan pemilik atau badan yang berwenang tolong konfimasi di hello@networks.co.id.</p>
				</li>
			</ul>
				<p><i>Bila data ini tidak sesuai segera hubungi security@networks.co.id</i></p>


		</div>
	</div>
	<!-- CONTENT END -->