<?php  
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
$routes['(a-zA-Z0-9_+)'] = 'profiles:index';
$routes['blog'] = 'blog:index';
$routes['home'] = 'site:index';
$routes['secure'] = 'secure:index';
$routes['login'] = 'login:index';
$routes['terms'] = 'site:terms';
$routes['welcome'] = 'site:welcome';
$routes['why'] = 'site:why';
$routes['default'] = 'site:index';

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

#admin Routes
$routes['admin'] = 'admin:index';
$routes['admin/blog'] = 'admin:blog';
$routes['admin/newpost'] = 'admin:newpost';

#ok lanjut milih folder blog untuk skala blilitas tp class ada dua ? sebenernya satu tp tiap didalam core masak ada classnya ? ntar banyak filenya
#kenapa ga di jadiin method aja ?
?>