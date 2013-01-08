<?php
if ( !class_exists( 'ScaleUp_Templates_Plugin' ) ) {

    class ScaleUp_Templates_Plugin {

        private static $_this;

        private $templates = array();

        private $_posts = array();

        function __construct() {
            self::$_this = $this;
            add_action( 'template_include', array( $this, 'template_include') );
        }

        static function template_include( $template ) {

            $instance = ScaleUp_Templates_Plugin::this();

            if ( ( is_single() || is_page() ) && $instance->has_template( get_the_ID() ) ) {
                $selected_template = '';
                $scaleup_template = $instance->get_template( get_the_ID() );
                if ( $scaleup_template )
                    $selected_template = $instance->select( $scaleup_template );
                if ( $selected_template )
                    $template = $selected_template;
            }

            return $template;
        }

        /**
         * Apply a specific template to a post
         *
         * @param $post_id int
         * @param $template
         */
        function apply( $post_id, $template ) {
            $this->_posts[ $post_id ] = $template;
        }

        /**
         * Return true if post with id $post_id has a ScaleUp Template
         *
         * @param $post_id int
         * @return bool
         */
        function has_template( $post_id ) {
            return ( !empty( $this->_posts ) && in_array( $post_id, array_keys( $this->_posts ) ) );
        }

        /**
         * Return template assigned to specific post_id
         *
         * To get the final template after applying Template Hierarchy, you must run the result of thing function on
         * $this->select function. eg: $this->select( $this->get_template( $post_id ) )
         *
         * @param $post_id
         * @return array|false array containing path and template or false if not found
         */
        function get_template( $post_id ) {
            if ( isset( $this->_posts[ $post_id ] ) ) {
                $template = $this->_posts[ $post_id ];
                $template = $this->templates[ $template ];
                return $template;
            }
            return false;
        }

        /**
         * Returns path to template after applying the Template Hierarchy
         *
         * Template Hierarchy:
         *      1. Child theme template
         *      2. Parent theme template
         *      3. Original template
         *
         * @param $template array path to selected template
         * @return string
         */
        function select( $template ) {

            $theme_template = $template;

            // check if template exists in child theme directory
            if ( is_child_theme() ) {
                $theme_template[ 'path' ]   = get_stylesheet_directory();
                if ( $this->template_exists( $theme_template ) ) {
                    return $this->make_path( $theme_template );
                }
            }

            // check if template exists in parent theme directory
            $theme_template[ 'path' ]   = get_template_directory();
            if ( $this->template_exists( $theme_template ) ) {
                return $this->make_path( $theme_template );
            }

            return $this->make_path( $template );
        }

        /**
         * Register a template at specified path to ScaleUp Templates
         * @param $path string absolute path prefix to $template ( without trailing slash )
         * @param $template string prefix with / forward slash
         */
        function register( $path, $template ) {
            $this->templates[ $template ] = array(
                'path'      => $path,
                'template'  => $template
            );
        }

        static function this(){
            return self::$_this;
        }

        /**
         * Combine template path and template name and return complete path
         *
         * @param $template array with elements path and template
         * @return string absolute path to the template
         */
        private function make_path( $template ) {

            $path = '';
            if ( !is_array( $template ) )
                return $path;

            if ( !isset( $template['path'] ) && !isset( $template['template'] ) )
                return $path;

            return $template['path'] . $template['template'];
        }

        /**
         * Return true if template exists, otherwise return false
         *
         * @param $template array with path element and template element
         * @return bool
         */
        private function template_exists( $template ) {
            $template_path = $this->make_path( $template );
            return ( !empty( $template_path ) && file_exists( $template_path ) );
        }

    }

}
$scaleup_templates = new ScaleUp_Templates_Plugin;