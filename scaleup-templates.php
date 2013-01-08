<?php
/*
 * Plugin Name: ScaleUp Templates
 */

define( 'SCALEUP_TEMPLATES_DIR', dirname( __FILE__ ) );
define( 'SCALEUP_TEMPLATES_VER', '0.0.0' );
define( 'SCALEUP_TEMPLATES_MIN_PHP', '5.2.4' );
define( 'SCALEUP_TEMPLATES_MIN_WP', '3.4' );

require_once( SCALEUP_TEMPLATES_DIR . '/classes/class-plugin-base.php' );

$scaleup_templates->register( SCALEUP_TEMPLATES_DIR, '/one-page.php' );