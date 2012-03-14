<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
<title><?php gab_title(); ?></title>

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( of_get_option('of_rssaddr') <> "" ) { echo of_get_option('of_rssaddr'); } else { echo bloginfo('rss2_url'); } ?>" />	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>	
	
	<?php if(file_exists(TEMPLATEPATH . '/custom.css')) { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/custom.css" />
	<?php } ?>	

</head>

<body <?php body_class(); ?>>
<div id="header">
	<div class="wrapper">
		<div id="header_top">
			<div id="logo" style="padding:<?php echo of_get_option('of_padding_top'); ?>px 0px <?php echo of_get_option('of_padding_bottom'); ?>px <?php echo of_get_option('of_padding_left'); ?>px;">
				<?php 
				if ( of_get_option('of_logo_type') == 'image') { ?>
					<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>">
						<img src="<?php echo of_get_option('of_logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"/>
					</a>
				<?php } else { ?>
					<h1>
						<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
							<?php bloginfo('name'); ?>
							<span><?php bloginfo('description'); ?></span>
						</a>
					</h1>
				<?php } ?>
			</div><!-- /logo -->

			<ul class="mastheadnav dropdown">
				<?php
				if(of_get_option('of_nav2') == 1) { 
					wp_nav_menu( array('theme_location' => 'masthead', 'container' => false, 'items_wrap' => '%3$s'));
				} else { ?>
				
					<li class="gab_home"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('Home','snapwire'); ?></a></li>
					
					<?php if ( of_get_option('of_sn_facebook') <> "" ) { ?>
						<li class="gab_facebook"><a href="<?php echo of_get_option('of_sn_facebook'); ?>" rel="nofollow" title="<?php esc_attr_e('Connect on facebook','snapwire'); ?>"><?php _e('Connect on Facebook','snapwire'); ?></a></li>
					<?php } ?>
					
					<?php if ( of_get_option('of_sn_twitter') <> "" ) { ?>
						<li class="gab_twitter"><a href="<?php echo of_get_option('of_sn_twitter'); ?>" rel="nofollow" title="<?php esc_attr_e('Follow on Twitter','snapwire'); ?>"><?php _e('Follow on Twitter','snapwire'); ?></a></li>
					<?php } ?>
					
					<li class="gab_rss"><a href="<?php if ( ('of_rssaddr') <> "" ) { echo of_get_option('of_rssaddr'); } else { echo bloginfo('rss2_url'); } ?>" rel="nofollow"><?php _e('RSS for Entries', 'snapwire'); ?></a></li>
					
					<?php if ( of_get_option('of_feedemail') <> "" ) { ?>
						<li class="gab_email"><a href="<?php echo of_get_option('of_feedemail'); ?>" rel="nofollow"><?php _e('Subscribe via Email', 'snapwire'); ?></a></li>
					<?php } ?>
					
					<?php wp_register('<li class="gab_register">','</li>',true);
				} ?>
			</ul>
			
			<div class="clear"></div>

			<div id="header_widget">
				<?php 
				if ( of_get_option('of_sn_ad1') <> "" ) 
				{
					gab_categoryad('header_468x60');
				} else { 
					get_search_form(); 
				} 
				?>
			</div>
		</div>
		
		<div id="menuwrapper">
			<ul class="mainnav dropdown">
				<?php
				if(of_get_option('of_nav1') == 1) { 
					wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s'));
				} else { ?>
					<li <?php if(is_home() ) { ?>class="current-cat first"<?php } ?>><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('Home','snapwire'); ?></a></li>
					<?php wp_list_categories('orderby='. of_get_option('of_order_cats') .'&order='. of_get_option('of_sort_cats') .'&title_li=&exclude='. of_get_option('of_ex_cats'));
					wp_list_pages('sort_column=menu_order&title_li=&exclude='. of_get_option('of_ex_pages'));
				} ?>
			</ul>
		</div>
		
	</div><!-- /wrapper -->
</div><!-- /header -->