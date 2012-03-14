<?php
set_post_thumbnail_size( 50, 50, true); // Normal Post Thumbnails

if(of_get_option('of_wpmumode') == 0) {
	add_image_size( 'gabfire', 1024, 9999 ); /* Featured Big Image (this is the source image to be resized with timthumb */
} else {
	/* Theme thumbnail sizes for WordPress multi user
	 * network installations. The image sizes below will  
	 * be used only when WPMU mode is activated on 
	 * theme options -> under General settings tab
	 */
	add_image_size( 'snpw-fea', 660, 366, true ); // Featured Big Image
	add_image_size( 'snpw-fea_thumb', 85, 45, true ); // Featured small thumbs
	add_image_size( 'snpw-pri_top', 228, 135, true ); // Below Featured
	add_image_size( 'snpw-pri_bot', 80, 60, true ); // The section right above photo slider
	add_image_size( 'snpw-med_slide', 130, 120, true ); // Photo Slider on Mainpage
	add_image_size( 'snpw-archive', 80, 60, true ); // Thumbs for archive pages
	add_image_size( 'snpw-2col', 310, 200, true ); // 2column category 
	add_image_size( 'snpw-media', 205, 180, true ); // Media category template
	add_image_size( 'snpw-media-overlay', 638, 9999 ); // Overlay image size for media archive
	add_image_size( 'snpw-innerslide', 604, 9999 ); // Archive Pages
	add_image_size( 'ajaxtabs', 30, 30, true ); // Ajaxtabs Widget
}