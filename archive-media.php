<div class="wrapper">
	<div id="container">
		<div id="main" style="width:978px;margin:0;">
		
			<h3 id="bcrumb">
				<?php gab_breadcrumb(); ?>
			</h3>
				
			<?php 
				include (TEMPLATEPATH . '/loop-media.php'); 

				// load pagination
			if (($wp_query->max_num_pages > 1) && (function_exists("pagination"))) {
				pagination($additional_loop->max_num_pages);
			} ?>		
					
		</div> <!-- /main -->
	
		<div class="clear"></div>
	</div><!-- End of container -->