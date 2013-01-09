<?php

if ( !function_exists( 'register_scaleup_template' ) ) {

    /**
     * Register a template located at $path + $template_name
     *
     * $template_name must start with forward slash / and may contain one or more directories.
     *
     * For example: /simple.php, /form/simple.php or /gravityforms/form/simple.php
     *
     * @param $path
     * @param $template_name
     */
    function register_scaleup_template( $path, $template_name ) {
        $scaleup_templates = ScaleUp_Templates_Plugin::this();
        $scaleup_templates->register( $path, $template_name );
    }

}