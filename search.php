<?php get_header(); ?> 

<div class="wrapper">
	<div id="container">
		<div id="main">
		
			<h3 id="bcrumb">
				<?php gab_breadcrumb(); ?>
			</h3>
						
			<?php include (TEMPLATEPATH . '/archive-default.php'); 

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