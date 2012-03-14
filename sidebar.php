<?php 
	/* Sidebar Widget 1 */
	if (is_home()) 
	{
		gab_dynamic_sidebar( 'Sidebar1-Home' ); 
	} 
	else 
	{
		gab_dynamic_sidebar( 'Sidebar1-Innerpage' );
	}

	/* Sidebar Top Ad */
	if ( of_get_option('of_sn_ad2') <> "" ) 
	{
		echo '<div class="widget"><div class="widgetinner">';
		if(file_exists(TEMPLATEPATH . '/ads/sidebar_top_300x250/'. current_catID() .'.php') && (is_single() || is_category())) {
			include_once(TEMPLATEPATH . '/ads/sidebar_top_300x250/'. current_catID() .'.php');
		}
		else 
		{
			include_once(TEMPLATEPATH . '/ads/sidebar_top_300x250.php');
		}
		echo '</div></div>';
	} 
	
	/* Sidebar Widget 2 */
	if (is_home()) 
	{
		gab_dynamic_sidebar( 'Sidebar2-Home' ); 
	} 
	else 
	{
		gab_dynamic_sidebar( 'Sidebar2-Innerpage' ); 
	}

	/* Sidebar bottom ad */
	if ( of_get_option('of_sn_ad3') <> "" ) 
	{ 
		if(file_exists(TEMPLATEPATH . '/ads/sidebar_bottom_300x250/'. current_catID() .'.php') && (is_single() || is_category())) {
			include_once(TEMPLATEPATH . '/ads/sidebar_bottom_300x250/'. current_catID() .'.php');
		}
		else 
		{
			include_once(TEMPLATEPATH . '/ads/sidebar_bottom_300x250.php');
		}
	} 

	/* Sidebar Widget 3 */
	if (is_home()) 
	{
		gab_dynamic_sidebar( 'Sidebar3-Home' );
	} 
	else 
	{
		gab_dynamic_sidebar( 'Sidebar3-Innerpage' ); 
	}
?>