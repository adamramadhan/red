<div id="red-side-menu">
	<ul>
		<ul>
			<li class="iconhome"><?php $views->href('/',l('home')); ?></li>
			<li class="iconedit"><?php $views->href('/edit/profile',l('Profiledata')); ?></li>
			<li class="iconfrontbox"><?php $views->href('/edit/frontbox',l('informationbox')); ?></li>
			<li class="iconconnect"><?php $views->href('/edit/connections',l('connectioncenter')); ?></li>
			<li class="iconadd"><?php $views->href('/edit/product',l('addproduct')); ?></li>
			<li class="iconadd"><?php $views->href('/beta/article','Tulis Artikel'); ?>
			<sup style="font-size: 10px;">beta</sup></li>
			<li class="iconlist"><?php $views->href('/edit/products',l('productlist')); ?></li>
			<li class="iconhelp"><?php $views->href('/help',l('askhelp')); ?></li>
			<li class="iconinsights"><?php $views->href('/beta/insights',l('insights')); ?>
			<sup style="font-size: 10px;">beta</sup></li>
		</ul>
		<li><p id="users-menu-information">Beta*, status beta menunjukan bahwa fitur tersebut masih dalam tahap uji coba.</p></li>
	</ul>
</div>