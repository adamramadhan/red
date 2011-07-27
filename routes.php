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
$routes['nojs'] = 'core:nojs';
#$routes['default'] = 'core:index';

#fitur profiles ke method index
$routes['^[a-zA-Z0-9_]{6,20}$'] = 'profiles:index';
#HQ
$routes['^HQ|hq$'] = 'profiles:index';

#mobile ( lagi riset sementara di blog inject css mobile display none untuk yang gak perlu)
#$routes['m/blog'] = 'mobile:blog';

$routes['blog'] = 'blog:index';
$routes['home'] = 'site:index';
$routes['secure'] = 'secure:index';
$routes['signup'] = 'site:signup';
$routes['login'] = 'login:index';
$routes['terms'] = 'site:terms';
$routes['privacy'] = 'site:privacy';
$routes['welcome'] = 'site:welcome';
$routes['why'] = 'site:why';
$routes['allstars'] = 'site:allstars';
$routes['reset'] = 'site:reset';
$routes['default'] = 'site:index';

$routes['verify'] = 'verify:index';
$routes['^verify/[a-zA-Z0-9_]{6,20}$'] = 'verify:profile';

#edit
$routes['logout'] = 'site:logout';
#$routes['edit/profile'] = 'edit:profile';
$routes['edit/frontbox'] = 'edit:frontbox';
$routes['edit/connections'] = 'edit:connections';
$routes['edit/product'] = 'edit:product';

$routes['edit/products'] = 'editv2:ListProducts';
$routes['edit/profile'] = 'editv2:EditProfile';
$routes['edit/product'] = 'editv2:Products';

$routes['beta/article'] = 'edit:article';


#v2 edit


#products
$routes['product'] = 'products:single';
$routes['products'] = 'products:all';
$routes['^products/[a-zA-Z]{1,20}$'] = 'products:all';
$routes['^products/[a-zA-Z]{1,20}/[a-zA-Z]{1,20}$'] = 'products:all';

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
$routes['admin/groups'] = 'admin:grouplist';


#ajax Routes
$routes['ajax/refresh'] = 'ajax:getProductDiff';
$routes['ajax/analytics/push'] = 'ajax:setAnalytics';
$routes['ajax/social/pull/points'] = 'ajax:getSocialPoints';
$routes['ajax/social/pull/facebook'] = 'ajax:getSocialFacebook';
$routes['ajax/social/pull/yahoo'] = 'ajax:getSocialYahoo';
$routes['ajax/social/pull/twitter'] = 'ajax:getSocialTwitter';
$routes['ajax/social/pull/search'] = 'ajax:getSocialSearch';
$routes['ajax/social/pull/trends'] = 'ajax:getGoogleTrend';

#$routes['area51/([a-zA-Z0-9_]+)'] = 'test:$1';
$routes['area51/home'] = 'test:home';
$routes['area51/hello'] = 'test:hello';
$routes['development'] = 'test:github';
$routes['beta/insights'] = 'test:getAnalytics';
$routes['area51/flush'] = 'test:flush';
$routes['area51/groups'] = 'test:groups';
#$routes['area51/analytics'] = 'test:analytics';
#ok lanjut milih folder blog untuk skala blilitas tp class ada dua ? sebenernya satu tp tiap didalam core masak ada classnya ? ntar banyak filenya
#kenapa ga di jadiin method aja ?
?>