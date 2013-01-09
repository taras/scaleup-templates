<?php
/*
 * Plugin Name: ScaleUp Templates
 */

define( 'SCALEUP_TEMPLATES_DIR', dirname( __FILE__ ) );
define( 'SCALEUP_TEMPLATES_VER', '0.1.1' );
define( 'SCALEUP_TEMPLATES_MIN_PHP', '5.2.4' );
define( 'SCALEUP_TEMPLATES_MIN_WP', '3.4' );

require_once( SCALEUP_TEMPLATES_DIR . '/classes/class-plugin-base.php' );
require_once( SCALEUP_TEMPLATES_DIR . '/functions.php' );
require_once( SCALEUP_TEMPLATES_DIR . '/template-tags.php' );