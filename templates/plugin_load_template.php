<?php
/**
 * Load the template file by name. Detects if the template has an override or not.
 * 
 * @param  string $template 		The template name without .php
 * @param  string $plugin_folder 	The custom folder inside a theme where the template is located. 
 * @param  boolean $do_not_sanitize Default false. Set to true to not sanitize $template and $plugin_folder. If set true, please sanitize the data yourself when you pass user input into this function.
 * @author  Daniel Koop <mail@danielkoop.me>
 * @license  MIT
 * @copyright  2015 Daniel Koop
 */
function mrkoopie_load_template($template, $plugin_folder, $do_not_sanitize = false)
{
	if($do_not_sanitize == false)
	{
		// Secure the filename
		$template 		= sanitize_file_name($template);

		// Secure the folder
		$plugin_folder 	= sanitize_file_name($plugin_folder);
	}

	// Check if we have an override from the theme folder
	if ( $overridden_template = locate_template( $plugin_folder . '/' . $template . '.php' ) ) {
		// locate_template() returns path to file
		// if either the child theme or the parent theme have overridden the template
		$plugin_template_location = $overridden_template;

	} else {
		// If neither the child nor parent theme have overridden the template,
		// we load the template from the 'templates' sub-directory of the directory this file is in
		$plugin_template_location = dirname( __FILE__ ).'/../../templates/' . $template . '.php';
	}

	load_template( $plugin_template_location );
}
