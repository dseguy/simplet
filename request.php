<?php



////   Set the Default Timezone.

// Note: GMT is deprecated. Use UTC instead.
date_default_timezone_set('UTC');



////   Set the Inclusion Path

// Add Windows Support
if (!defined('PATH_SEPARATOR')) {
	if (strpos($_ENV['OS'], 'Win') !== false) define('PATH_SEPARATOR', ';');
	else define('PATH_SEPARATOR', ':');
}

// Set Include_Path
$Include_Path = get_include_path().PATH_SEPARATOR.__DIR__.PATH_SEPARATOR.__DIR__.DIRECTORY_SEPARATOR.'broadcast'.PATH_SEPARATOR.__DIR__.DIRECTORY_SEPARATOR.'public_html';
set_include_path($Include_Path);



//// Include the Configuration
include 'config.php';
// This is not require because it might fail if not yet installed.
// `once.connect.php` will handle failures, to some extent.



//
$Place = parse_url($Sitewide_Root);

$Request = parse_url($Place['scheme'].'://'.$Place['host'].$_SERVER['REQUEST_URI']);

if ($PHP_Strip && substr($Request['path'], -4, 4) == '.php') {
	header ('HTTP/1.1 301 Moved Permanently');
	header ('Location: '.$Sitewide_Root.$Canonical);
}

$Time = time();

$Post_Types = array('Page', 'Blog', 'Blog Index', 'Blog Category', 'Blog Post', 'Forum', 'Forum Index', 'Forum Category', 'Forum Topic');

require 'once.connect.php';
require 'once.auth.php';

require 'libs/Parsedown.php';

require 'function.stringgenerator.php';
require 'function.passhash.php';
require 'function.jsondo.php';
require 'function.responses.php';
require 'function.respond.php';
require 'function.viewcount.php';
require 'function.trending.php';
require 'function.blog.php';
require 'function.categories.php';
require 'function.globrecursive.php';
require 'function.runonce.check.php';
require 'function.runonce.create.php';

// Count View
// Forums have Categories and Topics, and should be counted later.
if ($Post_Type !== 'Forum') ViewCount();
