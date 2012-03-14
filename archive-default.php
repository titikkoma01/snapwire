<div class="wrapper">
	<div id="container">
		<div id="main">
		
			<h3 id="bcrumb">
				<?php gab_breadcrumb(); ?>
			</h3>
			
			<?php if (is_author()) { ?>
				<div class="gab_authorInfo">
				<?php global $wp_query; $curauth = $wp_query->get_queried_object(); ?>
					<div class="gab_authorPic">
						<?php echo get_avatar( $curauth->user_email, '50' ); ?>
					</div>
					<strong><?php _e('Stories written by','snapwire'); ?> <?php echo $curauth->nickname; ?></strong><br /><?php echo $curauth->description; ?>
					<div class="clear"></div>
				</div>			
			<?php } ?>
				
			<?php 
				include (TEMPLATEPATH . '/loop-default.php'); 

				// load pagination
			if (($wp_query->max_num_pages > 1) && (function_exists("pagination"))) {
				pagination($additional_loop->max_num_pages);
			} ?>		
					
		</div> <!-- /main -->
		
		<div id="sidebar">
			<div class="holder margin_bottom_25">
				<?php get_sidebar(); ?>
			</div><!-- /holder -->
		</div><!-- /sidebar -->
	
		<div class="clear"></div>
	</div><!-- End of container -->