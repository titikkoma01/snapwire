<?php
/*
Template Name: Widgetized Page
*/
?>
<?php get_header(); ?> 

<div class="wrapper">
	<div id="container">
		<div id="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('holder margin_bottom_25'); ?>>
			
				<h1 class="entry_title"><?php the_title(); ?></h1>
				
				<?php 
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
					
					//If there is a widget, display it
					gab_dynamic_sidebar('PageWidget');
					
					// Display edit post link to site admin
					edit_post_link(__('Edit This Post','snapwire'),'<p>','</p>'); 
				?>					
				
			</div><!-- /post -->
			<?php endwhile; else : endif; ?>

		</div> <!-- /main -->
	
		<div id="sidebar">
			<div class="holder margin_bottom_25">
				<?php get_sidebar(); ?>
			</div><!-- /holder -->
		</div><!-- /sidebar -->
	
		<div class="clear"></div>
	</div><!-- End of container -->

<?php get_footer(); ?>
