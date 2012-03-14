<?php get_header(); ?> 

<div class="wrapper">
	<div id="container">
		<div id="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('entry holder margin_bottom_25'); ?>>
			
				<h1 class="entry_title"><?php the_title(); ?></h1>

				<div class="metasingle">
					<span class="postdate"><?php echo get_the_date('') ?>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
					<span class="postcategory"><?php _e('Filed under','snapwire'); ?>: <?php the_category(',') ?>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
					<span class="postauthor"><?php _e('Posted by','snapwire'); ?>: <?php the_author_posts_link(); ?></span> 
				</div><!-- /metas -->
				
				<?php 
					// Theme innerpage slider
					gab_innerslider();


					// Display edit post link to site admin
					edit_post_link(__('Edit This Post','snapwire'),'<p>','</p>'); 				
					
					// If there is a video, display it
					gab_media(array(   'imgtag' => 1,   'link' => 1,
						'name' => 'fatured',
						'enable_video' => 1,
						'video_id' => 'post',
						'catch_image' => 0,
						'enable_thumb' => 0,
						'media_width' => '604', 
						'media_height' => '350', 
						'thumb_align' => 'videowrapper', 
						'enable_default' => 0,
					)); 
					
					// Display content
					the_content();
					
					// make sure any floated content gets cleared
					echo '<div class="clear"></div>';
					
					// Display pagination
					wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink= %');
					
					//If enabled -> display short url of post
					if(of_get_option('of_short_url') == 1) {
						echo '<p class="small_text">';
							_e('Shortlink: ','snapwire'); 
							echo '<input type="text" class="small_text span-1" onclick="this.focus(); this.select();" value="'; wp_get_shortlink(); 
							echo '">';
						echo '</p>';
					}				
					
					//If there is a widget, display it
					gab_dynamic_sidebar('PostWidget');
				
					// Display edit post link to site admin
					edit_post_link(__('Edit This Post','snapwire'),'<p>','</p>'); 
				?>	
				
			</div><!-- /post -->
			<?php endwhile; else : endif; ?>
			
			<?php if ( of_get_option('of_sn_singlepage') <> "" ) {  ?>
			<div class="single_ad">
					<?php
						if(file_exists(TEMPLATEPATH . '/ads/single_468x60/'.current_catID().'.php') && (is_single() || is_category())) {
							include_once(TEMPLATEPATH . '/ads/single_468x60/'.current_catID().'.php');
						}
						else {
							include_once(TEMPLATEPATH . '/ads/single_468x60.php');
						}
					?>
			</div>
			<?php } ?>

			<?php comments_template(); ?>
				
			
		</div> <!-- /main -->
	
		<div id="sidebar">
			<div class="holder margin_bottom_25">
				<?php get_sidebar(); ?>
			</div><!-- /holder -->
		</div><!-- /sidebar -->
	
		<div class="clear"></div>
	</div><!-- End of container -->

<?php get_footer(); ?>
