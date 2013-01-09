# ScaleUp Templates Plugin for WordPress

**This plugin is under active development and API will change. All feedback is welcome.**

ScaleUp Templates provides an API that allows plugin developers to include templates with their plugins. Site builders can include these templates using get_template_part or by applying a template to a post.

See if you can read the following code to check if this plugin is for you:

```php
if ( in_array( $you, array( 'Plugin developer', 'Theme developer', 'Site builder' ) ) {
    echo 'This plugin is for you!';
}
```

## For plugin developers 

### How do I include a template to be used by a site builder or theme developer?

1. Create a template file somewhere in your plugin directory. This template can be in your plugins root or sub directory.
2. Hook a callback function to after_setup_theme hook with the following code:

```php
function yourprefix_after_setup_theme() {
    // get instance of ScaleUp Templates plugin
    $scaleup_templates = ScaleUp_Templates_Plugin::this();

    // when scaleup_templates plugin is installed
    if ( $scaleup_templates ) {
        // register your template by providing path to your template and template name
        $scaleup_templates->register( dirname( __FILE__ ), '/your-template.php' );
    }
}
add_action( 'after_setup_theme', 'yourprefix_after_setup_theme' );
```

*Note*: template_name must start with forward slash / and end with php extension. Template name is what Site Builder will
need to use with get_template_part. If you place your template into a sub directory then you can include in template name
or include it as part of the $path.

*Note 2*: If you're prefixing your callback functions, then I highly recommend that you read Mike Schinkel's [Using Classes as Code Wrappers for WordPress Plugins](http://hardcorewp.com/2012/using-classes-as-code-wrappers-for-wordpress-plugins/) and [Enabling Action and Filter Hook Removal from Class-based WordPress Plugins](http://hardcorewp.com/2012/enabling-action-and-filter-hook-removal-from-class-based-wordpress-plugins/) on [HardcoreWP.com](http://hardcorewp.com)

*Note 3*: Please, tell your users that you're using ScaleUp Templates to provide a way to overwrite your templates so they'll know how to use them :)

## For site builders and theme developers

### How do I use a template that's provided by a plugin that uses ScaleUp Templates?

1. Install ScaleUp Templates Plugin on your site
2. In your theme's functions.php file, use get_template_part to call the template that you want

```php
get_template_part( '/templatename.php' );
```

*Note:* Template Name starts with forward slash /

If you want to load the template when a post loads without using get_template_part then you can use the **$scaleup_templates->apply(** *$post_id* **,** *$template_name* **)**

```php
global $scaleup_templates;
$scaleup_templates->apply( 2, '/templatename.php' );
```

### How do I overwrite a plugin's template?

You can overwrite a template that's provided by a plugin in the parent or child theme by copying the template from the plugin into the theme.

If template name contains a directory then you must create that directory in your theme.

## Why did you create this plugin?

There is no standard way of including templates in a plugin. This makes it difficult to create sites that leverage plugins that were developed by other developers. I want to make this easier and allow us to leverage each other's work. This plugin is an attempt to do this.

