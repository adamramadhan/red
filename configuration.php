<?php
# FAQS CONFIGURATION 1.1
$config['development'] = TRUE;
$config['language'] = 'indonesia';
$config['folder'] = '';
$config['compress'] = TRUE;

# FAQS CONFIGURATION 1.2
$config['database'] = array(
	'application' => array(
		'driver'     => 'mysql',
		'host'		 =>	'127.0.0.1',
		'name'		 => 'networks2',
		'username'   => 'root',
		'password'   => 'networks2010',
		'persistent' => FALSE,
	)
);

# FAQS CONFIGURATION 1.3
$config['features'] = array(
		'core/index',
		'profiles/index',		
		'blog'
);

# FAQS CONFIGURATION 1.4
# http://en.wikipedia.org/wiki/Middleware
$config['middleware'] = array(
		'recaptcha',
		'googlemaps',		
		'github',  
		'37signals',
		'examples'
);

# FAQS CONFIGURATION 1.5
$config['sessions'] = array(
		'gc_probability' => '0',
		'gc_divisor' => '100',
		'hash_function' => 'SHA512',
		'gc_maxlifetime' => '1800'
);
?>




