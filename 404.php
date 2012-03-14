<?php get_header(); ?> 

<div class="wrapper">
	<div id="container">
		<div id="main">
			<div <?php post_class('holder margin_bottom_25'); ?>>
			
				
						<h3 id="bcrumb">
							<?php _e('Page not found!','snapwire'); ?>
						</h3>

						<p><?php _e('Sorry the page you were looking is not here.','snapwire'); ?></p>
						

			</div><!-- /post -->

				
			
		</div> <!-- /main -->
	
		<div id="sidebar">
			<div class="holder margin_bottom_25">
				<?php get_sidebar(); ?>
			</div><!-- /holder -->
		</div><!-- /sidebar -->
	
		<div class="clear"></div>
	</div><!-- End of container -->

<?php get_footer(); ?>
