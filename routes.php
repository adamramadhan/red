<?php
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
/**
 * ROUTES
 * yang bawah menimpa yang diatas
 * bisa kaya $routes['([a-z]+)'] = '$1';
 * @author DAMS
 */

# Core Routes
$routes['404'] = 'core:missing';
$routes['503'] = 'core:off';
#$routes['default'] = 'core:index';


#fitur profiles ke method index
$routes['^[a-zA-Z0-9_]{6,20}$'] = 'profiles:index';
#mobile
$routes['mobile'] = 'mobile:index';
$routes['blog'] = 'blog:index';
$routes['home'] = 'site:index';
$routes['secure'] = 'secure:index';
$routes['login'] = 'login:index';
$routes['terms'] = 'site:terms';
$routes['welcome'] = 'site:welcome';
$routes['why'] = 'site:why';
$routes['allstars'] = 'site:allstars';
$routes['reset'] = 'site:reset';
$routes['default'] = 'site:index';

$routes['verify'] = 'verify:index';
$routes['^verify/[a-zA-Z0-9_]{6,20}$'] = 'verify:profile';

#edit
$routes['logout'] = 'site:logout';
$routes['edit/profile'] = 'edit:profile';
$routes['edit/frontbox'] = 'edit:frontbox';
$routes['edit/connections'] = 'edit:connections';
$routes['edit/product'] = 'edit:product';
$routes['edit/products'] = 'edit:products';

#products
$routes['product'] = 'products:single';
$routes['products'] = 'products:all';

#social
$routes['social/follow'] = 'social:follow';
$routes['social/unfollow'] = 'social:unfollow';

#social
$routes['messages'] = 'messages:all';

#help
$routes['help'] = 'help:index';

#comments & mentions
if (config('features/comments/core')) {
	$routes['comments'] = 'comments:index';
	if (config('features/comments/mentions')) {
		$routes['mentions'] = 'mentions:index';
	}
}

#admin Routes
$routes['admin'] = 'admin:index';
$routes['admin/reset'] = 'admin:reset';
$routes['admin/blog'] = 'admin:blog';
$routes['admin/newpost'] = 'admin:newpost';
$routes['admin/unverify'] = 'admin:listverified';
$routes['admin/verify'] = 'admin:listunverified';
$routes['admin/useredit'] = 'admin:useredit';

#ok lanjut milih folder blog untuk skala blilitas tp class ada dua ? sebenernya satu tp tiap didalam core masak ada classnya ? ntar banyak filenya
#kenapa ga di jadiin method aja ?
?>