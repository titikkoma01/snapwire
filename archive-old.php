<?php get_header(); ?> 

<div class="wrapper">
	<div id="container">
		<div id="main">
			<h3 id="bcrumb">
				<?php gab_breadcrumb(); ?>
			</h3>
			
			<?php  /* uncomment to display author bio (Unformatted CSS) above the author pages 
				if (is_author()) {  ?>
				<div class="gab_authorInfo">
				<?php global $wp_query; $curauth = $wp_query->get_queried_object(); ?>
					<div class="gab_authorPic">
						<?php echo get_avatar( $curauth->user_email, '50' ); ?>
					</div>
					<?php _e('Stories written by','snapwire'); ?> <?php echo $curauth->nickname; ?><br /><?php echo $curauth->description; ?>
					<div class="clear"></div>
				</div>			
			<?php } */ ?>
			
			<?php 
				if (of_get_option('of_sn_media_temp') <> "" && is_category(explode(',',of_get_option('of_sn_media_temp')))) {
					include (TEMPLATEPATH . '/archive-media.php'); 
				} 
				else 
				{
					include (TEMPLATEPATH . '/archive-default.php'); 
				}
				
				// load pagination
				if (($wp_query->max_num_pages > 1) && (function_exists("pagination"))) {
					pagination($additional_loop->max_num_pages);
				}				
			?>
										
		</div> <!-- /main -->
		
		<div id="sidebar">
			<div class="holder margin_bottom_25">
				<?php get_sidebar(); ?>
			</div><!-- /holder -->
		</div><!-- /sidebar -->
	
		<div class="clear"></div>
	</div><!-- End of container -->

<?php get_footer(); ?>
