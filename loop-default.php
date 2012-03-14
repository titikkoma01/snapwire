		<?php
		$count = 1;
		if (have_posts()) : while (have_posts()) : the_post();			
		$gab_thumb = get_post_meta($post->ID, 'thumbnail', true);
		$gab_video = get_post_meta($post->ID, 'video', true);
		$gab_flv = get_post_meta($post->ID, 'videoflv', true);
		$ad_flv = get_post_meta($post->ID, 'adflv', true);
		$gab_iframe = get_post_meta($post->ID, 'iframe', true);		
		?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('holder archive');?>>
				<?php if(($gab_flv !== '') or ($gab_video !== '') or ($gab_iframe !== '') ) {
					gab_media(array(   'imgtag' => 1,   'link' => 1,
						'name' => 'snpw-fea', 
						'enable_video' => 1, 
						'video_id' => 'featured', 
						'enable_thumb' => 0, 
						'resize_type' => 'c', /* c to crop, h to resize only height, w to resize only width */
						'media_width' => '604', 
						'media_height' => '350', 
						'thumb_align' => 'videowrapper', 
						'enable_default' => of_get_option('of_sn_enfea6'),
						'default_name' => 'featured.jpg'	
					)); 
				} 
				else 
				{
					gab_media(array(   'imgtag' => 1,   'link' => 1,
						'name' => 'snpw-archive', 
						'enable_video' => 0, 
						'video_id' => 'featured', 
						'enable_thumb' => 1, 
						'catch_image' => 0,
						'resize_type' => 'c', /* c to crop, h to resize only height, w to resize only width */
						'media_width' => '210', 
						'media_height' => '185', 
						'thumb_align' => 'alignleft', 
						'enable_default' => 0
					)); 										
				}
				?>
				
				<?php the_tags('<p>', ' \ ', '</p>'); ?>
				<h2 class="archiveTitle">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" ><?php the_title(); ?></a>
				</h2>
				
				<?php
				the_excerpt(); 
				?>
				<div class="clear"></div>
			</div>
			
			
			<div class="postmeta_bar">
				<div class="dateholder border_right_30">
					<span class="day"><?php echo get_the_date('d'); ?></span>
					<span class="dateandyear">
						<span class="month"><?php echo get_the_date('M'); ?></span>
						<span class="year"><?php echo get_the_date('Y'); ?></span>
					</span>
				</div>
		
				<div class="col border_right_30">
					<p><?php _e('Posted by','snapwire');?></p>
					<?php the_author_posts_link(); ?>
				</div>
				
				<?php if (get_post_type() == 'post') { ?>
					<div class="col border_right_30">
						<p><?php _e('Posted in','snapwire');?></p>
						<?php the_category(', '); ?>
					</div>

					<div class="col border_right_30">
						<p><?php _e('Comments','snapwire');?></p>
						<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire'));?>
					</div>
				
					<div class="col last">
						<p><?php _e('Tags','snapwire');?></p>
						<?php the_tags('', ' \ ', ''); ?>
					</div>
				<?php } ?>
				
				<div class="more">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<span><?php _e('Read More', 'snapwire'); ?></span>
					</a>
				</div>
				
				<div class="clear"></div>
			</div>
			
		<?php $count++; endwhile; else : ?>
		<div <?php post_class('holder archive');?>>
			<h2 class="archiveTitle"><?php _e('Sorry, nothing matched your criterias','snapwire');?></h2>
		</div>
		<?php endif; ?>