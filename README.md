# ScaleUp Templates Plugin for WordPress

* This plugin is in concept stage - do not use. *

This plugin was designed for Site Builders and Theme Developers. This plugin is not designed for regular WordPress users.

ScaleUp Templates Plugin will provide a collection of useful page templates. These templates can be overwritten in parent
and child theme the same way that you would usually overwrite a parent template in child theme.

## How to use this plugin?

After you installed this plugin, you can use a global $scaleup_templates variable to call apply method to apply this
plugin's template to the post.

Here is a complete example for a child theme of Twentytwelve theme

    global $scaleup_templates;

    // apply method takes two parameters: post_id and name of the template from the theme.
    $scaleup_templates->apply( 2, '/one-page.php' );

You can overwrite the output of this template by copying this template from the plugin into your child directory and modifying it.
After you copied the template file, WordPress will automatically use the template from your child theme instead of the plugin directory.

## Why did you create this plugin?

At the moment, there is no good way of reusing page layouts from one project to another. This plugin will provide some
useful templates. More importantly, if this pattern validates then this plugin could be an example of how other
plugin could provide templates that developers could overwrite in the parent. I could also package this as a library and
enable theme developers to create their own plugins with collections of templates that they can reuse on projects.

## What API does this plugin provide?

This plugin provides an API that allows a WordPress Developer to add hi/her own templates that can be overwritten in the theme.
To do this, create the developer would have to create a plugin hooks to plugins_loaded and calls a function that does the following:

    global $scaleup_templates;

    // register method takes path and template as parameters. 2nd parameter must be prefixed with /
    $scaleup_templates->register( dirname( __FILE__ ), '/your-template.php' );

    // you can also include templates in subdirectories
    $scaleup_templates->register( dirname( __FILE__ ), '/neat/mytemplate.php' );


