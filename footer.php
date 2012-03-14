</div><!-- end of wrapper -->

<div id="footer">
	<div class="wrapper">
		<div id="foo_widget1">
			<?php if ( ! dynamic_sidebar( 'Footer1' ) ) : ?>
			
				<h3 class="widgettitle">Widgetized Section</h3>
				<p>Go to Admin &raquo; appearance &raquo; Widgets &raquo;  and move a widget into Footer1 Widget Zone</p>
				
			<?php endif; if(of_get_option('of_sn_widget') == 1) { echo '<span class="widgetname">Footer1</span>'; } ?>
		</div>

		<div id="foo_widget2">
			<?php if ( ! dynamic_sidebar( 'Footer2' ) ) : ?>
			
				<h3 class="widgettitle">Widgetized Section</h3>
				<p>Go to Admin &raquo; appearance &raquo; Widgets &raquo;  and move a widget into Footer2 Widget Zone</p>
				
			<?php endif; if(of_get_option('of_sn_widget') == 1) { echo '<span class="widgetname">Footer2</span>'; } ?>
			<div class="clear"></div>
		</div>
		
		<div id="foo_widget3">	
			<?php if ( ! dynamic_sidebar( 'Footer3' ) ) : ?>
			
				<h3 class="widgettitle">Widgetized Section</h3>
				<p>Go to Admin &raquo; appearance &raquo; Widgets &raquo;  and move a widget into Footer1 Widget Zone</p>
				
			<?php endif; 	if(of_get_option('of_sn_widget') == 1) { echo '<span class="widgetname">Footer3</span>'; } ?>
		</div>

		<div class="clear"></div>
	</div><!-- /wrapper -->
</div><!-- /footer -->

<div id="footer_data">
	<div class="wrapper">
		<div id="footer-left-side">
			<?php /* Replace default text if option is set */
			if( of_get_option('of_sn_footer_left') == 1){
				echo of_get_option('of_sn_footer_left_text');
			} else { 
			?>
				<a href="#top" title="<?php bloginfo('name'); ?>" rel="home"><strong>&uarr;</strong> <?php bloginfo('name'); ?></a>
			<?php } ?>
		</div><!-- #site-info -->
				
		<div id="footer-right-side">
			<?php /* Replace default text if option is set */
			if( of_get_option('of_sn_footer_right') == 1){ 
				echo of_get_option('of_sn_footer_right_text');
			} else {
				wp_loginout(); 
				if ( is_user_logged_in() ) { 
					echo '-'; ?>
					<a href="<?php bloginfo('url'); ?>/wp-admin/edit.php">Posts</a> - 
					<a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php">Add New</a>
				<?php } ?> - 
			<?php } ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'snapwire'); ?>" rel="generator"><?php _e('Powered by WordPress', 'snapwire'); ?></a> - 
			Designed by <a href="http://www.gabfirethemes.com/" title="Premium WordPress Themes">Gabfire Themes</a> 
			<?php wp_footer(); ?>
		</div> <!-- #footer-right-side -->
		<div class="clear"></div>
	</div><!-- /wrapper -->
</div><!-- /footer_data -->

</body>
</html>