<?php get_header(); ?> 

<?php if (intval(of_get_option('of_sn_fea_nr')) > 0 ) { ?>
<div id="featured_wrapper">
	
	<div class="wrapper">

			<div id="featured_posts">

				<div id="featured-slider" class="sliderwrapper">
					<?php 
					$count = 0;
								
					if ( of_get_option('of_sn_fea_recent') == 1 ) {
						$args = array(
						   'post__not_in'=>$do_not_duplicate,
						   'posts_per_page' => 6
						);
					} else {
						if ( of_get_option('of_sn_fea_tag') <> "" ) {
							$args = array(
							  'post_type' => 'any',
							  'post__not_in'=>$do_not_duplicate,
							  'posts_per_page' => 6,
							  'tag' => of_get_option('of_sn_fea_tag')
							);
						} elseif ( of_get_option('of_sn_fea_cf') == 1 ) {
							$args = array(
							  'post_type' => 'any',
							  'post__not_in'=>$do_not_duplicate,
							  'posts_per_page' => 6,
							  'meta_key' => 'featured', 
							  'meta_value' => 'true'
							);
						} else {
							$args = array(
							  'post__not_in'=>$do_not_duplicate,
							  'posts_per_page' => 6, 
							  'cat' => of_get_option('of_sn_fea_cat' , 1)
							);				
						}
					}
								
					$gab_query = new WP_Query();$gab_query->query($args); 
					while ($gab_query->have_posts()) : $gab_query->the_post();						
					$do_not_duplicate[] = $post->ID;
					?>
					<div class="item">
						<div class="sliderPostPhoto">				
							<?php 
							gab_media(array(
								'name' => 'snpw-fea', 
								'imgtag' => 1,
								'link' => 1,
								'enable_video' => 1,
								'catch_image' => of_get_option('of_catch_img'),
								'video_id' => 'featured', 
								'enable_thumb' => 1, 
								'resize_type' => 'c', /* c to crop, h to resize only height, w to resize only width */
								'media_width' => '660', 
								'media_height' => '366', 
								'thumb_align' => 'null',
								'enable_default' => of_get_option('of_sn_df1'),
								'default_name' => 'featured.jpg'	
							)); 										
							?>
						</div><!-- end of sliderphoto/video -->
						
						<?php if (($gab_flv == '') and ($gab_video == '') and ($gab_iframe == '') ) { /* if this is not a video*/ ?>
							<div class="caption">
								<h2 class="posttitle">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'journey' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
								</h2>
								
								<p><?php print string_limit_words(get_the_excerpt(), 13); ?>&hellip;</p>
								
							</div>
						<?php } ?>
						
					</div><!-- /item -->
					<?php $count++; endwhile; wp_reset_query(); ?>
					
				</div><!-- /slides -->
				
				<div id="arrows"><a href="#" class="prev"><?php _e('Previous', 'journey'); ?></a><a href="#" class="next"><?php _e('Next', 'journey'); ?></a></div>
				
				<div id="nav">
							
					<ul>
						<?php 
						$count = 1;								
						$gab_query = new WP_Query();$gab_query->query($args); 
						while ($gab_query->have_posts()) : $gab_query->the_post();						
						/*Uncomment to avoid duplicate post issue */
						/* $do_not_duplicate[] = $post->ID */
						?>
						<li>
							<a href="#">
								<?php 
								gab_media(array(
									'name' => 'snpw-fea_thumb', 
									'enable_video' => 0, 
									'imgtag' => 1,
									'link' => 0,
									'catch_image' => of_get_option('of_jr_catch_img'),
									'enable_thumb' => 1, 
									'resize_type' => 'c',
									'media_width' => '85', 
									'media_height' => '45', 
									'thumb_align' => 'alignleft', 
									'enable_default' => of_get_option('of_sn_df2'),
									'default_name' => 'featured_small.jpg'	
								)); 										
								?>
							</a>
							
							<a href="#" class="posttitle"><?php gab_posttitle('55','&hellip;'); ?></a>
						</li>
						<?php $count++; endwhile; wp_reset_query(); ?>
					</ul>
				</div>				
				
			</div><!-- /featured_posts -->			
					
	</div><!-- /wrapper -->
	
	
	
</div><!-- /featured wrapper -->
<?php } ?>
			
<?php gab_dynamic_sidebar( 'Featured' ); ?>	

