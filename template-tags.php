<?php
if ( !function_exists( 'apply_scaleup_template' ) ) {

    /**
     * Apply ScaleUp Template by name $template_name to post with id $post_id
     *
     * @param $post_id
     * @param $template_name
     */
    function apply_scaleup_template( $post_id, $template_name ) {
        $scaleup_templates = ScaleUp_Templates_Plugin::this();
        $scaleup_templates->apply( $post_id, $template_name );
    }

}