<?php
// Load WordPress test environment
// https://github.com/nb/wordpress-tests
//

$env_path = '';
/**
 * We don't want to include wordpress-tests as a part of distribution,
 * There's some configuration required, and also one could nuke their production
 * By accident, which is not cool. 
 *
 * So before running phpunit, you need to set WP_TESTS_PATH env variable
 * @see $path
 */
if ( getenv( 'WP_TESTS_PATH' ) ) {
	$env_path = getenv( 'WP_TESTS_PATH' );
}

// This is my hardcoded path, probably will be removed
$path = '/Users/rinatk/Sites/wp-tests/init.php';

if( file_exists( $env_path ) ) 
    require_once $env_path;
elseif ( file_exists( $path ) ) 	
	require_once $path;
else 
    exit( "Couldn't find path to wordpress-tests/init.php\n" .
		  "Consider setting WP_TESTS_PATH env variable\n" .
		  "*nix based systems: export WP_TESTS_PATH=/your/path/to/wordpress-tests/init.php (with filename)\n\n" );

// Load our class, not sure why it should be loaded
// First time PHPUnit derp

require_once( dirname( dirname(__FILE__) ) .'/ad-code-manager.php' );