<div class="wrapper">
	<div id="container">
		<div id="main">
			<div class="holder margin_bottom_25">
				<div id="secondary_top" class="border_bottom_30">
					<div class="col_narrow border_right_15">
						<?php 
						gab_dynamic_sidebar( 'Se_Top_Left1' );  
							include_once(TEMPLATEPATH . '/ads/home_120x600.php');					
						gab_dynamic_sidebar( 'Se_Top_Left2' ); 
						?>
					</div>
					
					<div class="col_wide border_right_15">
						<?php gab_dynamic_sidebar( 'Se_Top_Mid1' ); ?>
						
						<?php if (intval(of_get_option('of_sn_nr2')) > 0 ) { ?>
						
							<span class="catname">
								<a href="<?php echo get_category_link(of_get_option('of_sn_cat2'));?>"><?php echo get_cat_name(of_get_option('of_sn_cat2')); ?></a>
							</span>
						
							<?php 
							$count = 1;
							$args = array(
							  'posts_per_page' => of_get_option('of_sn_nr2'), 
							  'cat' => of_get_option('of_sn_cat2')
							);	
							$gab_query = new WP_Query();$gab_query->query($args); 
							while ($gab_query->have_posts()) : $gab_query->the_post();						
							?>
							
							<div class="featuredpost<?php if ($count == of_get_option('of_sn_nr2')) { echo " lastpost"; } ?>">

								<?php 
									gab_media(array(   'imgtag' => 1,   'link' => 1,
										'name' => 'snpw-pri_top',
										'enable_video' => 0,
										'catch_image' => of_get_option('of_sn_catch_img'),
										'enable_thumb' => 1,
										'resize_type' => 'c', 
										'media_width' => '228', 
										'media_height' => '135', 
										'thumb_align' => 'alignnone', 
										'enable_default' => of_get_option('of_sn_end3'),
										'default_name' => 'primary_top1.jpg'									
									)); 
								?>						
								
								<h2 class="posttitle"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

								<p><?php echo string_limit_words(get_the_excerpt(), 22); ?>&hellip;</p>
								
								<span class="postmeta<?php if ($count == of_get_option('of_sn_nr2')) { echo " lastpost"; } ?>">
									<?php echo get_the_date(''); ?> / 
									<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire')); ?> / 
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Read More','snapwire'); ?></a>
									<?php edit_post_link(__('Edit','snapwire'),' / ',''); ?>
								</span>

							</div>
							<?php $count++; endwhile; wp_reset_query(); ?>
						
						<?php } ?>
						
						<?php gab_dynamic_sidebar( 'Se_Top_Mid2' ); ?>
					</div>

					<div class="col_wide last">
						<?php gab_dynamic_sidebar( 'Se_Top_Right1' ); ?>
				
						<?php if (intval(of_get_option('of_sn_nr3')) > 0 ) { ?>
						
							<span class="catname">
								<a href="<?php echo get_category_link(of_get_option('of_sn_cat3'));?>"><?php echo get_cat_name(of_get_option('of_sn_cat3')); ?></a>
							</span>
							
							<?php 
							$count = 1;
							$args = array(
							  'posts_per_page' => of_get_option('of_sn_nr3'), 
							  'cat' => of_get_option('of_sn_cat3')
							);	
							$gab_query = new WP_Query();$gab_query->query($args); 
							while ($gab_query->have_posts()) : $gab_query->the_post();						
							?>
							
							<div class="featuredpost<?php if ($count == of_get_option('of_sn_nr2')) { echo " lastpost"; } ?>">

								<?php 
									gab_media(array(   'imgtag' => 1,   'link' => 1,
										'name' => 'snpw-pri_top',
										'enable_video' => 0,
										'catch_image' => of_get_option('of_sn_catch_img'),
										'enable_thumb' => 1,
										'resize_type' => 'c', 
										'media_width' => '228', 
										'media_height' => '135', 
										'thumb_align' => 'alignnone', 
										'enable_default' => of_get_option('of_sn_end4'),
										'default_name' => 'primary_top2.jpg'									
									)); 
								?>	
								
								<h2 class="posttitle"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

								<p><?php echo string_limit_words(get_the_excerpt(), 22); ?>&hellip;</p>
								
								<span class="postmeta<?php if ($count == of_get_option('of_sn_nr2')) { echo " lastpost"; } ?>">
									<?php echo get_the_date(''); ?> / 
									<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire')); ?> / 
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Read More','snapwire'); ?></a>
									<?php edit_post_link(__('Edit','snapwire'),' / ',''); ?>
								</span>

							</div>
							<?php $count++; endwhile; wp_reset_query(); ?>
							
						<?php } ?>
						
						<?php gab_dynamic_sidebar( 'Se_Top_Right2' );?>
					</div>
					
					<div class="clear"></div>				
				</div>
				
				<?php gab_dynamic_sidebar( 'Secondary1' ); ?>
				
				<div id="secondary_bottom" class="border_bottom_30">
					
					<div class="col_left border_right_20">
						<?php gab_dynamic_sidebar( 'Se_Bot_Left1' ); ?>
						
						<?php if (intval(of_get_option('of_sn_nr4')) > 0 ) { ?>
						
							<span class="catname">
								<a href="<?php echo get_category_link(of_get_option('of_sn_cat4'));?>"><?php echo get_cat_name(of_get_option('of_sn_cat4')); ?></a>
							</span>
						
							<?php 
							$count = 1;
							$args = array(
							  
							  'posts_per_page' => of_get_option('of_sn_nr4'), 
							  'cat' => of_get_option('of_sn_cat4')
							);	
							$gab_query = new WP_Query();$gab_query->query($args); 
							while ($gab_query->have_posts()) : $gab_query->the_post();						
							?>
							
							<div class="featuredpost<?php if ($count == of_get_option('of_sn_nr4')) { echo " lastpost"; } ?>">				
								
								<h2 class="posttitle"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

								<?php 
									gab_media(array(   'imgtag' => 1,   'link' => 1,
										'name' => 'snpw-pri_bot',
										'enable_video' => 0,
										'catch_image' => of_get_option('of_sn_catch_img'),
										'enable_thumb' => 1,
										'resize_type' => 'c', 
										'media_width' => '80', 
										'media_height' => '60', 
										'thumb_align' => 'alignleft', 
										'enable_default' => of_get_option('of_sn_end5'),
										'default_name' => 'primary_bot1.jpg'									
									)); 
								?>							
								
								<p><?php echo string_limit_words(get_the_excerpt(), 18); ?>&hellip;</p>
								
								<span class="postmeta<?php if ($count == of_get_option('of_sn_nr4')) { echo " lastpost"; } ?>">
									<?php echo get_the_date(''); ?> / 
									<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire')); ?> / 
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Read More','snapwire'); ?></a>
									<?php edit_post_link(__('Edit','snapwire'),' / ',''); ?>
								</span>

							</div>
							<?php $count++; endwhile; wp_reset_query(); ?>
						
						<?php } ?>
						
						<?php gab_dynamic_sidebar( 'Se_Bot_Left2' ); ?>
					</div>

					<div class="col_right last">
						<?php gab_dynamic_sidebar( 'Se_Bot_Right1' );  ?>
						
						<?php if (intval(of_get_option('of_sn_nr5')) > 0 ) { ?>
						
						<span class="catname">
							<a href="<?php echo get_category_link(of_get_option('of_sn_cat5'));?>"><?php echo get_cat_name(of_get_option('of_sn_cat5')); ?></a>
						</span>			
					
						<?php 
						$count = 1;
						$args = array(
						  'posts_per_page' => of_get_option('of_sn_nr5'), 
						  'cat' => of_get_option('of_sn_cat5')
						);	
						$gab_query = new WP_Query();$gab_query->query($args); 
						while ($gab_query->have_posts()) : $gab_query->the_post();						
						?>
						
						<div class="featuredpost<?php if ($count == of_get_option('of_sn_nr5')) { echo " lastpost"; } ?>">

						<h2 class="posttitle"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
							<?php 
								gab_media(array(   'imgtag' => 1,   'link' => 1,
									'name' => 'snpw-pri_bot',
									'enable_video' => 0,
									'catch_image' => of_get_option('of_sn_catch_img'),
									'enable_thumb' => 1,
									'resize_type' => 'c', 
									'media_width' => '80', 
									'media_height' => '60', 
									'thumb_align' => 'alignleft', 
									'enable_default' => of_get_option('of_sn_end6'),
									'default_name' => 'primary_bot2.jpg'									
								)); 
							?>	
							
							<p><?php echo string_limit_words(get_the_excerpt(), 18); ?>&hellip;</p>
							
							<span class="postmeta<?php if ($count == of_get_option('of_sn_nr5')) { echo " lastpost"; } ?>">
								<?php echo get_the_date(''); ?> / 
								<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire')); ?> / 
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Read More','snapwire'); ?></a>
								<?php edit_post_link(__('Edit','snapwire'),' / ',''); ?>
							</span>

						</div>
						<?php $count++; endwhile; wp_reset_query(); ?>
							
						<?php } ?>
						
						<?php gab_dynamic_sidebar( 'Se_Bot_Right2' ); ?>
					</div>
					<div class="clear"></div>				
				</div>			
				
				<?php gab_dynamic_sidebar( 'Secondary2' ); ?>
				
				<?php if (intval(of_get_option('of_sn_nr6')) > 0 ) { ?>
					<div id="mediabar">
						<div id="previous_button"></div>
						<div id="next_button"></div>

						<div class="container">
							<ul>
								<?php 
								$count=1;
								$args = array(
								  'posts_per_page' => of_get_option('of_sn_nr6'), 
								  'cat' => of_get_option('of_sn_cat6')
								);						
								$gab_query = new WP_Query();$gab_query->query($args); 
								while ($gab_query->have_posts()) : $gab_query->the_post();
								?>	
								<li class="car">
									<div class="thumb">
										<?php 
										gab_media(array(   'imgtag' => 1,   'link' => 1,
											'name' => 'snpw-med_slide', 
											'enable_video' => 1, 
											'video_id' => 'mediabar', 
											'enable_thumb' => 1, 
											'catch_image' => 0,
											'resize_type' => 'c', /* c to crop, h to resize only height, w to resize only width */
											'media_width' => '130', 
											'media_height' => '120', 
											'thumb_align' => 'mediabar_item', 
											'enable_default' => of_get_option('of_sn_end7'),
											'default_name' => 'p_gallery.jpg'
											)); 
										?>
									</div>
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							
								</li>
								<?php $count++; endwhile; wp_reset_query(); ?>
							</ul>
						</div>
						
						<script type="text/javascript">
							(function($) { $(document).ready(function(){
								$("#mediabar .container").jCarouselLite({
									<?php if(of_get_option('of_sn_media_rotate') == 1){ ?>
										auto:<?php if ( of_get_option('of_sn_media_pause') <> "" ) { echo of_get_option('of_sn_media_pause').'000'; } else { echo '5000'; } ?>,
									<?php } ?>
									scroll: <?php if ( of_get_option('of_sn_media_scroll') <> "" ) { echo of_get_option('of_sn_media_scroll'); } else { echo '2'; } ?>,
									speed: <?php if ( of_get_option('of_sn_media_speed') <> "" ) { echo of_get_option('of_sn_media_speed').'000'; } else { echo '1000'; } ?>,	
									visible: 4,
									start: 0,
									circular: false,
									btnPrev: "#previous_button",
									btnNext: "#next_button"
								});
							})})(jQuery)	
						</script>
							
					</div><!-- end of Mediabar -->
				<?php } ?>
				
				<?php gab_dynamic_sidebar( 'Below_Mediabar' ); ?>
				
				<div id="subnews">
					<div class="col border_right_15">
						<?php gab_dynamic_sidebar( 'SubnewsLeft1' ); ?>
						
						<?php if (intval(of_get_option('of_sn_nr7')) > 0 ) { ?>
							<span class="catname">
								<a href="<?php echo get_category_link(of_get_option('of_sn_cat7'));?>"><?php echo get_cat_name(of_get_option('of_sn_cat7')); ?></a>
							</span>					
						
							<?php 
							$count = 1;
							$args = array(
							  'posts_per_page' => of_get_option('of_sn_nr7'), 
							  'cat' => of_get_option('of_sn_cat7')
							);	
							$gab_query = new WP_Query();$gab_query->query($args); 
							while ($gab_query->have_posts()) : $gab_query->the_post();						
							?>
							
							<div class="featuredpost<?php if ($count == of_get_option('of_sn_nr7')) { echo " lastpost"; } ?>">
								
								<h2 class="posttitle"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

								<p><?php echo string_limit_words(get_the_excerpt(), 16); ?>&hellip;</p>
								
								<span class="postmeta<?php if ($count == of_get_option('of_sn_nr7')) { echo " lastpost"; } ?>">
									<?php echo get_the_date(''); ?> / 
									<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire')); ?>
									<?php edit_post_link(__('Edit','snapwire'),' / ',''); ?>
								</span>

							</div>
							<?php $count++; endwhile; wp_reset_query(); ?>
							
						<?php } ?>
						
						<?php gab_dynamic_sidebar( 'SubnewsLeft2' ); ?>
					</div>
					
					<div class="col border_right_15">
						<?php gab_dynamic_sidebar( 'SubnewsMid1' );  ?>
						
						<?php if (intval(of_get_option('of_sn_nr8')) > 0 ) { ?>
							<span class="catname">
								<a href="<?php echo get_category_link(of_get_option('of_sn_cat8'));?>"><?php echo get_cat_name(of_get_option('of_sn_cat8')); ?></a>
							</span>			
						
							<?php 
							$count = 1;
							$args = array(
							  'posts_per_page' => of_get_option('of_sn_nr8'), 
							  'cat' => of_get_option('of_sn_cat8')
							);	
							$gab_query = new WP_Query();$gab_query->query($args); 
							while ($gab_query->have_posts()) : $gab_query->the_post();						
							?>
							
							<div class="featuredpost<?php if ($count == of_get_option('of_sn_nr8')) { echo " lastpost"; } ?>">
							
								<h2 class="posttitle"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

								<p><?php echo string_limit_words(get_the_excerpt(), 16); ?>&hellip;</p>
								
								<span class="postmeta<?php if ($count == of_get_option('of_sn_nr8')) { echo " lastpost"; } ?>">
									<?php echo get_the_date(''); ?> / 
									<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire')); ?>
									<?php edit_post_link(__('Edit','snapwire'),' / ',''); ?>
								</span>
							
							</div>
							<?php $count++; endwhile; wp_reset_query(); ?>
							
						<?php } ?>
						
						<?php gab_dynamic_sidebar( 'SubnewsMid2' ); ?>
					</div>

					<div class="col last">
						
						<?php gab_dynamic_sidebar( 'SubnewsRight1' ); ?>
					
						<?php if (intval(of_get_option('of_sn_nr9')) > 0 ) { ?>
						
							<span class="catname">
								<a href="<?php echo get_category_link(of_get_option('of_sn_cat9'));?>"><?php echo get_cat_name(of_get_option('of_sn_cat9')); ?></a>
							</span>
					
							<?php 
							$count = 1;
							$args = array(
							  'posts_per_page' => of_get_option('of_sn_nr9'), 
							  'cat' => of_get_option('of_sn_cat9')
							);	
							$gab_query = new WP_Query();$gab_query->query($args); 
							while ($gab_query->have_posts()) : $gab_query->the_post();						
							?>
							
							<div class="featuredpost<?php if ($count == of_get_option('of_sn_nr9')) { echo " lastpost"; } ?>">
								
								<h2 class="posttitle"><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'snapwire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

								<p><?php echo string_limit_words(get_the_excerpt(), 16); ?>&hellip;</p>
								
								<span class="postmeta<?php if ($count == of_get_option('of_sn_nr9')) { echo " lastpost"; } ?>">
									<?php echo get_the_date(''); ?> / 
									<?php comments_popup_link(__('No Comment','snapwire'), __('1 Comment','snapwire'), __('% Comments','snapwire')); ?>
									<?php edit_post_link(__('Edit','snapwire'),' / ',''); ?>
								</span>
								
							</div>
							<?php $count++; endwhile; wp_reset_query(); ?>
							
						<?php } ?>
						
						<?php gab_dynamic_sidebar( 'SubnewsRight2' ); ?>
					</div>
					<div class="clear"></div>				
				</div><!-- /border_bottom_30 -->			
				
				<?php gab_dynamic_sidebar( 'MainBottom' ); ?>
			</div><!-- /holder -->
		</div> <!-- /main -->
	
		<div id="sidebar">
			<div class="holder margin_bottom_25">
				<?php get_sidebar(); ?>
			</div><!-- /holder -->
		</div><!-- /sidebar -->
	
		<div class="clear"></div>
	</div><!-- End of container -->

<?php get_footer(); ?>
