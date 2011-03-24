		<div id="red-side-menu">
			<ul>
				<li><h4>Pengguna</h4></li>
				<ul>
					<li><?php $views->href('/admin/verify','Non Verified'); ?></li>
					<li><?php $views->href('/admin/unverify','Verified'); ?></li>
					<li><?php $views->href('/admin/reset','Reset Password'); ?></li>
				</ul>
				<li><h4>Blog</h4></li>
				<ul>
					<li><?php $views->href('/admin/blog','List Post'); ?></li>
					<li><?php $views->href('/admin/newpost','Tambah Post'); ?></li>
				</ul>
			</ul>
		</div>