<?php

if ( !function_exists( 'optionsframework_init' ) ) {

	/*-----------------------------------------------------------------------------------*/
	/* Options Framework Theme
	/*-----------------------------------------------------------------------------------*/

	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

		// DIRECTORIES
		if ( STYLESHEETPATH == TEMPLATEPATH ) {
			define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/inc/admin/');
			define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/inc/admin/');
			define('OF_FILEPATH', TEMPLATEPATH);
			define('OF_DIRECTORY', get_bloginfo('template_directory'));
		} else {
			define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/inc/admin/');
			define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/inc/admin/');
			define('OF_FILEPATH', STYLESHEETPATH);
			define('OF_DIRECTORY', get_bloginfo('stylesheet_directory'));
		}
		
		define('GABFIRE_INC_PATH', OF_FILEPATH . '/inc');
		define('GABFIRE_INC_DIR', OF_DIRECTORY . '/inc');
		define('GABFIRE_FUNCTIONS_PATH', OF_FILEPATH . '/inc/functions');
		define('GABFIRE_JS_DIR', OF_DIRECTORY . '/inc/js');

		// OPTION PANEL
		require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');		
		require_once (GABFIRE_INC_PATH . '/theme-init.php'); // Custom functions and plugins
}